<?php
namespace Services\AirHub\Model\Cron;

class CronJob
{
    private $microseconds;

    private $time;

    public function __construct()
    {
        [$this->microseconds, $this->time] = explode(' ', microtime());
    }

    protected function getElapsedTime()
    {
        [$microsecondsEnd, $timeEnd] = explode(' ', microtime());
        $this->microseconds = $microsecondsEnd - $this->microseconds;
        $this->time = $timeEnd - $this->time;

        return sprintf("%.3f ms", round($this->time + $this->microseconds, 6));
    }
}