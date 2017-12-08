<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends CommonController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sql=Admin::find()->where(1);
        if(Yii::$app->request->get('keyword')){
            $keyword=Yii::$app->request->get('keyword');
            $sql->andwhere(['like','admin_nickname',$keyword]);
        }
        
        $sql->orderby(['admin_id'=>SORT_DESC]);
        // $a=clone $sql;
        // $a=$a->createCommand()->getRawSql();
        // var_dump($a);die();
        $dataProvider = new ActiveDataProvider([
            'query' => $sql,
            'pagination' => [
                'pagesize' => '10',
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();
        $num=$model->find()->where(['admin_type'=>'2'])->count();
        if($num<10){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->admin_pass=sha1($model->admin_pass);
                $model->save();
                return $this->redirect(['index']);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            echo "<script>alert('不能再添加更多管理员！');setTimeout(history.go(-1),1000);</script>";
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->admin_pass=sha1($model->admin_pass);
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    //ajax禁用启用
    public function actionAjax(){
        $id=Yii::$app->request->get('id');
        $model=$this->findModel($id);
        $model->admin_status=2;
        $sign=$model->save();
        if($sign){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function actionAjax1(){
        $id=Yii::$app->request->get('id');
        $model=$this->findModel($id);
        $model->admin_status=1;
        $sign=$model->save();
        if($sign){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function actionDelall(){
        $ids=yii::$app->request->get('ids');
        $ids=explode(',',$ids);
        array_pop($ids);

        $sign=false;
        foreach($ids as $v){
            $res=$this->findModel($v)->delete();
            if($res){$sign=true;}
        }
        if($sign==true){
            echo 1;
        }
    }
}
