
  ⇂ create table `users` (`id` bigint unsigned not null auto_increment primary key, `name` varchar(255) not null, `email` varchar(255) not null, `email_verified_at` timestamp null, `password` varchar(255) not null, `role` enum('student', 'coordinator', 'company') not null default 'student', `remember_token` varchar(100) null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ alter table `users` add unique `users_email_unique`(`email`)
  ⇂ create table `password_reset_tokens` (`email` varchar(255) not null, `token` varchar(255) not null, `created_at` timestamp null, primary key (`email`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ create table `sessions` (`id` varchar(255) not null, `user_id` bigint unsigned null, `ip_address` varchar(45) null, `user_agent` text null, `payload` longtext not null, `last_activity` int not null, primary key (`id`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ alter table `sessions` add index `sessions_user_id_index`(`user_id`)
  ⇂ alter table `sessions` add index `sessions_last_activity_index`(`last_activity`)
  ⇂ create table `cache` (`key` varchar(255) not null, `value` mediumtext not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ create table `cache_locks` (`key` varchar(255) not null, `owner` varchar(255) not null, `expiration` int not null, primary key (`key`)) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ create table `coordinator` (`id` bigint unsigned not null auto_increment primary key, `firstname` text not null, `lastname` text not null, `email` varchar(255) not null, `password` text not null, `studyfield_id` bigint not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `student` (`id` bigint unsigned not null auto_increment primary key, `firstname` text not null, `lastname` text not null, `password` varchar(255) not null, `email` text not null, `class` varchar(255) not null, `studyfield_id` bigint unsigned not null, `year` int not null, `proposal_id` bigint unsigned null, `cv_id` bigint not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ alter table `student` add constraint `student_studyfield_id_foreign` foreign key (`studyfield_id`) references `studyfield` (`id`)
  ⇂ SET FOREIGN_KEY_CHECKS=1;
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `studyfield` (`id` bigint unsigned not null auto_increment primary key, `name` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ SET FOREIGN_KEY_CHECKS=1;
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `proposal` (`id` bigint unsigned not null auto_increment primary key, `stage_id` bigint unsigned not null, `tasks` text not null, `motivation` text not null, `status` tinyint not null, `feedback` text not null, `coordinator_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ alter table `proposal` add constraint `proposal_stage_id_foreign` foreign key (`stage_id`) references `stage` (`id`)
  ⇂ alter table `proposal` add constraint `proposal_coordinator_id_foreign` foreign key (`coordinator_id`) references `coordinator` (`id`)
  ⇂ SET FOREIGN_KEY_CHECKS=1;
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `company` (`id` bigint unsigned not null auto_increment primary key, `company_name` text not null, `street` text not null, `streetNr` smallint not null, `town` text not null, `zip` varchar(255) not null, `mentor_id` bigint not null, `accepted` tinyint(1) not null, `max_students` int not null, `student_amount` int not null, `logo_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ alter table `company` add constraint `company_logo_id_foreign` foreign key (`logo_id`) references `logo` (`id`)
  ⇂ SET FOREIGN_KEY_CHECKS=1;
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `mentor` (`id` bigint unsigned not null auto_increment primary key, `firstname` text not null, `lastname` text not null, `phone` varchar(255) not null, `email` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ SET FOREIGN_KEY_CHECKS=1;
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `cv` (`id` bigint unsigned not null auto_increment primary key, `file` varchar(255) not null, `feedback` text not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ SET FOREIGN_KEY_CHECKS=1;
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `stage` (`id` bigint unsigned not null auto_increment primary key, `company_id` bigint unsigned not null, `active` tinyint(1) not null, `logo_id` bigint unsigned not null, `title` text not null, `tasks` text not null, `studyfield_id` bigint unsigned not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ alter table `stage` add constraint `stage_company_id_foreign` foreign key (`company_id`) references `company` (`id`)
  ⇂ alter table `stage` add constraint `stage_logo_id_foreign` foreign key (`logo_id`) references `logo` (`id`)
  ⇂ alter table `stage` add constraint `stage_studyfield_id_foreign` foreign key (`studyfield_id`) references `studyfield` (`id`)
  ⇂ SET FOREIGN_KEY_CHECKS=1;
  ⇂ SET FOREIGN_KEY_CHECKS=0;
  ⇂ create table `logo` (`id` bigint unsigned not null auto_increment primary key, `path` varchar(255) not null, `created_at` timestamp null, `updated_at` timestamp null) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
  ⇂ SET FOREIGN_KEY_CHECKS=1;

