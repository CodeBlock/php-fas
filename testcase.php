#!/usr/bin/env php
<?php

require_once dirname(__FILE__).'/FAS.php';

echo 'Username: ';
$username = chop(fgets(STDIN));

echo 'Password: ';
system('stty -echo');
$password = chop(fgets(STDIN));
system('stty echo');
echo "\n";

$fas = id(new FAS())
//  ->setDebug(2)
  ->setUsername($username)
  ->setPassword($password);
$user = $fas->authenticate();

if ($user === false) {
  echo "Authentication failed.\n";
  // Safe to exit here, curl already closed the connection.
  exit(1);
}

echo "You are in the following groups:\n";
foreach ($user->getGroups() as $group_name => $group) {
  echo $group_name.' - '.$group->display_name."\n";
}
