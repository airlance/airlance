<?php
namespace app\controllers;

use yii\web\Controller;
use yii\web\ErrorAction;

class CommonController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}