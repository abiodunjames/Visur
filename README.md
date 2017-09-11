# Visur

A PHP application built with lumen framework for network security monitoring that integrates well with your existing [Security Onion](http://www.dropwizard.io/1.0.2/docs/) server. The main goal is to build this in place of  [Snorby](https://github.com/Snorby/snorby) that is no longer supported in security onion 14 and above.
![image](https://user-images.githubusercontent.com/14722744/30273862-b81d572e-96f2-11e7-8d84-bf269f6e5b4b.png)
![image](https://user-images.githubusercontent.com/14722744/30086586-b5b04dc4-9293-11e7-9be1-355f09cac3f6.png)


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

### Prerequisites
    PHP >= 5.5.9
    OpenSSL PHP Extension
    PDO PHP Extension
    Mbstring PHP Extension

        
### Local Deployment
For local deployment, this instruction assumes you already have a security onion database.

1. Clone Visur repository 
```
git clone https://github.com/abiodunjames/Visur.git
```

2. Install Visur dependencies using composer
```
$ cd /path/to/visur/directory/visur
$ composer install
$ php artisan key:generate
```
3. Set security onion database connection parameters in .env file at the Visur root folder

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=securityonion_db
DB_USERNAME=securityoniondbuser
DB_PASSWORD=securityoniondbuserpassword
```
On windows environment, navigate to  ``` http://{yourhost}/{visur_directory/public  ```. Visur should come up with an interface shown above.  

### Production Deployment
Visur was tested on Ubuntu 14.04  and the following steps assume that you have a running security onion instance.  You will need to install some few things to ensure PHP compatibility with Visur.

1.  Clone Visur directory. 

```
    $ cd /var/www/
   $ git clone https://github.com/abiodunjames/Visur.git
   ```
   
   
2.  Upgrade php version to 5.6 . Instructions on how to upgrade are provided [here!](https://tecadmin.net/install-php5-on-ubuntu/)
3. Visur needs mbstring and other php packages to run. Install them.

```
    sudo apt-get update
    sudo apt-get install php5.6-xml
    sudo apt-get install php-mbstring
   ```
 4. Install Visur dependencies
  
```
    $ cd /path/to/visur/root/
    $ composer install
    $ php artisan key:generate
   ```
 5. Make  ``` storage ``` and ``` vendor ``` folder writable by apache user
   ```
   $ sudo chown -R www-data:www-data /path/to/your/project/vendor
   $ sudo chown -R www-data:www-data /path/to/your/project/storage
   ```
4. Duplicate existing security onion virtual host configuration file
 ```
$ cd /etc/apache2/sites-available
 $ sudo cp securityonion.conf visur.conf   
  ```
5. Edit visur.conf to reflect the following
 ```
sudo vim /etc/apache2/sites-available/yoursite.conf 

 ```
 Add your Server name and alias
 ```
 ServerName yourinternaldomain.com
 ServerAlias yourinternaldomain.com
 ```
 Change the directory section of the configuration file to
 ```
 <Directory /var/www/visur/directory/public>
         Options Indexes FollowSymLinks MultiViews
         AllowOverride All
         Order allow,deny
         allow from all
     </Directory>
 ```
 Enable Visur 
  ```
  $ sudo a2ensite visur
  ```
 6. Restart or reload apache
  ```
 $ sudo service apache2 restart
 ```
 7. Access visur  at ```  https://yourinternaldomain.com```
 
 
## TODO
1. Authentication and Authorization
2. More  dashboards
3. Real time analytics
4. Email notification

## Built With

* [Lumen 5.2](https://lumen.laravel.com)

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Samuel James** 


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments
* [Gantelella](https://colorlib.com/polygon/gentelella/index.html) 

