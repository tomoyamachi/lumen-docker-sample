#!/bin/sh
while true;
do
    php artisan queue:work --daemon
done