from __future__ import print_function


import json
import os
import pymysql

from flask import Flask
from flask import request
from flask import make_response

# Flask app should start in global layout
app = Flask(__name__)

conn = pymysql.connect(host='localhost', port=3306, user='root', passwd='128029486', db='saveme',charset='utf8mb4')
cur = conn.cursor()

@app.route('/webhook', methods=['POST'])
def webhook():
    if request.method == 'POST':
        print(request.json)
        get_what = request.json
        try:
            intent = get_what['result']['metadata']['intentName']
        except Exception as e:
            intent = get_what['result']['action']

        try:
            intent_id = get_what['result']['metadata']['intentId']
        except Exception as e:
            intent_id = "smalltalk.greetings.hello"

                    
        sql_intent = "INSERT INTO `intent` (`id`, `intent`, `intent_id`, `time`,`last_see`) VALUES (NULL, %s, %s,0, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE `time` = `time` + 1, `last_see` = CURRENT_TIMESTAMP;"
        cur.execute(sql_intent, (intent,intent_id))
        conn.commit()
        
        sql_intent_today = "INSERT INTO `today_intent` (`id`, `intent`, `intent_id`, `time`, `intent_day`, `last_see`) VALUES (NULL, %s, %s, 1, DATE(NOW()), CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE `time` = `time` + 1, `last_see` = DATE(NOW());"
        cur.execute(sql_intent_today, (intent,intent_id))
        conn.commit()
        return '', 200
    else:
        abort(400)

    
if __name__ == '__main__':
    app.run(host='127.0.0.1',port=os.environ['PORT'])
