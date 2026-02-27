SELECT 'GMENU CHECK:' as info;
SELECT * FROM sys_gmenu WHERE gmenu = 'transc';

SELECT '\nDMENU CHECK:' as info;
SELECT * FROM sys_dmenu WHERE gmenu = 'transc' AND dmenu = 'trspul';

SELECT '\nAUTH CHECK (HR):' as info;
SELECT * FROM sys_auth WHERE gmenu = 'transc' AND dmenu = 'trspul' AND idroles = 'hr';

SELECT '\nALL TRANSC DMENU:' as info;
SELECT * FROM sys_dmenu WHERE gmenu = 'transc' ORDER BY urut;
