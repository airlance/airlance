<?php
namespace Services\AirHub\Model\Cron;

use Services\AirHub\Model\Resource\Airport\CodeInterface;
use Services\AirHub\Model\Resource\Timeline;

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

    protected function getCodeRecords(CodeInterface $query, $codes, $callback = null): array
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

    protected function updateStats($className)
    {
        if (!empty($this->msg)) {
            $timeline = new Timeline;
            $timeline->setAttribute('description', implode('|', $this->msg));
            $timeline->setAttribute('object', $className);
            $timeline->setAttribute('duration', $this->getElapsedTime());
            if ($timeline->save(false)) {
                $timeline->createJsonFile($this->structure);
            }
        }
    }
}