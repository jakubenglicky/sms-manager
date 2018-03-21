<?php

/**
 * Part of jakubenglicky/sms-manager
 * @author Jakub Englický
 */

namespace jakubenglicky\SmsManager\DI;

use Nette\DI\CompilerExtension;
use jakubenglicky\SmsManager\IClient;

class SmsManagerExtension extends CompilerExtension
{
    public function loadConfiguration()
    {
        $config = $this->getConfig();

        if (!isset($config['apiKey'])) {
            return;
        }

        $builder = $this->getContainerBuilder();

        $smsmanager = $builder->addDefinition('smsmanager')
            ->setClass(IClient::class);

        $smsmanager->setFactory('jakubenglicky\SmsManager\Http\Client', [
            $config['apiKey']
        ]);
    }
}
