CREATE TABLE `photogram`.`auth` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NOT NULL,
  `password` VARCHAR(256) NOT NULL,
  `email` VARCHAR(256) NOT NULL,
  `phone` VARCHAR(16) NOT NULL,
  `active` INT NOT NULL DEFAULT 1,
  `blocked` INT NOT NULL DEFAULT 0,
  `sec_email` VARCHAR(256) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

CREATE TABLE `photogram`.`users` (
  `id` INT NOT NULL,
  `bio` LONGTEXT NULL,
  `avatar` VARCHAR(1024) NOT NULL,
  `firstname` TEXT(15) NOT NULL,
  `lastname` TEXT(15) NOT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `instagram` VARCHAR(1024) NULL DEFAULT NULL,
  `twitter` VARCHAR(1024) NULL DEFAULT NULL,
  `facebook` VARCHAR(1024) NULL DEFAULT NULL,
  INDEX `fk_users_1_idx` (`id` ASC) VISIBLE,
  CONSTRAINT `fk_users_id`
    FOREIGN KEY (`id`)
    REFERENCES `photogram`.`auth` (`id`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION);


CREATE TABLE `photogram`.`session` (
  `id` INT NOT NULL,
  `uid` INT NOT NULL,
  `token` VARCHAR(32) NOT NULL,
  `login_time` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` VARCHAR(12) NOT NULL,
  `user_agent` VARCHAR(256) NULL,
  `active` INT NULL DEFAULT 1,
  `fingerprint` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_session_uid_idx` (`uid` ASC) VISIBLE,
  CONSTRAINT `fk_session_uid`
    FOREIGN KEY (`uid`)
    REFERENCES `photogram`.`auth` (`id`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_as_cs;