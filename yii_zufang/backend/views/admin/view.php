<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\WAdmin */

$this->title = $model->admin_nickname;
$this->params['breadcrumbs'][] = ['label' => '管理员中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wadmin-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->admin_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->admin_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要移除此管理员吗?'
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'admin_id',
            [
               'attribute' => 'admin_sex', 
               'value'=>function ($model,$column){
                    if($model->admin_sex==1){
                        return '男';
                    }else if($model->admin_sex==2){
                        return '女';
                    }else{
                        return '保密';
                    }
                    //return $model->admin_sex==1?'男':$model->admin_sex==2?'女':'保密';   
                },
            ],
            'admin_nickname',
            'admin_tel',
            'num_wechat',
            'num_alipay',
            [
               'attribute' => 'admin_type', 
               'label' => '级别',
               'value'=>function ($model,$column){
                      return $model->admin_type==1?'超级管理员':'子管理员';   
                },
            ],
            [
               'attribute' => 'admin_status', 
               'label' => '状态',
               'value'=>function ($model,$column){
                      return $model->admin_status==1?'正常':'禁用';   
                },
            ],
        ],
    ]) ?>

</div>
