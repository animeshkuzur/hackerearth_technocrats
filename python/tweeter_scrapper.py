import sys
from tweepy.streaming import StreamListener
from tweepy import OAuthHandler
from tweepy import Stream
import MySQLdb
import json
from textblob import TextBlob
import re
#import matplotlib.pyplot as plt
#import seaborn

access_token = "887208068609564673-tZ60rekpb1yGe6dahGk1LJ7HnB34YyW"
access_token_secret = "MXJgNlCBPLPoGNdEZZPwjHEdAYfu25xDMwke293g7Qo0O"
consumer_key = "slwNyvUTRoe2AV8yuQlEB4w57"
consumer_secret = "7yUWENgEShdhZoF9lfEcovTh6XKOEdDnlYqeeGsLSzm3Le5mB7"

Mysql_database = "hackerearth";
Mysql_user = "root";
Mysql_password = "anni99K";

tag_id = 0;
tag = [];

class listeners(StreamListener):

    def __init__(self):
        self.counter = 0
        self.limit = 10
        super(listeners, self).__init__()

    def on_data(self, data):
        all_data = json.loads(data)
        try:
            if(all_data['text']):
                conn = MySQLdb.connect("localhost",Mysql_user,Mysql_password,Mysql_database)
                c = conn.cursor()
                c.execute("""INSERT INTO tweets (tag_id,tweets) VALUES (%s,%s);""",(tag_id,all_data['text']))
                conn.commit()
                c.close()
                #print(all_data['text'])
                #print("")
                self.counter += 1
                if self.counter < self.limit:
                    return True
                else:
                    return False
            else:
                pass
        except Exception as e:
            print(e)
            return False
            
    def on_error(self, status):
        print ("Unable to fetch tweets...")
        print (status)

def gettweets(q):
    l = listeners()
    auth = OAuthHandler(consumer_key, consumer_secret)
    auth.set_access_token(access_token, access_token_secret)
    stream = Stream(auth, l)

    stream.filter(track=q,languages=['en'])
    return 0

def gettags():
    tags_row = []
    try:
        conn = MySQLdb.connect("localhost",Mysql_user,Mysql_password,Mysql_database)
        c = conn.cursor()
        c.execute("SELECT id,tag FROM tags WHERE analysed = %s LIMIT 1;",("0"))
        for row in c:
            tags_row.append(row[0])
            tags_row.append(row[1])
        #print(c)
        c.close()
    except Exception as e:
        print('error occured')
        print(e)
    return tags_row

def updatetags(id):
    try:
        conn = MySQLdb.connect("localhost",Mysql_user,Mysql_password,Mysql_database)
        c = conn.cursor()
        c.execute("UPDATE tags SET analysed = %s WHERE id = %s;",("1",str(id)))
        conn.commit()
        c.close()
    except Exception as e:
        print(e)
        print('error occured')
    return 0;

def clean_tweets(tweet):
    return ' '.join(re.sub("(@[A-Za-z0-9]+)|([^0-9A-Za-z \t])|(\w+:\/\/\S+)", " ", tweet).split())

def get_sentiment(text):
    analysis = TextBlob(clean_tweets(text))
    return analysis.sentiment.polarity

def fetch(tag_id):
    try:
        #lang = []
        negative = []
        positive = []
        neutral = []
        #for a in tags:
        pos = 0
        neg = 0
        neu = 0
        tot = 0
        conn = MySQLdb.connect("localhost",Mysql_user,Mysql_password,Mysql_database)
        c = conn.cursor()
        c.execute("SELECT tweets FROM tweets WHERE tag_id = %s;" , (str(tag_id)))
        for row in c:
            test = get_sentiment(row[0])
            if(test > 0):
                pos = pos+1
            elif(test == 0):
                neu = neu+1
            else:
                neg = neg+1
            tot = tot+1
        #print ("For "+a+": ")
        a = conn.cursor()
        a.execute("""INSERT INTO analysed_tags (tag_id,positive,neutral,negative) VALUES (%s,%s,%s,%s);""",(tag_id,format(100*pos/tot),format(100*neu/tot),format(100*neg/tot)))
        conn.commit()
        a.close()

        b = conn.cursor()
        b.execute("""DELETE FROM tweets WHERE tag_id = %s;""",(str(tag_id)))
        conn.commit()
        b.close()
        #lang.append(a)
        #negative.append(100*neg/tot)
        #positive.append(100*pos/tot)
        c.close()
        # plt.hist([positive[0], positive[1], positive[2]], label=[lang[0], lang[1], lang[2]])
        # plt.legend()
        # plt.title("")
        # plt.xlabel("")
        # plt.ylabel("")
        # plt.show()
    except Exception as e:
        print(e)
        print "SQL Error"
    finally:
        pass
    return 0

tags_row = gettags()
if(tags_row):
    tag_id=tags_row[0]
    tag.append(tags_row[1])
    temp = updatetags(tag_id)
    run = gettweets(tag)
    fetch(tag_id)
else:
    sys.exit();
#tag_id=tags_row[0]
#tag.append(tags_row[1])
#temp = updatetags(tag_id)
#run = gettweets(tag)

#fetch(tag_id)