SET bantam_path=%~dp0
schtasks /query /TN "Nav Students Sync" >NUL 2>&1 || schTasks /Create /SC DAILY /TN "Nav Students Sync" /TR "php %bantam_path%artisan nav:sync" /RI 30 /mo 1 /RU "SYSTEM" /DU "24:00"
pause