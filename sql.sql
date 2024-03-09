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
-- Table structure for table `advert_table`
--

CREATE TABLE `advert_table` (
                                `advert_id` int(11) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                `advert_title` varchar(100) NOT NULL,
                                `advert_description` text NOT NULL,
                                `region` varchar(30) NOT NULL,
                                `city` varchar(30) NOT NULL,
                                `work_start_date` date NOT NULL,
                                `work_end_date` date NOT NULL,
                                `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Indexes for table `advert_table`
--
ALTER TABLE `advert_table`
    ADD PRIMARY KEY (`advert_id`),
    ADD KEY `fk_user_id` (`user_id`);

--
ALTER TABLE `advert_table`
    MODIFY `advert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
ALTER TABLE `advert_table`
    ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);





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




