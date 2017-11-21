<?php

namespace jakubenglicky\SmsManager;

use GuzzleHttp;
use jakubenglicky\SmsManager\Exceptions\EmptyTextException;
use jakubenglicky\SmsManager\Exceptions\InvalidCredentialsException;
use jakubenglicky\SmsManager\Exceptions\UndefinedNumberException;

class HttpClient implements IClient
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    public function __construct(array $config)
    {
        $this->username = $config['username'];

        if ($config['hashed']) {
            $this->password = $config['password'];
        } else {
            $this->password = sha1($config['password']);
        }
    }

    /**
     * Send SMS via HTTP GET request
     * @param Message $message
     */
    public function send(Message $message)
    {
        if (empty($message->numbers))
            throw new UndefinedNumberException('Define at least one number',500);

        if (empty($message->text))
            throw new EmptyTextException('You must define text of SMS',500);

        $client = new GuzzleHttp\Client();

        try {
            $res = $client->request('GET', 'https://http-api.smsmanager.cz/Send', [
                'query' => [
                    'username' => $this->username,
                    'password' => $this->password,
                    'number' => implode(',',$message->numbers),
                    'gateway' => $message->messageType,
                    'message' => $message->text,
                ]
            ]);

            echo $res->getBody();

        } catch (GuzzleHttp\Exception\ClientException $clientEx) {

            $code = $clientEx->getCode();
            if ($code === 401)
                throw new InvalidCredentialsException('Check your SMS Manager credentials!',$code);
        }
    }
}
