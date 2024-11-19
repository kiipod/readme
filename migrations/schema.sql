CREATE DATABASE readme CHARACTER SET utf8 COLLATE utf8_general_ci;
USE readme;

/* Таблица пользователей */
CREATE TABLE users (
    id int AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    login VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    avatar_file VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
);

/* Таблица хештегов */
CREATE TABLE hashtags (
    id int AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL
);

/* Таблица публикаций */
CREATE TABLE posts (
    id int AUTO_INCREMENT PRIMARY KEY,
    creator_id int NOT NULL,
    type_id int NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    text TEXT NOT NULL,
    image VARCHAR(255),
    video_link VARCHAR(255),
    author_quote VARCHAR(255),
    link VARCHAR(255),
    view_stats int NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (creator_id) REFERENCES users(id),
    FOREIGN KEY (type_id) REFERENCES type_posts(id)
);

/* Таблица для репостов */
CREATE TABLE reposts (
    id int AUTO_INCREMENT PRIMARY KEY,
    post_id int NOT NULL,
    reposted_user_id int NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (reposted_user_id) REFERENCES users(id)
);

/* Таблица связи хештегов с публикацией */
CREATE TABLE post_hashtags (
    id int AUTO_INCREMENT PRIMARY KEY,
    post_id int NOT NULL,
    hashtag_id int NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (hashtag_id) REFERENCES hashtags(id)
);

/* Таблица связи комментария с публикацией */
CREATE TABLE comments (
    id int AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    post_id int NOT NULL,
    commentator_id int NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (commentator_id) REFERENCES users(id)
);

/* Таблица связи лайков с публикациями */
CREATE TABLE post_likes (
    id int AUTO_INCREMENT PRIMARY KEY,
    post_id int NOT NULL,
    like_user_id int NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (like_user_id) REFERENCES users(id)
);

/* Таблица подписчиков пользователя */
CREATE TABLE subscribers (
    id int AUTO_INCREMENT PRIMARY KEY,
    subscriber_id int NOT NULL,
    subscribed_id int NOT NULL,
    FOREIGN KEY (subscriber_id) REFERENCES users(id),
    FOREIGN KEY (subscribed_id) REFERENCES users(id)
);

/* Таблица сообщений пользователей */
CREATE TABLE chats (
    id int AUTO_INCREMENT PRIMARY KEY,
    sender_id int NOT NULL,
    recipient_id int NOT NULL,
    text TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (recipient_id) REFERENCES users(id)
);

/* Таблица типов публикации */
CREATE TABLE type_posts (
    id int AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    class VARCHAR(128) NOT NULL
);
