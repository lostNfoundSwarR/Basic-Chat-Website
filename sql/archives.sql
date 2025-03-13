--You can name the constraints anything you want, or not name them at all

CREATE TABLE archives(
     archive_id INT PRIMARY KEY AUTO_INCREMENT,
     unique_user_id INT NOT NULL,
     archived_user_id INT NOT NULL,
     CONSTRAINT archives_1_ibfk FOREIGN KEY(unique_user_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE,
     
     CONSTRAINT archives_2_ibfk FOREIGN KEY(archived_user_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE,
);