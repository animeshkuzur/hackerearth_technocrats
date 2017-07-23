# hackerearth_technocrats

## Project Requirements
* A webserver (Nginx/Apache)
* PHP
* Python
* MySQL Server

## To deploy Laravel Project (on linux) run the following commands
* 'git clone https://github.com/animeshkuzur/hackerearth_technocrats.git'
* Install 'composer'
* `cd hackerearth_technocrats`
* `composer install`
* `cp ./.env.example ./.env`
* `php artisan key:generate`
* Enter the Mysql credentials into `.env ` file
* create new apps in <br/>
'facebook' => http://developer.facebook.com/ , <br/>
'google' => http://console.developer.google.com/ and <br/> 
'twitter' => http://apps.twitter.com/ 
* Copy the `client app id` and `client app secret` to `.env` file <br/>
```
FACEBOOK_ID=<client_id>
FACEBOOK_SECRET=<client_secret>
FACEBOOK_REDIRECT=http://<localhost_url>/auth/facebook/callback

GOOGLE_ID=<client_id>
GOOGLE_SECRET=<client_secret>
GOOGLE_REDIRECT=http://<localhost_url>/auth/google/callback

TWITTER_ID=<client_id>
TWITTER_SECRET=<client_secret>
TWITTER_REDIRECT=http://<localhost_url>/auth/twitter/callback`
* `cd ..`
* `chmod 755 -R ./hackerearth_technocrats`
* `chmod 777 -R ./hackerearth_technocrats/storage`
* `chown <hostname>:www-data -R ./hackerearth_technocrats`
* `php artisan migrate --seed
```

## To deploy Sentiment Analysis script
### Python Dependencies
* tweepy
`pip install tweepy`
* MySQLdb
`apt-get install python-mysqldb`
`pip install mysql-python`
* textblob
`pip install textblob`

### Instructions
* Copy and Paste the twitter api tokens and MySQL credentials into `../hackerearth_technocrats/python/tweeter_scrapper.py`
`access_token = "<twitter_access_token>"
access_token_secret = "<twitter_access_token_secret>"
consumer_key = "<twitter_consumer_key>"
consumer_secret = "<twitter_consumer_secret>"

Mysql_database = "<database>";
Mysql_user = "<mysql_user>";
Mysql_password = "<mysql_password>";`
* Create a new `cron job` in Linux
`crontab -e`
* Add following line into the  `crontab -e `
`*/10 * * * * python <address_to_the_parent_folder>/hackerearth_technocrats/python/tweeter_scrapper.py`



# Live Working Demo
http://139.59.77.96
