<?php
namespace Services\AirHub\Model\Cron;

use Services\AirHub\Model\DataObject\Timeline\Airport as TimelineAirport;
use Services\AirHub\Model\Resource\Timeline;
use yii\helpers\Json;

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

    protected function getRecords(CronJobInterface $query, $codes, $callback = null): array
    {
        $data['totalCount'] = 0;
        $data['items'] = [];
        foreach ($query->inCode($codes)->all() as $item) {
            $data['totalCount']++;
            $data['items'][] = $item->getPrimaryKey();
            if (is_callable($callback)) {
                $callback($item);
            }
        }

        return $data;
    }

    private $structure = [];

    private $msg = [];

    protected function addLineToStat($category, $msg, $data)
    {
        $this->msg[] = $msg;
        $this->structure[$category] = $data;
    }

    protected function updateStats()
    {
        $timeline = new Timeline;
        $timeline->setAttribute('description', implode('|', $this->msg));
        $timeline->setAttribute('object', TimelineAirport::class);
        $timeline->setAttribute('structure', Json::encode($this->structure));
        $timeline->setAttribute('duration', $this->getElapsedTime());
        $timeline->save(false);
    }
}