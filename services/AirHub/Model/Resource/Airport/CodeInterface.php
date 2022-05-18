<?php
namespace Services\AirHub\Model\Resource\Airport;

interface CodeInterface
{
    public function inCode($code);

    public function notInCode($code);
}