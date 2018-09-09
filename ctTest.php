<?php
function executedCode() {
    // Place Code to Time Here
}
require __DIR__ . '/src/CodeTimer/CodeTimer.php';
require __DIR__ . '/src/CodeTimer/Resources.php';
function getTrialCount() {
    echo PHP_EOL . "\e[1;32mTrial Count:\e[0m ";
    $handle = fopen ("php://stdin","r");
    $line = fgets ($handle);
    $trials = trim($line);
    if (!ctype_digit($trials) || $trials < 1) {
        echo PHP_EOL . "\e[1;91mTrial count must be a whole number above or equal to one!\e[0m";
        $trials = getTrialCount();
    }
    return $trials;
}
$trials = getTrialCount();
echo PHP_EOL . "\e[1;32mRunning \e[1;31m" . $trials . " \e[1;32mtrials in \e[1;31m3\e[1;32m seconds!\e[0m";
sleep(3);
$codeTimer = new CodeTimer_CodeTimer();
$codeTimerRss = new CodeTimer_Resources(true);
$i = 0;
$codeTimerRss->setStartRss();
while ($i++ < $trials) {
    $codeTimer->startTime();
    executedCode();
    $codeTimer->stopTime();
    echo (PHP_EOL . "\e[1;33m" . ($trials - $i) . " \e[1;32mTrials Remaining - \e[1;32m" . (float)($i / $trials)*100 . "%\e[1;32m Complete - Using \e[1;31m" . $codeTimerRss->getCurrentRss()->memory . "\e[1;32mMBs of Memory\e[0m" . PHP_EOL);
}
echo "\e[1;31m" . $trials . " \e[1;32mTrials Successful\e[0m";
echo $codeTimer->getTime(true);
