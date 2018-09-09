<?php
class CodeTimer_Resources {
    private $startRss;
    private $opts = array(
        'realUsage' => true
    );
    public function __construct($real = false) {
        $this->opts['realUsage'] = $real;
        $this->setStartRss();
    }
    public function setStartRss() {
        $this->startRss = memory_get_peak_usage($this->opts['realUsage']);
    }
    public function getCurrentRss() {
        return array(
            'memory' => memory_get_peak_usage($this->opts['realUsage']) / 1048576
        );
    }
    public function getRssUsage() {
        return array(
            'memory' => array(
                'start' => $this->startRss,
                'current' => $this->getCurrentRss()->memory,
            )
        );
    }
}
