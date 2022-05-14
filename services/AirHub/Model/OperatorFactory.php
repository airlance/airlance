<?php
namespace Services\AirHub\Model;

class OperatorFactory
{
    public static function create()
    {
        return new OperatorProvider();
    }
}