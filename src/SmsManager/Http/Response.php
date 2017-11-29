<?php

namespace jakubenglicky\SmsManager\Http;


class Response
{
    /**
     * @var string
     */
    private $body;

    /*
     * @var bool
     */
    private $isOk;

    /**
     * @var int code
     */
    private $code;

    /**
     * @var int
     */
    private $messageId;

    /**
     * @var array
     */
    private $recepitiens;


    /**
     * ApiResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->body = trim($response);

        $items = explode('|',$this->body);

        if ($items[0] === 'OK') {
            $this->isOk = TRUE;
            $this->code = 200;
            $this->messageId = $items[1];
            $this->recepitiens = explode(',',$items[2]);
        }
    }

    /**
     * @return bool
     */
    public function isOk()
    {
        return $this->isOk;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return array
     */
    public function getRecepitiens()
    {
        return $this->recepitiens;
    }

}
