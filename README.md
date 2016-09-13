# conference_web
CSS Conference Application Web &amp; Server Implementation

#Requirements
- PHP 7.x
- MySQL
- Composer
- Lumen Framework

#Setup
1. Download/clone the project.
2. Navigate to the root of the project.
3. Create a copy of the `.env.example` file. Name it `.env`.
4. In your `.env` file, add the following values:
    * For `DB_DATABASE` use the name of a database locally stored on your computer.
    * If your username for your chosen database is different from 'root', then type in that username in `DB_USERNAME`.
    * For `DB_PASSWORD` use the password for your chosen database. If your database has no password then leave this value blank.
    * The other values can be left blank.
    * Save your changes.

#How To Run
1. Navigate to the project directory.
2. Run the Command: 
```
composer install
```
3. If setting up the database for the first time, run the Command:
```
php artisan migrate
```
otherwise, skip this step.

3. Run the Command: 
```
php artisan serve
```

#API End-Points
[Click Here for API End Points](./endpoints.md)


#Database Migrations
##Creating Database Migration
1. Navigate to the root folder of the project.
2. Run the Command:
```
php artisan make:migration name_of_migration
```
3. Note the creation of the file in the ` ./database/migrations ` folder

##Setting Up Database Migration
When in doubt [View Documentation `RTFM`](https://laravel.com/docs/5.2/migrations#introduction)
###Up Function
        The Up function is basically where you make modifications to the database. For example, where you put all the code to create your tables
###Down Function
        The Down function is basically an undo function, where you place code to revert/rollback a migration.

#Database Layout
Conference database
- CID - conference ID [pk]
- Conference name
- Conference type
- Location
- Client ID
- Start Date (will include time)
- End Date (will include time)

Speakers
- Speaker ID [pk]
- Speaker Name
- Speaker affiliation
- Speaker email
- Speaker Tel Number
- Path to Image

Attendees
- Attendee ID [pk]
- Name
- Email
- Salted Password
- Array of con ID [fk] *

Clients
- Related Organisation
- Client ID [pk]
- Contact Name
- Email
- Salted Password
- Address

Categories
- Category ID [pk]
- Name
- Keyword
- Parent ID [fk]

Rooms
- Room ID [pk]
- Name
- Conference ID [fk]

Presentation
- Conference ID [fk]
- Presentation ID [pk]
- Room ID [fk]
- Title
- Abstract
- Key Words
- Array of Cat. ID [fk]

Chat Log
- Chat ID [pk]
- Presentation ID [fk]
- Attendee ID [fk]
- Message
- Date Sent


Sponsors
- Sponsor ID [pk]
- Conference ID [fk]
- Name
- Description
- Path to Image
- Website Link

White List
- Conference ID [pk]
- Attendee ID
- Email
- Token
- Type {email, token}

Black List
- Conference ID [pk]
- Attendee ID

Presentation Speaker
- Speaker ID [fk]
- Presentation ID [fk]
- Speaker Type {Keynote, Discussant}

##Seeding the Database
After you have set up the database that you will be using, run the Command:

```
php artisan db:seed --class=DatabaseSeeder
```

This will seed the clients, conferences, rooms, presentations, speakers, and attendees tables, giving you enough values to test the app.
Check out the official documentation for more information on creating and running seeders.

##Layout
The general layout of the app can be found in the ` ./App Layouts ` folder.

## Source Code Documentation
Documentation for the front-end can be found at ` ./builds/docs `. Click on the index.html file.

Documentation for the back-end can be found at ` ./builds/docs2 `. Click on the index.html file.

Check ` ./storage/logs/lumen.log ` to see sent emails.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).
