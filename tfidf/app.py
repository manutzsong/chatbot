# -*- coding: utf-8 -*-

#  Licensed under the Apache License, Version 2.0 (the "License"); you may
#  not use this file except in compliance with the License. You may obtain
#  a copy of the License at
#
#       http://www.apache.org/licenses/LICENSE-2.0
#
#  Unless required by applicable law or agreed to in writing, software
#  distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
#  WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
#  License for the specific language governing permissions and limitations
#  under the License.

from __future__ import unicode_literals
from keras.preprocessing.text import text_to_word_sequence
import errno
import os
import sys
import tempfile
import apiai
import json
import bcrypt
import requests
import re
import pymysql

from argparse import ArgumentParser

from flask import Flask, request, abort

from linebot import (
    LineBotApi, WebhookHandler
)
from linebot.exceptions import (
    InvalidSignatureError
)
from linebot.models import (
    MessageEvent, TextMessage, TextSendMessage,ImageSendMessage,
    SourceUser, SourceGroup, SourceRoom,
    TemplateSendMessage, ConfirmTemplate, MessageTemplateAction,
    ButtonsTemplate, URITemplateAction, PostbackTemplateAction,
    CarouselTemplate, CarouselColumn, PostbackEvent,
    StickerMessage, StickerSendMessage, LocationMessage, LocationSendMessage,
    ImageMessage, VideoMessage, AudioMessage,
    UnfollowEvent, FollowEvent, JoinEvent, LeaveEvent, BeaconEvent
)



app = Flask(__name__)

# get channel_secret and channel_access_token from your environment variable
channel_secret = '63efbc2b1de481db60cebcda66f8a6f2'
channel_access_token = 'dZnflRA5ac/U2hZ/Ado81F+t0H8yobXp2IbezUD9ONlaALDmhQED++LxMt9LU2/HX8b4SjSvbgemXAY+cF9uziWIhYLYzyU9uKCBAXMlXY4AISmxnlOzrx0DLnR9a6r/duACcHSjRxCNsZqGNCqL3gdB04t89/1O/w1cDnyilFU='
if channel_secret is None:
    print('Specify LINE_CHANNEL_SECRET as environment variable.')
    sys.exit(1)
if channel_access_token is None:
    print('Specify LINE_CHANNEL_ACCESS_TOKEN as environment variable.')
    sys.exit(1)

line_bot_api = LineBotApi(channel_access_token)
handler = WebhookHandler(channel_secret)


CLIENT_ACCESS_TOKEN = '37f9249f8aea441083ad7647807be5ee'

static_tmp_path = os.path.join(os.path.dirname(__file__), 'static', 'tmp')





admin_pw = "12345678"
#MYSQL
#MYSQL
conn = pymysql.connect(host='localhost', port=3306, user='root', passwd='128029486', db='keras',charset='utf8mb4')
cur = conn.cursor()



# function for create tmp dir for download content
def make_static_tmp_dir():
    try:
        os.makedirs(static_tmp_path)
    except OSError as exc:
        if exc.errno == errno.EEXIST and os.path.isdir(static_tmp_path):
            pass
        else:
            raise

@app.route("/callback", methods=['POST'])
def callback():
    # get X-Line-Signature header value
    signature = request.headers['X-Line-Signature']

    # get request body as text
    body = request.get_data(as_text=True)
    app.logger.info("Request body: " + body)



    # handle webhook body
    try:
        handler.handle(body, signature)
    except InvalidSignatureError:
        abort(400)

    return 'OK'




