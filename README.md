# Movielister
The project reads XML files and make a web accessible database of it.

This project is still heavily in progress and sure as hell isn't ready for the open yet :)

#### What it will do in the end:
- Ability to scan your given local/network storage location recursively for xml/nfo based files
- Add the contents of the xml file in a relational database
- Search movies based by year, actors/actresses, directors, studio
- Basically a simplified self hosted version of your own IMDB of your own movie collection.

#### Requirements:
- Optional: A web-server that supports PHP 7.0 or higher 
- PHP 7.0 or higher (either CLI or through optional web-server)
- PHP 7.0 Modules: PDO (MySQL)
- PHP Composer (for vendor and autoloader)
- MySQL/MariaDB

#### Initialisation:
- Go to the project folder, and use: `php composer.phar install` (make sure PHP binary works)

#### Usage:
- You can get all accessible parameters for CLI by typing `php parser.php --help` in the console
- For web based, you can use `http://localhost/parser.php?help` for a list of options in your URL. For this to work, parser.php should be accessible by the web-server, and PHP interpreter should work.