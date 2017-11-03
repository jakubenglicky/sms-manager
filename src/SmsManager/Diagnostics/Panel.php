<?php

namespace jakubenglicky\SmsManager\Diagnostics;

use Latte\Engine;
use Tracy\IBarPanel;

class Panel implements IBarPanel
{
    protected $lt;

    public function __construct()
    {
        $this->lt = new Engine();
    }

    public function getPanel()
    {
        return $this->lt->renderToString(__DIR__ . '/templates/panel.latte');
    }

    public function getTab()
    {
        return $this->lt->renderToString(__DIR__ . '/templates/tab.latte');
    }
}
