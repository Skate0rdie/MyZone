<?php

namespace backend\controllers;

use Yii;
use backend\models\Order;
use backend\models\Building;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sql=Order::find()
            ->joinwith('user')
            ->joinwith('building')
            ->joinwith('houses')
            ->select('w_order.*,w_user.user_nickname,w_user.user_tel,w_building.buil_name,w_houses.ho_hname')
            ->orderby(['order_time'=>SORT_DESC])
            ->where(1);
        // $a=clone $sql;
        // $a=$a->createCommand()->getRawSql();
        // var_dump($a);die();

        //搜索条件判断
        $keyword=Yii::$app->request->get('keyword');
        if($keyword){
            $sql->andwhere(['like','w_user.user_nickname',$keyword]);
        }
        $builds=Yii::$app->request->get('builds');
        if(!empty($builds)){
            $sql->andwhere(['w_building.buil_id'=>$builds]);
        }
        $type=Yii::$app->request->get('type');
        if(!empty($type)){
            $sql->andwhere(['order_type'=>$type]);
        }
        $status=Yii::$app->request->get('status');
        if(!empty($status)){
            $sql->andwhere(['order_status'=>$status]);
        }
        //权限判断
        $session=yii::$app->session;
        if($session['admin_id']!=1){
            $sql->andwhere(['w_order.admin_id'=>$session['admin_id']]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $sql,
            'pagination' => [
                'pagesize' => '10',
            ]
        ]);

        $build=Building::find()->select('buil_id,buil_name')->all();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'build' => $build,
        ]);
    }

    /**
     * Displays a single Order model.
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
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjax(){
        $id=Yii::$app->request->get('id');
        $sign=Yii::$app->db->createCommand()->update('w_order', ['order_status' => 1], "order_id = $id")->execute();
        if($sign){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function actionAjax1(){
        $sql=Order::find()
            ->joinwith('user')
            ->joinwith('building')
            ->joinwith('houses')
            ->select('w_order.*,w_user.user_nickname,w_user.user_tel,w_building.buil_name,w_houses.ho_hname')
            ->where(1);

        $keyword=Yii::$app->request->get('name');
        $id=Yii::$app->request->get('key');
        if($keyword=='builds'){
            $sql->andwhere(['w_building.buil_id'=>$id]);
        }
        if($keyword=='type'){
            $sql->andwhere(['order_type'=>$id]);
        }
        if($keyword=='status'){
            $sql->andwhere(['order_status'=>$id]);
        }
        //权限判断
        $session=yii::$app->session;
        if($session['admin_id']!=1){
            $sql->andwhere(['w_order.admin_id'=>$session['admin_id']]);
        }

        // $a=clone $sql;
        // $a=$a->createCommand()->getRawSql();
        // print_r($a);die();

        $arr=$sql->all();
        //print_r($arr);die();
        $res=array();
        foreach($arr as $v){
            $order_type=$v['order_type']==1?"看房":"租房";
            $order_time=date('Y-m-d',$v['order_time']);
            $order_status=$v['order_status']==0?"<span class='btn btn-primary btn-sm'>处&nbsp;&nbsp;&nbsp;理</span>":"<span class='btn btn-default btn-sm'>已处理</span>";
            $res[]="<tr data-key=".$v['order_id']."><td>".$v['order_id']."</td><td>".$v->user['user_nickname']."</td><td>".$v->user['user_tel']."</td><td>".$v->building['buil_name']."</td><td>".$v->houses['ho_hname']."</td><td>".$order_type."</td><td>".$order_time."</td><td><a href='#'>".$order_status."</a></td><td><a href='/yii_zufang/backend/web/index.php?r=order%2Fview&amp;id=".$v['order_id']."' title='查看' target='_self'><span class='btn btn-success btn-sm'>查看</span></a> <a href='/yii_zufang/backend/web/index.php?r=order%2Fdelete&amp;id=".$v['order_id']."' title='删除'><span class='btn btn-danger btn-sm'>删除</span></a></td></tr>";
        }
        $array=array('res'=>$res);
        $res=json_encode($array);
        echo $res;
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
