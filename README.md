# hostel-booking-system
A modern and user-friendly hostel booking system built with laravel with Vue. This project aims to provide a seamless experience for users to find and book hostels
# Dependencies
This project uses Laravel 10, Vue 3, and TailwindCSS 3
You should have Composer and Node (npm) installed

# Installation
After cloning,

1. Install both Laravel dependencies and Vue (Node) dependencies 
```
composer install
```
```
npm install
```

2. Configure `.env`

```
cp .env.example .env 
```
Then set your database details (username, DB name, password)

3. Generate app key
```
php artisan key:generate
```

4. Create Database
```
php artisan migrate
```
5. Run the servers
```
php artisan serve 
```

```
npm run dev
```