@handler.add(MessageEvent, message=TextMessage)
def handle_text_message(event):
    text = event.message.text

    #End lastuse update

    if text == 'profile':
        if isinstance(event.source, SourceUser):
            profile = line_bot_api.get_profile(event.source.user_id)
            line_bot_api.reply_message(
                event.reply_token, [
                    TextSendMessage(
                        text='Display name: ' + profile.display_name
                    ),
                    TextSendMessage(
                        text='Status message: ' + profile.status_message
                    )
                ]
            )
        else:
            line_bot_api.reply_message(
                event.reply_token,
                TextMessage(text="Bot can't use profile API without user ID"))
    elif text == 'bye':
        if isinstance(event.source, SourceGroup):
            line_bot_api.reply_message(
                event.reply_token, TextMessage(text='Leaving group'))
            line_bot_api.leave_group(event.source.group_id)
        elif isinstance(event.source, SourceRoom):
            line_bot_api.reply_message(
                event.reply_token, TextMessage(text='Leaving group'))
            line_bot_api.leave_room(event.source.room_id)
        else:
            line_bot_api.reply_message(
                event.reply_token,
                TextMessage(text="Bot can't leave from 1:1 chat"))
    elif text == 'confirm':
        confirm_template = ConfirmTemplate(text='Do it?', actions=[
            MessageTemplateAction(label='Yes', text='Yes!'),
            MessageTemplateAction(label='No', text='No!'),
        ])
        template_message = TemplateSendMessage(
            alt_text='Confirm alt text', template=confirm_template)
        line_bot_api.reply_message(event.reply_token, template_message)
    elif text == 'buttons':
        buttons_template = ButtonsTemplate(
            title='My buttons sample', text='Hello, my buttons', actions=[
                URITemplateAction(
                    label='Go to line.me', uri='https://line.me'),
                PostbackTemplateAction(label='ping', data='ping'),
                PostbackTemplateAction(
                    label='ping with text', data='ping',
                    text='ping'),
                MessageTemplateAction(label='Translate Rice', text='米')
            ])
        template_message = TemplateSendMessage(
            alt_text='Buttons alt text', template=buttons_template)
        line_bot_api.reply_message(event.reply_token, template_message)
    elif text == 'carousel':
        carousel_template = CarouselTemplate(columns=[
            CarouselColumn(text='hoge1', title='fuga1', actions=[
                URITemplateAction(
                    label='Go to line.me', uri='https://line.me'),
                PostbackTemplateAction(label='ping', data='ping')
            ]),
            CarouselColumn(text='hoge2', title='fuga2', actions=[
                PostbackTemplateAction(
                    label='ping with text', data='ping',
                    text='ping'),
                MessageTemplateAction(label='Translate Rice', text='米')
            ]),
        ])
        template_message = TemplateSendMessage(
            alt_text='Buttons alt text', template=carousel_template)
        line_bot_api.reply_message(event.reply_token, template_message)
    elif text == 'imagemap':
        pass
    elif text == '!unmute':
        #DELETE FROM `mute` WHERE `mute`.`id` = 1
        sql = "DELETE FROM `mute` WHERE group_id = %s"
        cur.execute(sql, (event.source.group_id,))
        line_bot_api.reply_message(
                    event.reply_token,
                    TextMessage(text="Unmute Successful"))
        conn.commit()



    elif text == '!mute':
        if isinstance(event.source, SourceGroup):
            #event.source.group_id
            sql1 = "SELECT * FROM `mute` WHERE `group_id`=%s"
            cur.execute(sql1, (event.source.group_id,))
            if not cur.rowcount:
                #INSERT INTO `register` (`id`, `uid`, `date_create`) VALUES (NULL, '1', CURRENT_TIMESTAMP);
                sql = "INSERT INTO `mute` (`id`, `group_id`, `date_create`) VALUES (NULL, %s, CURRENT_TIMESTAMP)"
                cur.execute(sql, (event.source.group_id))
                conn.commit()




                line_bot_api.reply_message(
                        event.reply_token,
                        TextMessage(text="Mute LOL"))



            else:


                line_bot_api.reply_message(
                    event.reply_token,
                    TextMessage(text="Already Mute"))



        else:
            line_bot_api.reply_message(
                        event.reply_token,
                        TextMessage(text="Aint group bro"))


