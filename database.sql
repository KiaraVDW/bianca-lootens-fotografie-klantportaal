CREATE DATABASE IF NOT EXISTS bianca_fotografie_site CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bianca_fotografie_site;

DROP TABLE IF EXISTS shoot_requests;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    email varchar(150) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    role varchar(20) NOT NULL DEFAULT 'visitor',
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE comments (
    id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NULL,
    name varchar(100) NOT NULL,
    comment text NOT NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE shoot_requests (
    id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NULL,
    name varchar(100) NOT NULL,
    email varchar(150) NOT NULL,
    shoot_type varchar(100) NOT NULL,
    package_type varchar(100) NOT NULL,
    shoot_date date NOT NULL,
    message text NOT NULL,
    status varchar(40) NOT NULL DEFAULT 'Nieuw',
    admin_note text NULL,
    created_at timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

INSERT INTO users (name, email, password, role) VALUES
('Bianca Lootens', 'admin@dvsoundlight.be', 'admin123', 'admin'),
('Klant Demo', 'klant@dvsoundlight.be', 'klant123', 'visitor');

INSERT INTO comments (user_id, name, comment) VALUES
(2, 'Iemke', 'Een heel fijne fotoshoot met een warme sfeer.'),
(NULL, 'Gast', 'Prachtige stijl en mooie herinneringen.');

INSERT INTO shoot_requests (user_id, name, email, shoot_type, package_type, shoot_date, message, status, admin_note) VALUES
(2, 'Klant Demo', 'klant@dvsoundlight.be', 'Familie en vrienden', 'Fotoshoot studio', '2026-06-12', 'We willen graag een familieshoot plannen.', 'Nieuw', ''),
(NULL, 'Band Demo', 'band@example.com', 'Bandpics', 'Concert of bandreportage', '2026-07-04', 'We zoeken foto’s voor onze nieuwe release.', 'In behandeling', 'Locatie nog bespreken.');
