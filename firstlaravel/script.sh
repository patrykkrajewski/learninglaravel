#!/bin/bash

# Start Laravel server in the background
php artisan serve --host=0.0.0.0 &

# Start Vite for frontend development in the background
npm run dev &

# Wait for both processes to exit
wait
