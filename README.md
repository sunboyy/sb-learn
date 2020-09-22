# SB Learn

A simple and configurable flashcard web application.

## Requirements

- Apache with PHP support
- MySQL with connector from PHP

## Setting up

- Create MySQL database
- Copy `src/php/config-config.php` to `src/php/config.php` and change your MySQL credentials
- Set home path at `currenthome` variable in `src/js/main.js`

## Running

Run on Apache web server with PHP and MySQL installed

## Running on docker

You need to have docker and docker-compose installed, then ru this command to get the app running
`make up`

## Usage

- Add user and group by manually insert into user database.
- Only password is required to login.

## Contribution

Feel free to contribute to this project. However, only bug fixes are open for contribution since we are going to develop a new version based on newer architecture and newer technology like React or Angular for front-end development and Node.js for back-end development. The decision will be made soon. Any update to the new version of SB Learn will be reported in this repository.
