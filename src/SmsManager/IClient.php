<?php

namespace jakubenglicky\SmsManager;

interface IClient
{
    public function send(Message $message);
}
