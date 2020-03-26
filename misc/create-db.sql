CREATE DATABASE db_ibohun;
USE db_ibohun;
DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(1000) NOT NULL,
    password VARCHAR(1000) NOT NULL,
    confirm BOOL NOT NULL DEFAULT 0
);

ALTER TABLE db_ibohun.users ADD notifications BOOL NOT NULL
    AFTER email;

ALTER TABLE db_ibohun.users CHANGE `confirm` `confirmed` BOOL NOT NULL DEFAULT 0;
ALTER TABLE db_ibohun.users CHANGE `notifications` `notifications` BOOL NOT NULL DEFAULT 0;

# INSERT INTO users (id, username)
# VALUES (null, 'Alex'),
#        (null, 'John'),
#        (null, 'Vlad'),
#        (null, 'Hennadiy'),
#        (null, 'Arkadiy'),
#        (null, 'Jay'),
#        (null, 'Nataly');




