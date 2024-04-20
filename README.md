# Simple Laravel Blog
- This is a simple blog backend built with laravel. The frontend is available in react

## Clone the Repository:
- Open your terminal or command prompt.
- Navigate to the directory where you want to store your project.
- Clone the repository https://github.com/toosoft/laravelblog.git

## Install Dependencies:
- Navigate into the cloned project directory using the cd command.
- Run composer install to install PHP dependencies specified in the composer.json file.
- Run npm install or yarn install to install JavaScript dependencies if there is a package.json file present.

```bash
cd repository &&
composer install
npm install
```


## Create Environment File:
- Make a copy of the .env.example file and rename it to .env.
- Open the .env file and configure database and other environment variables as needed.
```bash
cp .env.example .env
```

- Update .env file with necessary configurations

- Generate Application Key:
- Run the php artisan key:generate command to generate a unique application key.
php artisan key:generate

## Run Migrations and Seeders (if applicable):
- Run php artisan migrate to execute outstanding migrations and create database tables.
- Optionally, run php artisan db:seed to populate the database with initial data if there are seeders defined.

```bash
php artisan migrate
php artisan db:seed ### If applicable
```

## Serve the Application:
- Run php artisan serve to start the Laravel development server.
- By default, the server runs on http://localhost:8000, but you can specify a different port with the --port option if needed.

```bash
php artisan serve
```

## Access the Application:
- Open your web browser and navigate to the URL where the Laravel application is being served.
- For example, http://localhost:8000 navigate to http://localhost:8000/blog
- You will be asked to login to access the blog; or you can create account at http://localhost:8000/register
