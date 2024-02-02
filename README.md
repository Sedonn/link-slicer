# Link-slicer

The web service for link shorting created with Laravel on PHP.

## Table of Contents

- [Link-slicer](#link-slicer)
  - [Table of Contents](#table-of-contents)
  - [General info](#general-info)
  - [Technologies](#technologies)
    - [Core](#core)
    - [Libraries](#libraries)
  - [Environment](#environment)
  - [Project Setup](#project-setup)
    - [Development mode](#development-mode)
    - [Production mode](#production-mode)

## General info

This is a study project for learning the [Laravel framework](https://laravel.com). This web app allows users to slice, update and delete their links.

## Technologies

### Frontend

- [Start Bootstrap SB Admin 2](https://github.com/StartBootstrap/startbootstrap-sb-admin-2) version: 4.0.7

### Core

- PHP version: 8.2.15
- MySQL version: 8.3.0 for Linux on x86_64 (MySQL Community Server - GPL)
- Composer version: 2.6.6

### Libraries

- [Laravel](https://github.com/laravel/laravel) version: 9.52.1
- php-open-source-saver/jwt-auth version: 2.1.0

## Environment

- `APP_KEY`- Laravel app key, can be generated with `php artisan key:generate --show` command
- `MYSQL_ROOT_PASSWORD`- The root password of the DB
- `MYSQL_PASSWORD`- Password for the `mysqladmin` user
- `JWT_SECRET`- JWT secret, can be generated with `php artisan jwt:generate --show` command

## Project Setup

**The project launch requires Docker**. The Project launch is configured in two modes:

- `development`
- `production`

The `.env.{mode}.example` file must be configured and renamed to `.env.{mode}` before starting the project.

### Development mode

To run the project in the `development` mode run following script `start-development.bat`.

To run artisan migrations apply following command in the `link-slicer-server-dev` container:

```bash
php artisan migrate
```

### Production mode

To run the project in the `production` mode run following script `start-production.bat`

To run artisan migrations apply following command in the `link-slicer-server` container:

```bash
php artisan migrate --force
```
