CREATE DATABASE db_ibohun;
USE db_ibohun;
DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id SMALLINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(30) NOT NULL,
    email VARCHAR(1000) NOT NULL,
    password VARCHAR(1000) NOT NULL,
    confirm BOOL NOT NULL DEFAULT 0
);

# INSERT INTO users (id, username)
# VALUES (null, 'Alex'),
#        (null, 'John'),
#        (null, 'Vlad'),
#        (null, 'Hennadiy'),
#        (null, 'Arkadiy'),
#        (null, 'Jay'),
#        (null, 'Nataly');




