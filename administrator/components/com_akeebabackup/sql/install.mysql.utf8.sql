--
-- Create the Profiles table
--
CREATE TABLE IF NOT EXISTS `#__akeebabackup_profiles` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` varchar(255) NOT NULL,
    `configuration` longtext,
    `filters` longtext,
    `quickicon` tinyint(3) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`)
) ENGINE InnoDB DEFAULT COLLATE utf8_general_ci;

--
-- Create the default backup profile
--
INSERT IGNORE INTO `#__akeebabackup_profiles`
    (`id`, `description`, `configuration`, `filters`, `quickicon`)
VALUES (1, 'Default Backup Profile', '', '', 1);

--
-- Create the backups table
--
CREATE TABLE IF NOT EXISTS `#__akeebabackup_backups` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `description` varchar(255) NOT NULL,
    `comment` longtext,
    `backupstart` timestamp NULL DEFAULT NULL,
    `backupend` timestamp NULL DEFAULT NULL,
    `status` enum('run','fail','complete') NOT NULL DEFAULT 'run',
    `origin` varchar(30) NOT NULL DEFAULT 'backend',
    `type` varchar(30) NOT NULL DEFAULT 'full',
    `profile_id` bigint(20) NOT NULL DEFAULT '1',
    `archivename` longtext,
    `absolute_path` longtext,
    `multipart` int(11) NOT NULL DEFAULT '0',
    `tag` varchar(255) DEFAULT NULL,
    `backupid` varchar(255) DEFAULT NULL,
    `filesexist` tinyint(3) NOT NULL DEFAULT '1',
    `remote_filename` varchar(1000) DEFAULT NULL,
    `total_size` bigint(20) NOT NULL DEFAULT '0',
    `frozen` tinyint(1) NOT NULL DEFAULT '0',
    `instep` tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `idx_fullstatus` (`filesexist`,`status`),
    KEY `idx_stale` (`status`,`origin`)
) ENGINE InnoDB DEFAULT COLLATE utf8_general_ci;

--
-- Create the custom storage table
--
CREATE TABLE IF NOT EXISTS `#__akeebabackup_storage` (
    `tag` varchar(255) NOT NULL,
    `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `data` longtext,
    PRIMARY KEY (`tag`(100))
) ENGINE InnoDB DEFAULT COLLATE utf8_general_ci;

--
-- Create the common table for all Akeeba extensions.
--
-- This table is never uninstalled when uninstalling the extensions themselves.
--
CREATE TABLE IF NOT EXISTS `#__akeeba_common`
(
    `key` VARCHAR(190) NOT NULL,
    `value` LONGTEXT NOT NULL,
    PRIMARY KEY (`key`(100))
)
ENGINE InnoDB DEFAULT COLLATE utf8_general_ci;