<?php
namespace backend\controllers;

use yii;
use yii\web\Controller;

class IndexController extends CommonController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}