DROP TABLE IF EXISTS `rebuild_requests`;
CREATE TABLE `rebuild_requests` (
    `ip` TEXT,
    `time` INTEGER,
    `id` INTEGER PRIMARY KEY
);

DROP TABLE IF EXISTS `builds`;
CREATE TABLE `builds` (
    `name` TEXT,
    `path` TEXT,
    `time` INTEGER,
    `num` INTEGER,
    `id` INTEGER PRIMARY KEY
);

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
    `ip` TEXT,
    `time` INTEGER,
    `content` TEXT,
    `id` INTEGER PRIMARY KEY
);
