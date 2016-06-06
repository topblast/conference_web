# conference_web
CSS Conference Application Web &amp; Server Implementation

#Requirements
- PHP 7.x

#How To Run
1. Navigate to the project directory.
2. Run the Command: 
```
php -S localhost:8000 -t public
```
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

## Official Documentation

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).
