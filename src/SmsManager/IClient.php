<?php

namespace jakubenglicky\SmsManager;

interface IClient
{
    /**
     * @param Message $message
     * @return mixed
     */
    public function send(Message $message);
}
