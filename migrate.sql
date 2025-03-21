-- 1. Users table
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` VARCHAR(255) NOT NULL,
  `lastname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('student', 'coordinator', 'company') NOT NULL DEFAULT 'student',
  `remember_token` VARCHAR(100) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `coordinator` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `coordinator_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `studyfield` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` TEXT NOT NULL,
  `coordinator_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `studyfield_coordinator_id_foreign` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `student` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `class` VARCHAR(255) NOT NULL,
  `studyfield_id` BIGINT UNSIGNED NOT NULL,
  `year` INT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `student_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`),
  CONSTRAINT `student_studyfield_id_foreign` FOREIGN KEY (`studyfield_id`) REFERENCES `studyfield`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE `company` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `company_name` TEXT NOT NULL,
  `street` TEXT NOT NULL,
  `streetNr` SMALLINT NOT NULL,
  `town` TEXT NOT NULL,
  `zip` VARCHAR(255) NOT NULL,
  `country` TEXT NOT NULL,
  `website` TEXT NOT NULL,
  `accepted` TINYINT NOT NULL,
  `max_students` INT NOT NULL,
  `student_amount` INT NOT NULL,
  `logo` TEXT NOT NULL,
  `company_vat` TEXT NULL,
  `reason` TEXT NULL,
  `employee_count` INT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `company_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `stage` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` BIGINT UNSIGNED NOT NULL,
  `active` TINYINT NOT NULL,
  `title` TEXT NOT NULL,
  `tasks` TEXT NOT NULL,
  `studyfield_id` BIGINT UNSIGNED NOT NULL,
  `reason` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `stage_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company`(`id`),
  CONSTRAINT `stage_studyfield_id_foreign` FOREIGN KEY (`studyfield_id`) REFERENCES `studyfield`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `proposal` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` BIGINT UNSIGNED NOT NULL,
  `stage_id` BIGINT UNSIGNED NOT NULL,
  `tasks` TEXT NOT NULL,
  `motivation` TEXT NOT NULL,
  `status` TEXT NOT NULL,
  `feedback` TEXT NULL,
  `coordinator_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `proposal_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student`(`id`),
  CONSTRAINT `proposal_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `stage`(`id`),
  CONSTRAINT `proposal_coordinator_id_foreign` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinator`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `mentor` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` TEXT NOT NULL,
  `lastname` TEXT NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `stage_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `mentor_stage_id_foreign` FOREIGN KEY (`stage_id`) REFERENCES `stage`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `cv` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` BIGINT UNSIGNED NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `feedback` TEXT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `cv_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student`(`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
