CREATE DATABASE `mvc_app`;

USE `mvc_app`;

CREATE TABLE `mvc_app`.`areas` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `mvc_app`.`employees` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `genre` VARCHAR(10) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `area_id` INT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE
    `mvc_app`.`employees`
ADD
    CONSTRAINT `fk_employee_area` FOREIGN KEY (`area_id`) REFERENCES `mvc_app`.`areas`(`id`);

CREATE TABLE `mvc_app`.`jobs` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `mvc_app`.`employee_job` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `employee_id` INT NOT NULL,
    `job_id` INT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE
    `mvc_app`.`employee_job`
ADD
    CONSTRAINT `fk_employee_job_job` FOREIGN KEY (`job_id`) REFERENCES `mvc_app`.`jobs`(`id`);

ALTER TABLE
    `mvc_app`.`employee_job`
ADD
    CONSTRAINT `fk_employee_job_employee` FOREIGN KEY (`employee_id`) REFERENCES `mvc_app`.`employees`(`id`);