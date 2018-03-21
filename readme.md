SMS Manager PHP SDK
===========
Library for sending SMS via http://smsmanager.cz/

Instalation:
-----------

	composer require jakubenglicky/sms-manager


Easy using:
-----

	$msg = new \jakubenglicky\SmsManager\Message\Message();
    $msg->setTo([420777111222]);
    $msg->setBody('Message text');

    $client = new \jakubenglicky\SmsManager\Http\Client('api-key');
    $client->send($msg);


Nette DI:
------
	extensions:
		smsmanager: jakubenglicky\SmsManager\DI\SmsManagerExtension

    smsmanager:
    	apiKey: 'sms-manager-api-key'