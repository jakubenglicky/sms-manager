<?php

namespace jakubenglicky\SmsManager\Diagnostics;

use Latte\Engine;
use Tracy\IBarPanel;

class Panel implements IBarPanel
{

    /**
     * @var string
     */
    private $tempDir;

    /**
     * @var Engine
     */
    private $lt;

    /**
     * Panel constructor.
     * @param string $tempDir
     */
    public function __construct($tempDir = '')
    {
        $this->tempDir = $tempDir . '/sms';
        $this->lt = new Engine();
    }

    /**
     * Render Tracy Panel
     * @return string
     */
    public function getPanel()
    {
        $messages = [];
        if (file_exists($this->tempDir)) {
            $messages = scandir($this->tempDir);
        }

        $result = [];
        foreach ($messages as $sms) {
            if ($sms != '.' && $sms != '..') {
                $data = explode('|', file_get_contents($this->tempDir . '/' . $sms));

                $result[] = [
                    'body' => $data[0],
                    'numbers' => $data[1],
                ];
            }
        }

        $params = [
            'messages' => $result,
        ];

        return $this->lt->renderToString(__DIR__ . '/templates/panel.latte', $params);
    }

    /**
     * render Tracy Tab
     * @return string
     */
    public function getTab()
    {
        $count = 0;
        if (file_exists($this->tempDir)) {
            $count = count(scandir($this->tempDir)) - 2;
        }

        $params = [
            'count' => $count,
        ];

        return $this->lt->renderToString(__DIR__ . '/templates/tab.latte', $params);
    }
}
