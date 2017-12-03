SMS Manager PHP SDK
===========
Library for sending SMS via http://smsmanager.cz/

Instalation:
-----------

	composer require jakubenglicky/sms-manager


Easy using:
-----

	$msg = new \jakubenglicky\SmsManager\Message();
    $msg->setTo([420777111222]);
    $msg->setBody('Message text');

    $client = new \jakubenglicky\SmsManager\Http\Client('user','password',FALSE);
    $client->send($msg);


Nette DI:
------
	extensions:
    	    smsmanager: jakubenglicky\SmsManager\DI\SmsManagerExtension\SmsManagerExtension

    smsmanager:
        username: 'sms-manager-user'
        password: 'sms-manager-password'
        hashed: false