##    elif text == '!survey':
##        line_bot_api.reply_message(
##                event.reply_token, [
##                    tell_enter,
##                    gender_message,
##                    year_message,
##                    year_message2,
##                    school_message
##
##                    ]
##            )



    elif '!admin' in text:
        process_register = text.split()
        try:
            if process_register[3] != admin_pw:
                line_bot_api.reply_message(
                        event.reply_token,
                        TextMessage(text="Wrong Password"))
            elif process_register[3] == admin_pw:
                sql2 = "SELECT `uid`,`username` FROM `user` WHERE `uid` = %s AND `username` = %s"
                cur.execute(sql2, (event.source.user_id,process_register[1],))
                if not cur.rowcount:
                    receive_admin_password = process_register[2].encode('utf-8')
                    hashed_pw = bcrypt.hashpw(receive_admin_password, bcrypt.gensalt())

                    sql = "INSERT INTO `user` (`id`, `uid`, `username`, `password`, `last_login`) VALUES (NULL, %s, %s, %s, CURRENT_TIMESTAMP);"
                    cur.execute(sql, (event.source.user_id,process_register[1],hashed_pw,))
                    conn.commit()
                    reply_invoke = 'Your Username : ' + process_register[1] + '\n \n Your Password : ' + process_register[2]
                    line_bot_api.reply_message(
                            event.reply_token,
                            TextMessage(text=reply_invoke))
        except Exception as e:
            print(e)

    else:

        if isinstance(event.source, SourceGroup):

            sql4 = "SELECT * FROM `mute` WHERE `group_id`=%s"
            cur.execute(sql4, (event.source.group_id,))
            if cur.rowcount == 0:
                result_word = text_to_word_sequence(text)
                print(result_word)

                line_bot_api.reply_message(
                    event.reply_token, TextSendMessage(text=text))

            else:
                pass
                #line_bot_api.reply_message(
                #    event.reply_token, TextSendMessage(text='Unmute me first with command !unmute '))



        else:
            dev_confirm = ButtonsTemplate(
                title='Right answer?', text='Please select', actions=[
                    PostbackTemplateAction(label='Yes', data='yes_dev'),
                    PostbackTemplateAction(label='No', data='no_dev')
                ])
            dev_confirm2 = TemplateSendMessage(
                alt_text='Buttons alt text', template=dev_confirm)

            regex = r"([a-zA-Z]+)\s+(?=\d)"
            pre_number = re.sub(regex,"",text)
            print(pre_number)
            result_word = text_to_word_sequence(pre_number)
            print(result_word)
            text_array = ",".join(str(bit) for bit in result_word)

            sql = "INSERT INTO `chat_log` (`id`, `uid`, `message`, `time_log`) VALUES (NULL, %s, %s, CURRENT_TIMESTAMP);"
            cur.execute(sql, (event.source.user_id,text_array))

            conn.commit()

            r = requests.post("https://songpurin.me/admin/tfidf/pro.php", data={'line_text': text})
            print(r.status_code, r.reason)
            print(r.text)

            line_bot_api.reply_message(
                event.reply_token, [
                    TextSendMessage(text=r.text),
                    dev_confirm2
                    ])
        #     # define the document
        #     # text = 'The quick brown fox jumped over the lazy dog.'
        #     # tokenize the document
        #     result_word = text_to_word_sequence(text, filters='!"#$%&()*+,-./:;<=>?@[\\]^_`{|}~\t\n', lower=True, split=" ")
        #     #print(result)

        #     line_bot_api.reply_message(
        #         event.reply_token, TextSendMessage(text=result_word))


##    @handler.add(MessageEvent, message=LocationMessage)
##    def handle_location_message(event):
##        line_bot_api.reply_message(
##            event.reply_token,
##            LocationSendMessage(
##                title=event.message.title, address=event.message.address,
##                latitude=event.message.latitude, longitude=event.message.longitude
##            )
##        )
##
##
##    @handler.add(MessageEvent, message=StickerMessage)
##    def handle_sticker_message(event):
##        line_bot_api.reply_message(
##            event.reply_token,
##            StickerSendMessage(
##                package_id=event.message.package_id,
##                sticker_id=event.message.sticker_id)
##        )


