CREATE TABLE users(
    uid INTEGER PRIMARY KEY NOT NULL,
    login CHAR(20) UNIQUE NOT NULL,
    haslo CHAR(50) NOT NULL, 
    email CHAR(40) UNIQUE NOT NULL,
    datad INT NOT NULL
);

CREATE TABLE messages(
    id INTEGER PRIMARY KEY NOT NULL,
    id_wysylajacego INTEGER,
    id_odbiorcy INTEGER,
    wiadomosc TEXT,
    FOREIGN KEY(id_wysylajacego) REFERENCES users(uid),
    FOREIGN KEY(id_odbiorcy) REFERENCES users(uid)
);

INSERT INTO users VALUES (NULL, 'admin', 'haslo', 'admin@home.net', time());
