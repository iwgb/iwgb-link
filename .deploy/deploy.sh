#!/bin/bash
cd /var/repo/iwgb-link || exit 1

rsync -a . /var/www/iwgb-link --delete --exclude .git --exclude .deploy --exclude .github --exclude vendor --exclude .gitignore

cd /var/www/iwgb-link/public || exit 1

cd /var/repo/iwgb-link-static || exit 1
rsync -a . /var/www/iwgb-link

chown -R www-data:www-data /var/www/iwgb-link
chmod -R 774 /var/www/iwgb-link
runuser -l deploy -c 'cd /var/www/iwgb-link && composer install'
