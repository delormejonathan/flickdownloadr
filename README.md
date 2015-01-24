# FlickDownloadr

This application allows you to share your private albums from Flickr with your family and your friends.

## Usage

Access to the application here : http://flickr.delormejonathan.fr/

Log in with Flickr, you will see your albums. You can share an album with a limited duration (1 day, 1 week, 1 month). You will get a link to share your album with everyone.

## Installation

```cli
git clone https://github.com/delormejonathan/flickdownloadr.git
cd flickdownloadr
composer install
(Adjust chmod on app/storage to add read/write for web server)
touch app/database/production.sqlite
php artisan migrate
php artisan config:publish anahkiasen/flickering
```

Add your API key & secret for Flickr in app/config/packages/anahkiasen/flickering/config.php.

Generate a security salt for OAuth and paste it in app/config/packages/anahkiasen/flickering/opauth.php.
To generate the salt you can use this command :

```php
php -r "echo sha1(uniqid());"
```

#### Important

There is currently a bug due to an older package. You have to modify a file to make this application works with the Flickr API. Modifiy this file : vendor/opauth/flickr/FlickrStrategy.php and replace *http* with *https*.

## Screenshots

![My image](http://img15.hostingpics.net/pics/994151screen.png)
