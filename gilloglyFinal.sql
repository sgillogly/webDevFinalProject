DROP TABLE IF EXISTS gillogly_final_users;
DROP TABLE IF EXISTS gillogly_final_journal;
CREATE TABLE gillogly_final_users (id INT PRIMARY KEY AUTO_INCREMENT, username VARCHAR(30), password_hash VARCHAR(100));
CREATE TABLE gillogly_final_journal (id INT PRIMARY KEY AUTO_INCREMENT, userID INT REFERENCES gillogly_final_users, entry VARCHAR(500));