<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;



class CommonController extends Controller{


    public function __construct($id, $module){
        parent::__construct($id, $module);
        
        $session = Yii::$app->session;
        $session->open();
        if(!$session->has('admin_id')){
            return $this->redirect(['/login/index']);
        }
    }
}