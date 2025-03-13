CREATE TABLE users(
     user_id INT PRIMARY KEY AUTO_INCREMENT,
     unique_user_id INT(200) UNIQUE NOT NULL,
     username VARCHAR(300) UNIQUE,
     email VARCHAR(300) UNIQUE,
     pass VARCHAR(255) NOT NULL,
     img VARCHAR(255),
     stat VARCHAR(50) NOT NULL
);

