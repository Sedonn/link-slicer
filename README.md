# Link-slicer

Web app for link slicing created on PHP with Laravel framework.

## Table of Contents

-   [General info](#general-info)
-   [Technologies](#technologies)
-   [Project Setup](#project-setup)

## General info

This is a study project for learning the [Laravel framework](https://laravel.com). This web app allows users to slice, update and delete their links.

## Technologies

### Core

-   PHP version: 8.0.2
-   [Laravel](https://github.com/laravel/laravel) version: 9.19
-   Apache web-server version: 2.4.29 (Ubuntu)
-   MySQL version: 14.14 Distrib 5.7.39, for Linux (x86_64)
-   Composer version: 2.4.2

### Libraries

-   php-open-source-saver/jwt-auth version: 2.0

## Project Setup

Firstly, it is needed to configure the apache web-server and MySQL database.
The `.env-example` file must be configured and renamed to `.env` before starting the project. Finally, to run app apply following commands:

```bash
composer install
php artisan migrate
php artisan jwt:secret
```
