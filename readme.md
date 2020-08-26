[![Downloads this Month](https://img.shields.io/packagist/dm/jakubenglicky/sms-manager.svg)](https://packagist.org/packages/jakubenglicky/sms-manager)
[![Build](https://travis-ci.org/jakubenglicky/sms-manager.svg?branch=master)](https://travis-ci.org/jakubenglicky/sms-manager)
[![Latest version](https://img.shields.io/packagist/v/jakubenglicky/sms-manager.svg)](https://packagist.org/packages/jakubenglicky/sms-manager)

SMS Manager PHP SDK
===========
Library for sending SMS via https://smsmanager.cz/

Information about HTTP Request API https://smsmanager.cz/api/http

Instalation:
-----------

	composer require jakubenglicky/sms-manager


Easy using:
-----
```php
$msg = new SmsManager\Message\Message();
$msg->setTo(['+420777111222']);
$msg->setBody('Message text');

$client = new SmsManager\Http\Client('api-key');
$client->send($msg);
```

Nette DI:
------
```neon
extensions:
	smsmanager: SmsManager\DI\SmsManagerExtension

smsmanager:
	apiKey: 'sms-manager-api-key'
    	
```
Use interface `IClient` for sending SMS in Nette.

SMS Tracy Panel
---------------
config.local.neon
```neon
tracy:
	bar:
	    - SmsManager\Diagnostics\Panel(%tempDir%)

smsmanager:
        class: SmsManager\IClient
        factory: SmsManager\Diagnostics\DebugClient(%tempDir%)
```

This panel was inspired by the [Nextras Mail Panel](https://github.com/nextras/mail-panel)
