## Chatbot

Small project for MIS major.



## Installation

### Install necessary software
```
apt-get update
apt-get install python-pip3
apt-get install nginx

apt-get install mysql
apt-get install phpmyadmin

add-apt-repository ppa:certbot/certbot
apt-get update
apt-get install python-certbot-nginx 
```

### Edit Nginx

nano /etc/nginx/sites-available/default

-- edit as follow 
```
		server_name dreamcatcherbkk.me;
	location / {
        # First attempt to serve request as file, then
        # as directory, then fall back to displaying a 404.
        try_files $uri $uri/ =404;
	}

	location /line/ {
        proxy_set_header X-Forward-For $proxy_add_x_forwarded_for;
        proxy_set_header Host $http_host;
        proxy_redirect off;
        proxy_pass http://127.0.0.1:8000/;
        
    	}
	

	# pass PHP scripts to FastCGI server
	#
	location ~ \.php$ {
		include snippets/fastcgi-php.conf;
	#
	#	# With php-fpm (or other unix sockets):
		fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
	#	# With php-cgi (or other tcp sockets):
	#	fastcgi_pass 127.0.0.1:9000;
	}

	# deny access to .htaccess files, if Apache's document root
	# concurs with nginx's one
	#
	location ~ /\.ht {
		deny all;
	}
```

service nginx restart

### Install Cert for HTTPs

```
certbot --nginx -d urdomain.com
```


### Clone git

```
git clone https://github.com/manutzsong/chatbot
```


### Import MySQL

```
mysql -u root -p
create database saveme ** or whatever name you like **
use saveme
source saveme.sql **database file location **
```

### Link phpmyadmin
ln -s /usr/share/phpmyadmin /var/www/html ---- Link phpmyadmin to www



### Edit LINE API Key and Dialogflow API Key

nano app.py

-- edit as follow

```
	channel_secret = 'ur room'
	channel_access_token = 'ur token'
	
	CLIENT_ACCESS_TOKEN = 'ur dialogflow secret key'
```

### Move file

	* Create new folder
		- /home/**new folder**
	
	* Move in file
		- move both app.py and requirements.txt

### Install requirements.txt		
	
```	
pip3 install -r requirements.txt
```

gunicorn -b 127.0.0.1 app:app

apt-get supervisor

move chatbot.conf to /etc/supervisor/conf.d

nano chatbot.connf
--edit directory to app.py

supervisorctl add chatbot
supervisorctl update

supervisorctl restart chatbot

************
Edit LINE Developer Webhook URL to

https://urdomain.com/line/callback

DONE

## Test

Enter this url
https://urdomain.com/line/callback

If it show Method not Allow, mean work!