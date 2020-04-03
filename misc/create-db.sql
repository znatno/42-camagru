# Initialization of Camagru Database

CREATE DATABASE db_ibohun;
USE db_ibohun;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS photos;
DROP TABLE IF EXISTS likes;
DROP TABLE IF EXISTS comments;

CREATE TABLE users
(
    `id`                INT UNSIGNED    NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username`          VARCHAR(30)     NOT NULL,
    `email`             VARCHAR(100)    NOT NULL,
    `notifications`     BOOL            NOT NULL DEFAULT 0,
    `password`          VARCHAR(1000)   NOT NULL,
    `confirmed`         BOOL            NOT NULL DEFAULT 0

);

CREATE TABLE photos
(
    `id`                INT UNSIGNED    NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username`          VARCHAR(30)     NOT NULL,
    `user_id`           INT UNSIGNED    NOT NULL,
    `path`              TEXT            NOT NULL,
    `timestamp`         DATETIME        NOT NULL,
    `likes`             INT UNSIGNED    NOT NULL DEFAULT 0,
    `comments`          INT UNSIGNED    NOT NULL DEFAULT 0,

    FOREIGN KEY (`user_id`)     REFERENCES users (`id`)         ON DELETE CASCADE
);

CREATE TABLE likes
(
    `photo_id`          INT UNSIGNED    NOT NULL,
    `user_id`           INT UNSIGNED    NOT NULL,

    FOREIGN KEY (`photo_id`)    REFERENCES photos (`id`)        ON DELETE CASCADE,
    FOREIGN KEY (`user_id`)     REFERENCES users (`id`)         ON DELETE CASCADE,
    PRIMARY KEY (`photo_id`, `user_id`)
);

CREATE TABLE comments
(
    `photo_id`          INT UNSIGNED    NOT NULL,
    `user_id`           INT UNSIGNED    NOT NULL,
    `comment`           TEXT            NOT NULL,
    `timestamp`         DATETIME        NOT NULL,

    FOREIGN KEY (`photo_id`)    REFERENCES photos (`id`)        ON DELETE CASCADE,
    FOREIGN KEY (`user_id`)     REFERENCES users (`id`)         ON DELETE CASCADE,
    PRIMARY KEY (`user_id`, `timestamp`)
);


