<?php

namespace jakubenglicky\SmsManager\DI\SmsManagerExtension;

use Nette\DI\CompilerExtension;

class SmsManagerExtension extends CompilerExtension
{
    public function loadConfiguration()
    {
        $config = $this->getConfig();

        if (!isset($config['username']) && !isset($config['password'])) {
            return;
        }

        $builder = $this->getContainerBuilder();
        $builder->addDefinition('smsmanager')
                ->setFactory('jakubenglicky\SmsManager\Http\Client',[
                    $config['username'],
                    $config['password'],
                    $config['hashed']
                ]);
    }
}