# Other Message Type
##@handler.add(MessageEvent, message=(ImageMessage, VideoMessage, AudioMessage))
##def handle_content_message(event):
##    sql7 = "SELECT * FROM `register` WHERE `uid`=%s"
##    cur.execute(sql7, (event.source.user_id,))
##
##
##    if cur.rowcount:
##
##        if isinstance(event.message, ImageMessage):
##            ext = 'jpg'
##        elif isinstance(event.message, VideoMessage):
##            ext = 'mp4'
##        elif isinstance(event.message, AudioMessage):
##            ext = 'm4a'
##        else:
##            return
##
##        message_content = line_bot_api.get_message_content(event.message.id)
##        with tempfile.NamedTemporaryFile(dir=static_tmp_path, prefix=ext + '-', delete=False) as tf:
##            for chunk in message_content.iter_content():
##                tf.write(chunk)
##            tempfile_path = tf.name
##
##        dist_path = tempfile_path + '.' + ext
##        dist_name = os.path.basename(dist_path)
##        os.rename(tempfile_path, dist_path)
##
##        line_bot_api.reply_message(
##            event.reply_token, [
##                TextSendMessage(text='Save content.'),
##                TextSendMessage(text=request.host_url + os.path.join('line/static', 'tmp', dist_name))
##            ])
##
##
##
##    else:
##
##
##        line_bot_api.reply_message(
##                event.reply_token,
##                TextMessage(text="Not allow to use this feature"))
###weird to place here timeout thing wtf SURVEY
##year_template = ButtonsTemplate(
##        title='What\' your year ?', text='Select year of study ?', actions=[
##
##            PostbackTemplateAction(label='1st Year', data='1year'),
##            PostbackTemplateAction(label='2nd Year', data='2year'),
##            PostbackTemplateAction(label='3nd Year', data='3year'),
##            PostbackTemplateAction(label='More to select below', data='nothing')
##
##        ])
##year_message = TemplateSendMessage(
##    alt_text='Buttons alt text', template=year_template)
##
##year_template2 = ButtonsTemplate(
##        title='(Continue)What\' your year ?', text='Select year of study ?', actions=[
##            PostbackTemplateAction(label='4th Year', data='4year'),
##            PostbackTemplateAction(label='More than 4 year', data='5year')
##
##        ])
##year_message2 = TemplateSendMessage(
##    alt_text='Buttons alt text', template=year_template2)
##
##school_template = ButtonsTemplate(
##        title='What is your school ?', text='Select school', actions=[
##            PostbackTemplateAction(label='B.B.A.', data='bba'),
##            PostbackTemplateAction(label='Communication Arts', data='ca'),
##            PostbackTemplateAction(label='Arts', data='arts'),
##            PostbackTemplateAction(label='Other', data='other_school')
##
##        ])
##school_message = TemplateSendMessage(
##    alt_text='Buttons alt text', template=school_template)
##
tell_enter = TextSendMessage(text='Currently developing \n \n !mute = Mute bot')
##gender_template = ButtonsTemplate(
##    title='What\' your gender ?', text='Male or Female ?', actions=[
##
##        PostbackTemplateAction(label='Male', data='Male'),
##        PostbackTemplateAction(label='Female', data='Female')
##    ])
##gender_message = TemplateSendMessage(
##    alt_text='Buttons alt text', template=gender_template)
##
###END SURVEY
##
##
##
##@handler.add(FollowEvent)
##def handle_follow(event):
##
##
##    sql_join = "INSERT INTO `line_user` (`id`, `uid`, `sex`, `year`, `major`, `date_create`) VALUES (NULL, %s, NULL, NULL, NULL, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE `uid` = %s;"
##    cur.execute(sql_join, (event.source.user_id,event.source.user_id,))
##    conn.commit()
##    line_bot_api.reply_message(
##                event.reply_token, [
##                    tell_enter,
##                    gender_message,
##                    year_message,
##                    year_message2,
##                    school_message
##
##                    ]
##            )



@handler.add(FollowEvent)
def handle_follow(event):
   line_bot_api.reply_message(
               event.reply_token, [
                   tell_enter

                   ]
           )


@handler.add(UnfollowEvent)
def handle_unfollow():
    app.logger.info("Got Unfollow event")


@handler.add(JoinEvent)
def handle_join(event):
    line_bot_api.reply_message(
        event.reply_token,
        TextSendMessage(text='Joined this ' + event.source.type))


@handler.add(LeaveEvent)
def handle_leave():
    app.logger.info("Got leave event")

