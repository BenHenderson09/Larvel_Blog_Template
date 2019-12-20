# Larvel-Blog-Template
This application was developed to provide an easy way to quick-start any blogging related website with minimal unnecessary features.

## Application Details
- Built with PHP and the Laravel framework
- Full Create Read Update and Delete functionality for posts
- Secure authentication system
- Supports multiple databases
- Uses Bootstrap for CSS

## Usage
In order to use this template, some configuration must be implemented. You will firstly need to securely serve the application from your
server, this is a relatively straightforward process, but it depends on what server you use. E.G: In Apache, a virtual
host must be created to directly access the public directory of your site. Without this setup, a user can easily inspect the whole
structure of your project through their browser. This would pose a huge security risk.

Next, you must edit your `.env` file and insert the credentials for your database. Setting up the database structure is very easy,
thanks to database migrations. In the `database/migrations` directory, some files have been created to make managing the database
structure very easy. To build the structure into your database, simply run `php artisan migrate`.
