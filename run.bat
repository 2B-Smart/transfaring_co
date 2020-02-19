if not DEFINED IS_MINIMIZED set IS_MINIMIZED=1 && start "" /min "%~dpnx0" %* && exit
php artisan serve --host 192.168.1.250 --port 8000
