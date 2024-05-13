CREATE DATABASE event;
USE event;

CREATE TABLE user(
    user_id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(80) NOT NULL,
    email varchar(80) NOT NULL,
    password varchar(100) NOT NULL
);

CREATE TABLE event (
    event_id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(80) NOT NULL,
    description varchar(300) NOT NULL,
    status varchar(45) NOT NULL,
    vagas int NOT NULL,
    preco decimal(2,10) NOT NULL,
    date DATETIME NOT NULL,
);

CREATE TABLE tickt (
    tickt_id int PRIMARY KEY AUTO_INCREMENT,
    user_id int NOT NULL,
    event_id int NOT NULL,
    buy_date DATE  NOT NULL DEFAULT CURRENT_TIMESTAMP
    id binary(16),
    FOREIGN KEY (user_id) REFERENCES user(user_id),
    FOREIGN KEY (event_id) REFERENCES event(event_id)
);