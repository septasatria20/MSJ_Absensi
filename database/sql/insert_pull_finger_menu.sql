INSERT INTO `sys_dmenu` (`gmenu`, `dmenu`, `urut`, `name`, `icon`, `url`, `tabel`, `layout`, `sub`, `show`, `js`, `isactive`)
VALUES ('transc', 'trspul', 11, 'Pull Finger', 'ni-cloud-download-95', 'trspul', 'trs_pull_finger', 'transc', NULL, 1, 0, 1)
ON DUPLICATE KEY UPDATE
    `name` = 'Pull Finger',
    `icon` = 'ni-cloud-download-95',
    `url` = 'trspul',
    `tabel` = 'trs_pull_finger',
    `layout` = 'transc';

INSERT INTO `sys_auth` (`gmenu`, `dmenu`, `idroles`, `create`, `read`, `update`, `delete`, `print`, `export`, `isactive`)
VALUES ('transc', 'trspul', 'hr', 1, 1, 1, 1, 1, 1, 1)
ON DUPLICATE KEY UPDATE
    `read` = 1, 
    `create` = 1, 
    `update` = 1, 
    `delete` = 1,
    `print` = 1,
    `export` = 1,
    `isactive` = 1;
