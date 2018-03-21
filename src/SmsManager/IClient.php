<?php

/**
 * Part of jakubenglicky\sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager;

use jakubenglicky\SmsManager\Http\ErrorResponse;
use jakubenglicky\SmsManager\Http\Response;
use jakubenglicky\SmsManager\Message\Message;

interface IClient
{
    /**
     * @param Message $message
     * @return Response|ErrorResponse
     */
    public function send(Message $message);
}
