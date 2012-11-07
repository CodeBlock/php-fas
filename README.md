# php-fas - PHP Authentication Library for FAS

```php
$user = FAS::authenticate($username, $password);

if ($user !== false) {
  // Successful auth.
} else {
  // Unsuccessful.
}

$user2 = FAS::authenticate($email, $password);
```

# License

GPLv2, same as FAS.