#HANDLE POSTBACK
@handler.add(PostbackEvent)
def handle_postback(event):
    if event.postback.data == 'ping':
        line_bot_api.reply_message(
            event.reply_token, TextSendMessage(text='pong'))
    #select gender
    if event.postback.data == 'Male':
        gender = 1
        sql_male = "SELECT `sex` FROM `line_user` WHERE `uid`=%s AND `sex` IS NOT NULL"
        cur.execute(sql_male, (event.source.user_id,))
        if not cur.rowcount:
            #UPDATE `line_user` SET `sex` = %s WHERE `line_user`.`uid` = %s;
            sql = "UPDATE `line_user` SET `sex` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (gender,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'re Male'))

    if event.postback.data == 'Female':
        gender = 0

        sql_female = "SELECT `sex` FROM `line_user` WHERE `uid`=%s AND `sex` IS NOT NULL;"
        cur.execute(sql_female, (event.source.user_id,))
        if not cur.rowcount:
            #UPDATE `line_user` SET `sex` = %s WHERE `line_user`.`uid` = %s;
            sql = "UPDATE `line_user` SET `sex` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (gender,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'re Female'))

    #Select year

    if event.postback.data == '1year':
        stu_year = 1
        sql_year = "SELECT `year` FROM `line_user` WHERE `uid`=%s AND `year` IS NOT NULL;"
        cur.execute(sql_year, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `year` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (stu_year,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'re 1st Year student'))
    if event.postback.data == '2year':
        stu_year = 2
        sql_year = "SELECT `year` FROM `line_user` WHERE `uid`=%s AND `year` IS NOT NULL;"
        cur.execute(sql_year, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `year` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (stu_year,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'re 2nd Year student'))
    if event.postback.data == '3year':
        stu_year = 3
        sql_year = "SELECT `year` FROM `line_user` WHERE `uid`=%s AND `year` IS NOT NULL;"
        cur.execute(sql_year, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `year` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (stu_year,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'re 3rd Year student'))
    if event.postback.data == '4year':
        stu_year = 4
        sql_year = "SELECT `year` FROM `line_user` WHERE `uid`=%s AND `year` IS NOT NULL;"
        cur.execute(sql_year, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `year` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (stu_year,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'re 4th Year student'))
    #school
    if event.postback.data == 'ca':
        school = 'ca'
        sql_maj = "SELECT `major` FROM `line_user` WHERE `uid`=%s AND `major` IS NOT NULL;"
        cur.execute(sql_maj, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `major` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (school,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'ve select Communication Arts'))
    if event.postback.data == 'bba':
        school = 'bba'
        sql_maj = "SELECT `major` FROM `line_user` WHERE `uid`=%s AND `major` IS NOT NULL;"
        cur.execute(sql_maj, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `major` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (school,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'ve select Management and Economics'))
    if event.postback.data == 'arts':
        school = 'arts'
        sql_maj = "SELECT `major` FROM `line_user` WHERE `uid`=%s AND `major` IS NOT NULL;"
        cur.execute(sql_maj, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `major` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (school,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'ve select Arts'))
    if event.postback.data == 'other_school':
        school = 'other_school'
        sql_maj = "SELECT `major` FROM `line_user` WHERE `uid`=%s AND `major` IS NOT NULL;"
        cur.execute(sql_maj, (event.source.user_id,))
        if not cur.rowcount:

            sql = "UPDATE `line_user` SET `major` = %s WHERE `line_user`.`uid` = %s;"
            cur.execute(sql, (school,event.source.user_id,))
            conn.commit()
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'ve select Other'))
    #school
    if event.postback.data == 'bs':
        school = 'bs'
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'ve select B.S.'))
    if event.postback.data == 'barch':
        school = 'barch'
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'ve select B.Arch'))
    if event.postback.data == 'llb':
        school = 'llb'
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text='You\'ve select School of Law (LL.B.)'))
    
    if event.postback.data == 'no_dev':
        select_last_request = requests.post("https://songpurin.me/admin/tfidf/select_last.php", data={'line_uid': event.source.user_id})
        line_bot_api.reply_message(
                event.reply_token, TextSendMessage(text=select_last_request.text))

@handler.add(BeaconEvent)
def handle_beacon(event):
    line_bot_api.reply_message(
        event.reply_token,
        TextSendMessage(text='Got beacon event. hwid=' + event.beacon.hwid))



if __name__ == "__main__":




    make_static_tmp_dir()

    app.run(host='0.0.0.0',port=os.environ['PORT'])
