# internship-project
download xampp( https://www.apachefriends.org/download.html)
After complition start xampp
create database with the name "user_registration"
creat table name "users"
if didn't then try on this sql" CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY (id)
);"
If any error without reset password link then remove (php code) from register.php file.
few file just for try to make more corrret code.
phpmyliar install first when you ren code


