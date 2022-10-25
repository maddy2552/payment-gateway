<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Requirements
- PHP 8.1

## Local setup

1. Create .env. Then fill empty secret keys
```shell
cp .env.example .env
```
2. Install dependencies
```shell
composer install
```
3. Generate app key
```shell
php artisan key:generate
```
4. Start docker containers. Get more info at [Sail documentation](https://laravel.com/docs/9.x/sail).
```shell
./vendor/bin/sail up
```
5. Run migrations
```shell
./vendor/bin/sail artisan migrate
```
6. Run seeders
```shell
./vendor/bin/sail artisan db:seed
```
7. Generate ide-helper files
```shell
./vendor/bin/sail composer run ide-helper
```
