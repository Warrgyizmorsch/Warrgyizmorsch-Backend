ALTER TABLE callback_messages
ADD next_followup_date DATETIME NULL AFTER message,
ADD is_done TINYINT(1) DEFAULT 0 NOT NULL AFTER next_followup_date;

CREATE TABLE user_work_logs;

CREATE TABLE todo_tasks;

ALTER TABLE leads
ADD followup_type VARCHAR(100) NULL AFTER lead_status;

ALTER TABLE `callback_messages` ADD `call_recording` VARCHAR(255) NULL AFTER `bucket`, ADD UNIQUE `call-record` (`call_recording`);

<!-- Manish 27-3-26  -->
 ALTER TABLE `callback_messages` CHANGE `message` `message` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
 ALTER TABLE `callback_messages` ADD `lead_engagement_status` VARCHAR(255) NULL DEFAULT NULL AFTER `bucket`;
ALTER TABLE `callback_messages` ADD `followup_type` VARCHAR(255) NULL DEFAULT NULL AFTER `lead_engagement_status`;

<!-- Manish 9-4-26 -->
ALTER TABLE `callback_messages` ADD `followup_status` VARCHAR(255) NULL DEFAULT NULL AFTER `followup_type`;

<!-- Manish-13-4-26 -->
 ALTER TABLE `users` ADD `is_active` TINYINT NOT NULL DEFAULT '1' AFTER `is_deleted`;

<!-- Jay - 15-4-26 -->
ALTER TABLE university ADD COLUMN slug VARCHAR(255) NULL;
UPDATE university SET slug = LOWER(REPLACE(name, ' ', '-'));
ALTER TABLE university_details ADD COLUMN ranking_info LONGTEXT NULL;
 2 migrations - 
 2025_04_08_create_university_details_table.php
 2026_04_09_114750_add_timestamps_to_courses_table.php
