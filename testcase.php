#!/usr/bin/env php
<?php

require_once dirname(__FILE__).'/FAS.php';

echo 'Username: ';
$username = chop(fgets(STDIN));

echo 'Password: ';
system('stty -echo');
$password = chop(fgets(STDIN));
system('stty echo');

echo "Here we go. Good luck!\n";

$fas = id(new FAS())->setDebug(2);
echo $fas->authenticate($username, $password) ? 'OK' : 'Failed';
echo "\n";