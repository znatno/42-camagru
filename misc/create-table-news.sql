USE db_ibohun;
CREATE TABLE news
(
    id SMALLINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title text not null,
    text text not null
);
INSERT INTO news ( id, title, text )
VALUES (null, 'News 1', 'Lorem Ipsum'),
       (null, 'News 2', 'Dolor Set Amet');

