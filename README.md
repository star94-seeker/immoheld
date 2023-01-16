# Immoheld - real estate 

## Server Requirements

PHP version 7.4 or higher is required:

## Installation
- Create the database, the database user.
- Modify the app/Config/Database.php file to utilize the database and database user created in step 1
- Run migrations for create tables
    php spark migrate
- Run seeder for add data into the database
    - php spark db:seed PropertySeeder
    - php spark db:seed PropertyImagesSeeder
- Update your database credentials on Config/Database.php

## run application
-  php spark serve


