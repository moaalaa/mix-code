#!/usr/bin/env bash

# Install Dependises
composer install

# Copy .env file
cp .env.example .env

# Generate Application Key
php artisan key:generate

# Migrate and Seed
php artisan migrate --seed

# Install Laravel Passport Tokens
php artisan passport:install

