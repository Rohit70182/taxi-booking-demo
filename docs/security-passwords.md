Working with Passwords
======================

Most developers know that passwords cannot be stored in plain text, but many developers believe it's still safe to hash
passwords using `md5` or `sha1`. There was a time when using the aforementioned hashing algorithms was sufficient,
but modern hardware makes it possible to reverse such hashes and even stronger ones very quickly using brute force attacks.

In order to provide increased security for user passwords, even in the worst case scenario (your application is breached),
you need to use a hashing algorithm that is resilient against brute force attacks. The best current choice is `bcrypt`.
In PHP, you can create a `bcrypt` hash using the [crypt function](https://secure.php.net/manual/en/function.crypt.php). Laravel `Hash Facade` already provides
a helper functions which make using `crypt` to securely generate and verify hashes easier.

When a user provides a password for the first time (e.g., upon registration), the password needs to be hashed:


```php
$hash = bcrypt($password)
```

You can also check if password needs to be rehashed


```php
// if (Hash::needsRehash($hashed))
// {
//     $hashed = Hash::make('secret');
// }
```
