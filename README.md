## System Requirements
This is a Symfony2 web app. In order to run you would need to have below requirements.

#### Symfony2 requirements:

Symfony2 is only supported on PHP 5.3.3 and up.

Be warned that PHP versions before 5.3.8 are known to be buggy and might not
work for you:

 * before PHP 5.3.4, if you get "Notice: Trying to get property of
   non-object", you've hit a known PHP bug (see
   https://bugs.php.net/bug.php?id=52083 and
   https://bugs.php.net/bug.php?id=50027);

 * before PHP 5.3.8, if you get an error involving annotations, you've hit a
   known PHP bug (see https://bugs.php.net/bug.php?id=55156).

 * PHP 5.3.16 has a major bug in the Reflection subsystem and is not suitable to
   run Symfony2 (https://bugs.php.net/bug.php?id=62715)


## Installation

1. Clone the master branch or grab the latest from releases and unzip the file on the web server. 

    	git clone https://github.com/dream89/verno-demo.git

2. Change directory to app root and install composer. 

    	cd verno-demo
    	curl -sS https://getcomposer.org/installer | php
    	php composer.phar selfupdate


3. Rename app/configs/parameters.yml.dist to parameters.yml.
 
		cp app/config/parameters.yml.dist app/config/parameters.yml

4. Create directories for cache and logs.

		mkdir -p app/cache
		mkdir -p app/logs

5. Install dependencies using composer.
 
		php composer.phar install

6. Configure your database settings in app/config/parameters.yml.

7. Build the database and load fixtures with below command.

		sh update-schema.sh

8. Run server using Symfony built-in command

		php app/console server:run

   ( Alternatively you can point your web server's root to the web directory in the app. Now goto http://your-domain/ )
   
   And you should see the login page.
   
	 default user:
	   		username: su001
	   		password: pass123
