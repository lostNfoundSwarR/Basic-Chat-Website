CREATE TABLE friends(
     user_id INT PRIMARY KEY AUTO_INCREMENT,
     unique_id INT,
     friend_id INT,
     CONSTRAINT friends_1_ibfk FOREIGN KEY (unique_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE,

     CONSTRAINT friends_2_ibfk FOREIGN KEY (friend_id) REFERENCES
     users(unique_user_id) ON DELETE CASCADE
);

DELIMITER //
--This trigger will delete the request after it's accepted
CREATE TRIGGER friend_update
AFTER INSERT ON friends
FOR EACH ROW
BEGIN
     DELETE FROM requests
     WHERE requests.sender_id = NEW.friend_id
     AND requests.receiver_id = NEW.unique_id //
END//

DELIMITER ;