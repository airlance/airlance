<?php
namespace Services\AirHub\Model\DataObject;

use yii\helpers\Json;
use Yii;

class BaseAirport
{
    protected $id = '';

    protected $method = 'GET';

    protected $uri = '';

    protected $filename = '{id}_airports.json';

    public function fetch()
    {
        $file = $this->getFilePath();
        if (file_exists($file)) {
            $json = file_get_contents($file);
        } else {
            $client = new \GuzzleHttp\Client([
                'allow_redirects' => false,
                'verify' => false
            ]);

            $response = $client->request($this->method, $this->uri, [
                'headers' => ['Accept' => 'application/json']
            ]);

            $json = $this->moveFile($file, $response);
        }

        return Json::decode($json);
    }

    protected function moveFile($file, $response)
    {
        $content = $response->getBody()->getContents();
        file_put_contents($file, $content);

        return $content;
    }

    protected function getFilePath()
    {
        $path = Yii::getAlias('@runtime');
        return $path . '/' . str_replace('{id}', $this->id, $this->filename);
    }
}