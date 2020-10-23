#!/usr/bin/env bash

# Drop AllTables And Migrate It Again
php artisan migrate:fresh

# Seed DB
php artisan db:seed

# Install Passport Access Token
php artisan passport:install --force

