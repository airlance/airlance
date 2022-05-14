<?php
use yii\web\View;
use yii\web\Controller;
/**
 * @var $this View
 * @var $content string
 * @var $context Controller
 */
$context = $this->context;
$this->beginContent('@app/views/layouts/layout.php');
echo $content;
$this->endContent();