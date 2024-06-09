<h1 align="center">
    <a href="https://ozvid.com" title="ozvid" target="_blank">
        <img width = "20%" height = "20%" src="https://ozvid.com/themes/base/images/web_logo.png" alt="Ozvid Logo"/>
    </a>
    <br>
    <hr>
</h1>

The main objective of this project is to deploy a “car booking” platform that will help users to search for a booking car.




##Installation

To install script module

```
git clone http://192.168.10.42/yii2/taxi-booking-yii2-1924
```

Storage folder must have 
```
app, framework, logs
```
Rename .env.example file to .env and change db credentials 
```
databse credentials
```
To install database and project setup run this command

```
bash setup.sh

```
To make backup work

```
Give read and write permissions to app folder located in storage and backup folder located in public folder

```

To install specific Seed run this command

```
php artisan db:seed --class=AdminSeeder

```
To install Migration with Seed run this command

```
php artisan migrate:fresh --seed
```
To generate a key (No need if setup.sh command run)

```
php artisan key:generate 
``` 
If you have composer.json

```
composer install --prefer-dist 
```

If you need to update vendor again you can use followig command

```
composer update --prefer-dist --prefer-stable
```

## Usage
Once setup is done you need to follow the final setup with the installer .

make sure you give READ/WRITE permission to your folder.
```

When you add module you have to update your composer.json file

```
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules/",
        }
    },
```
Then run following command

```
composer dumpautoload
```

## License

**www.ozvid.com** 

