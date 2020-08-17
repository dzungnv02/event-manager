<?php
#error_reporting(E_ALL);
#error_reporting(0);
$conf = array();
$conf['dbhost'] = getenv("DATABASE_HOST");
$conf['dbusername'] = getenv("DATABASE_USER");
$conf['dbpassword'] = getenv("DATABASE_PASSWORD");;
$conf['dbname'] = getenv("DATABASE_NAME");;
?>