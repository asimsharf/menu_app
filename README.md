* php artisan cache:clear
* php artisan optimize:clear
* composer dump-autoload
* composer clear-cache
* composer clearcache
* composer cc
* npm cache clean --force
* zip -r fileName.zip dirname | *

<VirtualHost *:80>
    ServerAdmin webmaster@example.com
    DocumentRoot "/var/www/html/web.dbestechs.com/public-flutter"
    ServerName web.dbestechs.com
    ServerAlias web.dbestechs.com
    #errorDocument 404 /404.html
    ErrorLog "/var/www/html/web.dbestechs.com-error_log"
    CustomLog "/var/www/html/web.dbestechs.com-access_log" combined

    
    #DENY FILES
     <Files ~ (\.user.ini|\.htaccess|\.git|\.svn|\.project|LICENSE|README.md)$>
       Order allow,deny
       Deny from all
    </Files>
    
    #PATH
    <Directory "/var/www/html/web.dbestechs.com/public-flutter">
        SetOutputFilter DEFLATE
        Options FollowSymLinks
        AllowOverride All
        Require all granted
        DirectoryIndex index.php index.html index.htm default.php default.html default.htm
    </Directory>
</VirtualHost>