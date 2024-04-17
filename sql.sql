CREATE TABLE users (
                       user_id INT AUTO_INCREMENT PRIMARY KEY,
                       first_name VARCHAR(255) NOT NULL,
                       last_name VARCHAR(255) NOT NULL,
                       username VARCHAR(255) NOT NULL,
                       email VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       reset_token_hash VARCHAR(64) NULL DEFAULT NULL,
                       reset_token_expires_at DATETIME NULL DEFAULT NULL,
                       UNIQUE (reset_token_hash),
                       password_hash VARCHAR(255) NOT NULL
);
--
-- Table structure for table `company_users`
--
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




--
-- Table structure for table `advert_files`
--
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



--
-- Table structure for table `offers_table`
--

CREATE TABLE `offers_table` (
                                `offer_id` int(11) NOT NULL,
                                `company_id` int(11) NOT NULL,
                                `user_id` int(11) NOT NULL,
                                `offer_description` text NOT NULL,
                                `price` decimal(10,0) NOT NULL,
                                `VAT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `offers_table`
    ADD PRIMARY KEY (`offer_id`);

ALTER TABLE `offers_table`
    MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `offers_table` ADD CONSTRAINT `company_fk` FOREIGN KEY (`company_id`) REFERENCES `company_users`(`company_id`)
    ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `offers_table` ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`)
    ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `offers_table` ADD CONSTRAINT `advert_fk` FOREIGN KEY (`advert_id`) REFERENCES `advert_table`(`advert_id`)
    ON DELETE RESTRICT ON UPDATE RESTRICT;


--
-- -- Table structure for table `password_reset_tokens`
-- --
-- CREATE TABLE password_reset_tokens (
--                                        id INT AUTO_INCREMENT PRIMARY KEY,
--                                        user_id INT,
--                                        email VARCHAR(255) NOT NULL,
--                                        token VARCHAR(255) NOT NULL,
--                                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--                                        expiration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--                                        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
-- );

CREATE TABLE comments (
                          comment_id INT AUTO_INCREMENT PRIMARY KEY,
                          advert_id INT,
                          user_id INT,
                          comment_text TEXT,
                          parent_comment_id INT,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

                          FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
ALTER TABLE comments
    ADD CONSTRAINT fk_commentadvert_id
        FOREIGN KEY (advert_id) REFERENCES advert_table(advert_id)
            ON DELETE CASCADE;


ALTER TABLE comments
    ADD CONSTRAINT fk_comment_user_id
        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE;

ALTER TABLE `comments` ADD CONSTRAINT `fk_company_comment` FOREIGN KEY (`company_id`) REFERENCES `company_users`(`company_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;


-- CREATE TABLE comment_replies (
--                                  reply_id INT AUTO_INCREMENT PRIMARY KEY,
--                                  comment_id INT,
--                                  user_id INT,
--                                  reply_text TEXT,
--                                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--                                  FOREIGN KEY (comment_id) REFERENCES comments(comment_id) ON DELETE CASCADE,
--                                  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
-- );
