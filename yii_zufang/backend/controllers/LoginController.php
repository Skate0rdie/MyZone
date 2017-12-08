<?php
namespace backend\controllers;

use backend\models\Admin;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class LoginController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionIndex(){
        $request = Yii::$app->request;
        if($request->isPost){
            $name=$request->post('name');
            $pwd1=$request->post('pwd');
            $pwd=sha1($pwd1);
            $jizhu=$request->post('jizhu');
            $model=Admin::find()->where(['admin_nickname'=>$name])->andWhere(['admin_pass'=>$pwd])->asArray()->one();
            if(!empty($model)){
                $session=Yii::$app->session;
                $session->open();
                $session->set('admin_id',$model['admin_id']);
                $session->set('admin_type',$model['admin_type']);
                $session->set('admin_nickname',$model['admin_nickname']);

                /*$cookie = new \yii\web\Cookie();
                $cookie -> name = 'admin_id';        //cookie的名称
                $cookie -> expire = time() + 360000;	   //存活的时间
                $cookie -> httpOnly = true;		   //无法通过js读取cookie
                $cookie -> value = $model['id'];	   //cookie的值
                \Yii::$app->response->getCookies()->add($cookie);
                if(!empty($jizhu)){
                    $cook = new \yii\web\Cookie();
                    $cook -> name = 'admin_id';        //cookie的名称
                    $cook -> expire = time() + 360000;	   //存活的时间
                    $cook -> httpOnly = true;		   //无法通过js读取cookie
                    $cook -> value = $model['id'];	   //cookie的值
                    \Yii::$app->response->getCookies()->add($cook);
                }*/
                return $this->redirect(['/index/index']);
            }
            else{
                return $this->renderPartial('login');
            }

        }else{
            return $this->renderPartial('login');
        }

    }
    public function actionEit(){
        $session = Yii::$app->session;
        $session->open();
        $session->destroy();
        return $this->redirect(['/login/index']);
    }
}
