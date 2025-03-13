--You can name the foreign keys anything you want, or not name them at all

CREATE TABLE requests(
     request_id INT PRIMARY KEY AUTO_INCREMENT,
     sender_id INT NOT NULL,
     receiver_id INT NOT NULL,
     CONSTRAINT incoming_ibfk FOREIGN KEY(receiver_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE,
     
     CONSTRAINT outgoing_ibfk FOREIGN KEY(sender_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE
);