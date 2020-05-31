# Test work for [PayDoo][1]

- ID: 353b9251-aa7e-4be6-babf-70a85f2f6a58
- Time spent: ~3h

### Issue

[PDF Attachment (12.46 KiB)](TestTask_PHP%20Developer.pdf)

### Used libraries:
- enuage/php-advanced-types
- psr/http-client
- psr/http-factory
- aura/sql
- enuage/schema-validator
- codeception/codeception

### Requirements

- PHP >= 7.4
- PHP PDO extension
- Composer

### Testing 

```
php vendor/bin/codecept run unit
```

[1]: https://www.paydoo.com/
