DROP TABLE IF EXISTS db_ibohun.photos;
CREATE TABLE photos
(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    path TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    timestamp DATETIME NOT NULL,
    likes INT UNSIGNED NOT NULL,
    comments TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES db_ibohun.users(id)
);
