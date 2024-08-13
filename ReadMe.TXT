Hello CLC


Web Pages:
Register,
Login,
Vote,
and Poll.


Have provided a SQL export in the root for you to import,
Alternatively please run the SQL commands,

CREATE DATABASE test;
USE test;

USE test;

-- Create 'users' table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

-- Create 'votes' table
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    option VARCHAR(50) NOT NULL UNIQUE
);

-- Insert options into 'votes' table
INSERT INTO votes (option) VALUES 
    ('PHP'), 
    ('C#'), 
    ('C'), 
    ('JAVA'), 
    ('Python'), 
    ('C++');

-- Create 'user_votes' table
CREATE TABLE user_votes (
    user_id INT,
    vote_id INT,
    PRIMARY KEY (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vote_id) REFERENCES votes(id) ON DELETE CASCADE
);


