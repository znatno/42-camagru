CREATE DATABASE db_ibohun;
USE db_ibohun;
CREATE TABLE users
(
    id SMALLINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(20) not null
);
INSERT INTO users ( id, name )
VALUES (null, 'Alex'),
       (null, 'John'),
       (null, 'Vlad'),
       (null, 'Hennadiy'),
       (null, 'Arkadiy'),
       (null, 'Jay'),
       (null, 'Nataly');
