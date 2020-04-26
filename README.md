## SETUP

laravel needs special permissions for writing in the storage folder, please change it with chmod if using linux/mac

I decided to use MySQL as I have a server already running, with a large set of data Mongo would have better performances.

- Create a database in mysql

move in the project directory and:

run `cp .env.example .env`

in the .env setup the lines

```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

run `php artisan key:generate`

run `composer install`

run `php artisan migrate`

run `php artisan db:seed`

run `php artisan serve` to start the web server


The command db:seed will create a user and 2 players

```
username: root@united.remote
password: root
```

to import the hands.txt file after the login please select import from the menu (/import) or use the artisan command

`php artisan import:hands {{$filePath}}`

the results will be available in the dashboard (/home)

After some research I decided to use the "Cactus kev" solution with a lookup table for the 7ksh combination. 

I found a PHP implentation of the algo at https://github.com/czarpino/pokerank, I added just minor changes to that implementation.


TIE is not marked as a WIN


please feel free to contact me for any issue running this project
