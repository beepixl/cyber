-- Pure ALTER TABLE statements to add missing columns to mule_accounts table
-- Run these queries one by one, skip if column already exists

ALTER TABLE `mule_accounts` ADD COLUMN `bank_branch_address` TEXT NULL AFTER `address`;

ALTER TABLE `mule_accounts` ADD COLUMN `reply_letter_sent_to_bank_dt` DATE NULL AFTER `layers`;

ALTER TABLE `mule_accounts` ADD COLUMN `reply_letter_received_from_bank_dt` DATE NULL AFTER `reply_letter_sent_to_bank_dt`;

ALTER TABLE `mule_accounts` ADD COLUMN `acc_holder_address` TEXT NULL AFTER `reply_letter_received_from_bank_dt`;

ALTER TABLE `mule_accounts` ADD COLUMN `acc_holder_police_station` VARCHAR(255) NULL AFTER `acc_holder_address`;

ALTER TABLE `mule_accounts` ADD COLUMN `holder_nivedan_taken_dt` DATE NULL AFTER `acc_holder_police_station`;

ALTER TABLE `mule_accounts` ADD COLUMN `remarks` TEXT NULL AFTER `holder_nivedan_taken_dt`;

ALTER TABLE `mule_accounts` ADD COLUMN `action_taken` TEXT NULL AFTER `remarks`;

ALTER TABLE `mule_accounts` ADD COLUMN `action_taken_date` DATE NULL AFTER `action_taken`;
