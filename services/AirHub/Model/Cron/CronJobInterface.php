<?php
namespace Services\AirHub\Model\Cron;

interface CronJobInterface
{
    public function inCode($code);

    public function notInCode($code);
}