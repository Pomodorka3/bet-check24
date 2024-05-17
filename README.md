# Bet GenDev CHECK24 Challenge
This project is a simple betting system that allows users to place bets on the outcome of the games of the European Championship 2024.  
It was developed as a part of an application process to the [CHECK24 GenDev Scholarship](https://www.talents.check24.de/gendev).  
All project requirements are described in the [challenge description](https://github.com/check24-scholarships/check24-betting-challenge).

## How to run it on your own machine?

1. `npm install`
2. Create empty database (use either MySQL or SQLite) and configure database either in `.env` file or in `config/app.php`
3. `php artisan migrate`
4. **either** `npm run dev` - run website as a server with hot reloading
5. **or** `npm run build` - build assets and reload page (usually when deploying live)

## How to understand what happens in the code?
1. Search for an entering-point of your request into web application in `routes/web.php`.
   Every route hast it's name and *controller* which processes the request.
2. Open controller specified in route selected in previous step and search for a method also specified in routes file.
3. Open view which is returned in the end of a controlled method - in case any view (e.g. `index.blade.php`) is returned.
4. If there is `<livewire:something>`in a view, have a look for a Livewire controller inside `app/Livewire/` directory (in this case it would be `app/Livewire/Something.php`. There could be a lot of logic implemented in a Livewire controller.

## Possible improvements




## Technologies used:
- PHP  8.3.6
- [Laravel 11](https://laravel.com/)
    - Laravel Breeze for user authentication
- [Livewire v3](https://livewire.laravel.com/) with Alpine.js
- MySQL

## Architecture UML Diagram
![UML Class diagram](./OTHER/Bet_uml_class_diagram.png "Title")

## User Authentication
Database table: `users`
Is implemented with use of Laravel Breeze package. Although in requirements stands, that no password is needed (only username is sufficcient to log in) I left it with username:password (by default), as it is not such important part of this project, as betting mechanics is.
If really only username without password will be needed to login, change `app/Livewire/Forms/LoginForm.php`.

## Communities
Database table: `communities`
Interaction with communities happens inside `app/Http/Controllers/CommunityController.php`. It is a so-called *resource controller* which provides *CRUD* functionality.
