<?php
$CONFIG = array (
  'htaccess.RewriteBase' => '/',
  'memcache.local' => '\\OC\\Memcache\\APCu',
  'apps_paths' =>
  array (
    0 =>
    array (
      'path' => '/var/www/html/apps',
      'url' => '/apps',
      'writable' => false,
    ),
    1 =>
    array (
      'path' => '/var/www/html/custom_apps',
      'url' => '/custom_apps',
      'writable' => true,
    ),
  ),
  'upgrade.disable-web' => true,
  'instanceid' => 'oczt8jez1x9o',
  'passwordsalt' => '7tujfJuiQM3xfAPYbz3WGSjpBLRkLa',
  'secret' => '+voFUa2LrEIOCIOCAodxbGLWnF4MB4tAZ7bwFfz1anJJje/x',
  'trusted_domains' =>
  array (
    0 => 'localhost',
    1 => '192.168.1.101',
    2 => 'nextcloud.vnasmanu.sbs',
  ),
  'datadirectory' => '/var/www/html/data',
  'dbtype' => 'mysql',
  'version' => '28.0.14.1',
  'overwrite.cli.url' => 'https://nextcloud.vnasmanu.sbs',
  'dbname' => 'nextcloud',
  'dbhost' => 'db',
  'dbport' => '',
  'dbtableprefix' => 'oc_',
  'mysql.utf8mb4' => true,
  'dbuser' => 'nextcloud',
  'dbpassword' => 'changeme',
  'installed' => true,
);
