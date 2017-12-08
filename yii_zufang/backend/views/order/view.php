<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->user->user_nickname;
$this->params['breadcrumbs'][] = ['label' => '预约信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('删除', ['delete', 'id' => $model->order_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
               'attribute' => 'user.user_nickname', 
               'label' => '用户名',
            ],
            [
               'attribute' => 'building.bname', 
               'label' => '楼栋',
            ],
            [
               'attribute' => 'houses.ho_address', 
               'label' => '房间号',
            ],
            [
               'attribute' => 'order_type', 
               'label' => '预约类型',
               'value'=>function ($model,$column){
                      return $model->order_type==1?'看房':'租房';   
                },
            ],
            [
               'attribute' => 'order_status', 
               'label' => '预约状态',
               'value'=>function ($model,$column){
                      return $model->order_status==0?'未处理':'已处理';   
                },
            ],
            [
               'attribute' => 'user.user_tel', 
               'label' => '电话',
            ],
            [
               'attribute' => 'order_qq', 
               'label' => '用户QQ',
            ],
            [
               'attribute' => 'order_wx', 
               'label' => '用户微信',
            ],
            [
               'attribute' => 'admin.admin_nickname', 
               'label' => '负责人',
            ],
        ],
    ]) ?>

</div>
