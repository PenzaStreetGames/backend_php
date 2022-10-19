CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
SET NAMES utf8;

CREATE TABLE IF NOT EXISTS student (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    name TEXT NOT NULL,
    surname TEXT NOT NULL,
    PRIMARY KEY (ID)
    );

CREATE TABLE IF NOT EXISTS course (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE IF NOT EXISTS auth (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY(ID)
);

INSERT INTO auth (login, password)
VALUES ('login', '{SHA}W6ph5Mm5Pz8GgiULbPgzG37mj9g=');

INSERT INTO student (name, surname)
VALUES
    ('Aboba', 'Abobov'),
    ('Victor', 'Lapenko'),
    ('Vlad', 'A4'),
    ('Sergey', 'Kulikov'),
    ('Slava', 'Bebrou');

INSERT INTO course (name, description)
VALUES
    ('Математическая логика и теория алгоритмов', 'Курс на помучать первачка'),
    ('Вычислительная математика', 'Вы будете страдать на этой дисциплине'),
    ('Дополнительные главы вычислительной математики', 'Добавочка тем, кому не хватило первой части курса');
