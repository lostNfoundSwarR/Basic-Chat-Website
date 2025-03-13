CREATE TABLE messages(
     message_id INT PRIMARY KEY AUTO_INCREMENT,
     outgoing_id INT,
     incoming_id INT,
     msg VARCHAR(500) NOT NULL,
     CONSTRAINT msg_1_ibfk FOREIGN KEY (outgoing_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE,

     CONSTRAINT msg_2_ibfk FOREIGN KEY (incoming_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE
);