# Awesome Lib API

Library for API requests.

![](https://github.com/awsmug/lib-api/workflows/PHPUnit/badge.svg)

Version 1.0.0-alpha-1

## Example implementation

```php
<?php

use AWSM\LibAPI\Examples\TrustedShopsAPI;
use AWSM\LibAPI\Examples\TrustedShopsAuth;
use AWSM\LibAPI\Examples\TrustedShopsReviews;


$auth  = new TrustedShopsAuth( TS_CLIENT_ID, TS_CLIENT_SECRET );
$api   = new TrustedShopsAPI( $auth );

$params = [
    'count' => 3,
    'status' => 'APPROVED',
    'orderBy' => 'rating'
];

$response = $api->request( '/reviews', 'GET', $params );
```