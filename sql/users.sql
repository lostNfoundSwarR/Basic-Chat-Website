CREATE TABLE users(
     user_id INT PRIMARY KEY AUTO_INCREMENT,
     unique_user_id INT(200) UNIQUE NOT NULL,
     username VARCHAR(300) UNIQUE,
     email VARCHAR(300) UNIQUE,
     pass VARCHAR(255) NOT NULL,
     img VARCHAR(255),
     stat VARCHAR(50) NOT NULL
);
DELIMITER //
--This trigger will delete the user data from everything when user is deleted
CREATE TRIGGER user_update
AFTER DELETE ON users
FOR EACH ROW
BEGIN
     DELETE FROM requests
     WHERE requests.sender_id = OLD.unique_user_id
     OR requests.receiver_id = OLD.unique_user_id;

     DELETE FROM messages
     WHERE messages.outgoing_id = OLD.unique_user_id
     OR requests.receiver_id = OLD.unique_user_id;

     DELETE FROM friends
     WHERE friends.friend_id = OLD.unique_user_id
     OR friends.unique_id = OLD.unique_user_id;

     DELETE FROM archives
     WHERE archives.unique_user_id = OLD.unique_user_id
     OR archives.archived_user_id = OLD.unique_user_id;
END//

DELIMITER ;