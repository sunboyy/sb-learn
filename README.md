# SB Learn

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
