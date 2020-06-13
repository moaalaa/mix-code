# Good

## Prerequisites
> This Project Required Composer To Be Installed And PHP 7.1 Or Above
- PHP 7.1 Or Above 
- [Composer](https://getcomposer.org/)

## Online API Docs
[Postman API Docs](https://documenter.getpostman.com/view/2384729/SzYXWz3s?version=latest)

## Installation

### Clone The Project

```bash
$ git clone https://github.com/hamzaomar92/good/
$ cd Good
```

### Install Composer Dependencies 

```bash
$ composer install
```
### Create .env Then Edit It

```bash
$ cp .env.example .env
```

### Generate Laravel Key 

```bash
$ php artisan key:generate
```

### Migrate The DB 

```bash
$ php artisan migrate
```
OR

### Migrate The DB With Seed

```bash
$ php artisan migrate --seed
```

### Run The Server

```bash
$ php artisan serve
```
