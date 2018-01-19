<?php


namespace app\controllers;

use yii\web\Controller;

class DatabaseController extends Controller
{
    public function actionIndex() {
        return $this->render('index');
    }
}