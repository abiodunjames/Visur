# Visur

A PHP application built with lumen framework for network security monitoring that integrates well with your existing [Security Onion](http://www.dropwizard.io/1.0.2/docs/) server. The main goal is to build this in place of  [Snorby](https://github.com/Snorby/snorby) that is no longer supported from security onion 14 and above.
![image](https://user-images.githubusercontent.com/14722744/30086569-9fdfc6c8-9293-11e7-918b-885a49aeb543.png)

![image](https://user-images.githubusercontent.com/14722744/30086586-b5b04dc4-9293-11e7-9be1-355f09cac3f6.png)


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

### Prerequisites
    PHP >= 5.5.9
    OpenSSL PHP Extension
    PDO PHP Extension
    Mbstring PHP Extension


```

```

### Installing
          
1. Clone Visur repository 
```
git clone https://github.com/abiodunjames/Visur.git
```
2. Install Visur dependencies using composer
```
composer install
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

