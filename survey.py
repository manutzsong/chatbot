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

#weird to place here timeout thing wtf SURVEY
year_template = ButtonsTemplate(
        title='What\' your year ?', text='Select year of study ?', actions=[
            
            PostbackTemplateAction(label='1st Year', data='1year'),
            PostbackTemplateAction(label='2nd Year', data='2year'),
            PostbackTemplateAction(label='3nd Year', data='3year'),
            PostbackTemplateAction(label='More to select below', data='nothing')
            
        ])
year_message = TemplateSendMessage(
    alt_text='Buttons alt text', template=year_template)

year_template2 = ButtonsTemplate(
        title='(Continue)What\' your year ?', text='Select year of study ?', actions=[
            PostbackTemplateAction(label='4th Year', data='4year'),
            PostbackTemplateAction(label='More than 4 year', data='5year')
            
        ])
year_message2 = TemplateSendMessage(
    alt_text='Buttons alt text', template=year_template2)

school_template = ButtonsTemplate(
        title='What is your school ?', text='Select school', actions=[
            PostbackTemplateAction(label='B.B.A.', data='bba'),
            PostbackTemplateAction(label='Communication Arts', data='ca'),
            PostbackTemplateAction(label='Arts', data='arts'),
            PostbackTemplateAction(label='Other', data='other_school')
            
        ])
school_message = TemplateSendMessage(
    alt_text='Buttons alt text', template=school_template)

tell_enter = TextSendMessage(text='Please tell us following question \n \n Gender \n Currently year study \n School \n \n Once done press Confirm in confirm dialogue')
gender_template = ButtonsTemplate(
    title='What\' your gender ?', text='Male or Female ?', actions=[
        
        PostbackTemplateAction(label='Male', data='Male'),
        PostbackTemplateAction(label='Female', data='Female')
    ])
gender_message = TemplateSendMessage(
    alt_text='Buttons alt text', template=gender_template)

#END SURVEY