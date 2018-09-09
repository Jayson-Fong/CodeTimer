<?php
class CodeTimer_CodeTimer {
    private $start;
    private $stop;
    private $data = array();
    public function __construct() {
        $this->start = microtime(true);
    }
    public function startTime() {
        $this->start = microtime(true);
    }
    public function stopTime() {
        $this->stop = microtime(true);
        $this->setTimeDifferance();
    }
    public function getTimeDifferance() {
        if ($this->stop) return $this->stop - $this->start;
        return microtime(true) - $this->start;
    }
    public function getTimeAverage() {
        $this->cleanData();
        if (count($this->data) >= 1) {
            return array_sum($this->data)/count($this->data);
        }
        return 0;
    }
    public function getTime($avg = false) {
        if ($avg) {
            return $this->getTimeFormatted($this->getTimeAverage());
        }
        return $this->getTimeFormatted($this->getTimeDifferance());
    }
    public function resetTimes($full = false) {
        $this->start = null;
        $this->stop = null;
        if ($full) $this->data = array();
    }
    private function setTimeDifferance() {
        $this->data[] = $this->getTimeDifferance();
    }
    private function cleanData() {
        $this->data = array_filter($this->data);
    }
    private function getTimeFormatted($time) {
        $days = floor($time / 86400);
        $time -= $days * 86400;
        $hours = floor($time / 3600);
        $time -= $hours * 3600;
        $mins = floor($time / 60);
        $time -= $mins * 60;
        $ms = ($time - floor($time)) * 1000;
        $secs = floor($time);
        return
            PHP_EOL . (empty($days) ? '' : "\033[0;31m" . $days . "\033[0mD ") .
            (empty($hours) ? '' : "\033[0;31m" . $hours . "\033[0mH ") .
            (empty($mins) ? '' : "\033[0;31m" . $mins . "\033[0mM ") .
            "\033[0;31m" . $secs . "\033[0mS " .
            "\033[0;31m" . $ms . "\033[0mMS" . PHP_EOL;
    }
}
