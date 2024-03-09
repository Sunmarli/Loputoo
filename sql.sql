CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       first_name VARCHAR(255) NOT NULL,
                       last_name VARCHAR(255) NOT NULL,
                       username VARCHAR(255) NOT NULL,
                       email VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE company_users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       first_name VARCHAR(255) NOT NULL,
                       last_name VARCHAR(255) NOT NULL,
                       company_name VARCHAR(255) NOT NULL,
                       registration_code VARCHAR(255) NOT NULL,
                       address VARCHAR(255) NOT NULL,
                       email VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


/*do not tuch it
CREATE TABLE password_reset_tokens (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       email VARCHAR(255) NOT NULL,
                                       token VARCHAR(255) NOT NULL,
                                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                       expiration TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE password_reset_tokens (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       user_id INT,
                                       email VARCHAR(255) NOT NULL,
                                       token VARCHAR(255) NOT NULL,
                                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                       expiration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE password_reset_tokens MODIFY COLUMN expiration TIMESTAMP DEFAULT CURRENT_TIMESTAMP;


 */
--




# advert files table
CREATE TABLE `advert_files` (
                                `file_id` int(11) NOT NULL,
                                `advert_id` int(11) NOT NULL,
                                `filename` varchar(225) NOT NULL,
                                `created_at` datetime NOT NULL,
                                `file_path` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
ALTER TABLE `advert_files`
    ADD PRIMARY KEY (`file_id`),
    ADD KEY `fk_advert_id` (`advert_id`);

--
ALTER TABLE `advert_files`
    MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `advert_files`
    ADD CONSTRAINT `fk_advert_id` FOREIGN KEY (`advert_id`) REFERENCES `advert_table` (`advert_id`);




