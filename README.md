<p align="center"><a href="https://laravel.com" target="_blank"><img src="hth="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://app.travis-ci.com/Tetranyble/harde.svg?branch=main" alt="Build Status"></a>
</p>

## Full stack Laravel Developer Assessment (Harde Business School)



###Introduction
This is a short coding assessment, in which you will implement a REST API that calls an external
API service to get information about books. Additionally, you will implement a simple CRUD
(Create, Read, Update, Delete) API with a local database of your choice.
The external API that will be used here is the Ice And Fire API. This API requires no sign up /
authentication on your part.

To evaluate this project, simply clone this project repo and run composer command like so `composer install` from the project root directory

## Setup

- Add an environment variable `"ICE_BASE_URI="anapioficeandfire.com/api/"` to the `.env` file
- setup your test database and add the credential to the following environment variables
     - `DB_DATABASE=harde`
     - `DB_USERNAME=root`
     - `DB_PASSWORD=`
     
     Note: I am guessing you'll be using `MySql` database with it's default port and configuration
     
- run `php artisan migrate --seed` to have a working record in your database
- got to `http:localhost:8000/books`

## Test

There are a total of 13 test and one would be contacting an external api.
I expect that your computer should be connected to the internet for this test to pass as i did not
mock the test.
Also, I the test uses `in-memory` database, it should all pass without setup actual database.

simply run `php artisan test` and vola! done!

### Final thought
I would to thank you for this opportunity. And I look forward to working with your organisation.

## License

This test project is open-sourced licensed under the [MIT license](https://opensource.org/licenses/MIT).
