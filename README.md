# vigo-api-get-data
Application that retrieves data from the Vigo api using JavaScript and writes it to the local database using JavaScript + PHP.

Also add these two files into the root directory of this application:

1) **Congif.php**:
```php
<?php

define('CLIENT', 'clientid');
define('KEY', '71ksfa91jfladkf921k21j5kda8d9a0');
```

<br />

2) **MysqlConfig.php**:
```php
<?php

$link = mysqli_connect("localhost", "root", "root", "vigo");
if (mysqli_connect_errno()) {
    printf("Не удалось подключиться: %s\n", mysqli_connect_error());
    exit();
}
```
