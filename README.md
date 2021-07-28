# Login Temperatures

## Setup Application

- git clone https://github.com/Dimuthu1234/login-temperature.git

- cd /login-temperature

- composer install

- cp .env.example .env

- change database connection details on your env file

### Get a idea from below .env details

- DB_CONNECTION=sqlite
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=your_path_to_/login-temperature/database/database.sqlite
- DB_FOREIGN_KEYS=true
- DB_USERNAME=your_sql_username
- DB_PASSWORD=your_sql_password

## finally 

- npm install && npm run dev
- php artisan migrate
- php artisan serve

- you can access now [http://localhost:8000](http://localhost:8000)

# System overview

I used TDD (Test Driven Design) and DDD (Domain Driven Design) patterns to implement this login temperature.
because it is very flexible to handle data. Also, folder structure changed according to DDD

you can access app folder in src/app also
domain related data inside the src/domain

# thank you!


