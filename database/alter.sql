/*12 June 2025*/

ALTER TABLE `accused_profiles` ADD `layer` VARCHAR(255) NULL DEFAULT NULL AFTER `case_id`, ADD `disputed_amount` DECIMAL(20,2) NULL AFTER `layer`;

/*18 June 2025*/

ALTER TABLE `accused_profiles` ADD `status` LONGTEXT NULL DEFAULT NULL AFTER `case_id`;


ALTER TABLE `accused_profiles` ADD `cdr_analysis` LONGTEXT NULL DEFAULT NULL AFTER `additional_info`;



 composer require simplesoftwareio/simple-qrcode