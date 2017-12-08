<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wadmin-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if(yii::$app->session['admin_id']==1){ ?>
    <p>
        <?= Html::a('添加管理员', ['create'], ['class' => 'btn btn-success'])?>
    </p>
<?php }?>

    <?= Html::beginForm(['admin/index'], 'get', ['enctype' => 'multipart/form-data']) ?>
      <div class="col-lg-3" style="margin-left:740px">
        <?= Html::input('text', 'keyword','', ['class'=>'form-control','placeholder'=>'输入关键字搜索']) ?>
      </div>
        <?= Html::submitButton('搜索', ['class' => 'btn btn-warning']) ?>
        <?= Html::a('还原', ['admin/index'], ['class' => 'btn btn-info']) ?>
  
    <?= Html::endForm() ?>
    <?= Html::a("批量删除", "javascript:void(0);", ["class" => "btn btn-danger gridview"]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        "options" => ["id" => "grid"],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                "class" => "yii\grid\CheckboxColumn",
                "name" => "admin_id",
            ],
            [
               'attribute' => 'admin_nickname',  
               'label' => '昵称',
            ],
            [
               'attribute' => 'admin_sex',  
               'label' => '性别',
               'value'=>function ($model,$key,$index,$column){
                      if($model->admin_sex==1){
                        return '男';
                      }else if($model->admin_sex==2){
                        return '女';
                      }else{
                        return '保密';
                      }
                },
            ],
            [
               'attribute' => 'admin_status',  
               'label' => '状态',
               'value'=>function ($model,$key,$index,$column){
                      return $model->admin_status==1?'正常':'禁用';   
                },
            ],
            [
               'attribute' => 'admin_type',  
               'label' => '等级',
               'value'=>function ($model,$key,$index,$column){
                      return $model->admin_type==1?'超级管理员':'子管理员';   
                },
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success btn-sm">查看</span>', $url, ['title' => '查看', 'target' => '_self']);
                    },
                    'update' => function ($url, $model) {
                      if(yii::$app->session['admin_type']==1||$model->admin_id==yii::$app->session['admin_id'])
                        return Html::a('<span class="btn btn-primary btn-sm">修改</span>', $url, ['title' => '修改', 'target' => '_self']);
                    },
                    'delete' => function ($url, $model) {
                      if(yii::$app->session['admin_type']==1)
                        if($model->admin_status==1){
                          return Html::a('<span class="btn btn-danger btn-sm">禁用</span>', '#', ['title' => '禁用']);
                        }else{
                          return Html::a('<span class="btn btn-info btn-sm">启用</span>', '#', ['title' => '启用']);
                        }
                    },
                ],
            ],
        ],
    ]); ?>
</div>
<script>
$(document).ready(function(){
  $("tr .btn-danger").click(function(){
    var id = $(this).parents('tr').attr('data-key');
    $.get("index.php?r=admin/ajax",{"id":id},function(data){
      if(data==1){
        location.reload();
      }else{
        alert('禁用失败');
      }
    });
  });
  $(".btn-info").click(function(){
    var id = $(this).parents('tr').attr('data-key');
    $.get("index.php?r=admin/ajax1",{"id":id},function(data){
      if(data==1){
        location.reload();
      }else{
        alert('启用失败');
      }
    });
  });
  $("input[name='admin_id_all']").click(function(){

        if(this.checked){   
            $("input[name='admin_id[]']").prop("checked", true);  
        }else{
            $("input[name='admin_id[]']").prop("checked", false);
        }
    });
    $(".gridview").click(function(){
        var keys = $("input[name='admin_id[]']:checked").length;
        if(keys<1){
            alert('请至少选择一项');
        }else{
            var v='';
            $("input[name='admin_id[]']:checked").each(function(){
                v+=$(this).val()+',';
            });
            $.get("index.php?r=admin/delall",{"ids":v},function(data){
                if(data==1){
                    $("input[name='admin_id[]']:checked").each(function(){
                        $(this).parents('tr').hide();
                    });
                }
            });
        }
    });
});
</script>
