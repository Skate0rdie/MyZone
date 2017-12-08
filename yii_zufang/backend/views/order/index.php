<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '预约信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::beginForm(['order/index'], 'get', ['enctype' => 'multipart/form-data']) ?>
            <div class="col-lg-3">
                <?= Html::input('text', 'keyword',isset($_GET['keyword'])?$_GET['keyword']:'', ['class'=>'form-control','placeholder'=>'输入关键字搜索']) ?>
            </div>
            <div class="col-lg-2">
                <?= Html::dropDownList('builds', isset($_GET['builds'])?$_GET['builds']:'', ArrayHelper::map($build, 'buil_id', 'buil_name'), ['prompt'=>'--请选择--','class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= Html::dropDownList('type', isset($_GET['type'])?$_GET['type']:'', ['1'=>'看房','2'=>'租房'], ['prompt'=>'--请选择--','class'=>'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= Html::dropDownList('status', isset($_GET['status'])?$_GET['status']:'', ['0'=>'未处理','1'=>'已处理'], ['prompt'=>'--请选择--','class'=>'form-control']) ?>
            </div>
            <?= Html::submitButton('搜索', ['class' => 'btn btn-warning']) ?>
            <?= Html::a('还原', ['order/index'], ['class' => 'btn btn-info']) ?>

        <?= Html::endForm() ?>
    </p>
    <?= Html::a("批量删除", "javascript:void(0);", ["class" => "btn btn-success gridview"]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        "options" => ["id" => "grid"],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
               'attribute' => 'user.user_nickname',  
               'label' => '昵称',
            ],
            [
               'attribute' => 'user.user_tel',  
               'label' => '联系电话',
            ],
            [
               'attribute' => 'building.buil_name',  
               'label' => '楼栋',
            ],
            [
               'attribute' => 'houses.ho_hname',  
               'label' => '房间',
            ],
            [
               'attribute' => 'order_type',  
               'label' => '类型',
               'value'=>function ($model,$key,$index,$column){
                      return $model->order_type==1?'看房':'租房';   
                },
            ],
            [
                'attribute'=>'order_time',
                'label' => '预约发起时间',
                'format'=>['datetime','php:Y-m-d']
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => '状态', 'template' => '{update}',
                'buttons' => [
                    'update' => function ($url,$model) {
                        if($model->order_status==0){
                            return Html::a('<span class="btn btn-primary btn-sm">处&nbsp;&nbsp;&nbsp;&nbsp;理</span>', '#', ['title' => '处理']);
                        }else{
                            return Html::a('<span class="btn btn-default btn-sm">已处理</span>', '#');
                        } 
                    },
                ],
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success btn-sm">查看</span>', $url, ['title' => '查看', 'target' => '_self']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="btn btn-danger btn-sm">删除</span>', $url, ['title' => '删除']);
                    },
                ],
            ],
            [
                "class" => "yii\grid\CheckboxColumn",
                "name" => "order_id",
            ],
        ],
    ]);
    ?>
</div>
<script>
$(document).ready(function(){
    //处理为处理ajax
    $(".btn-primary").click(function(){
       var id = $(this).parents('tr').attr('data-key');
       $.get('index.php?r=order/ajax',{"id":id},function(data){
        if(data==1){
            location.reload();
        }else{
            alert('处理失败！');
        }
       }); 
    });
    //搜索ajax
    $("select").change(function(){
        var key=$(this).val();
        var name=$(this).attr('name');
        if(key==''){return;}
        $.get("index.php?r=order/ajax1",{"key":key,"name":name},function(data){
            data=eval('(' + data + ')');
            $("tbody").html(data.res);   
        });
    });
    //多删
    $("input[name='order_id_all']").click(function(){

        if(this.checked){   
            $("input[name='order_id[]']").prop("checked", true);  
        }else{
            $("input[name='order_id[]']").prop("checked", false);
        }
    });
    $(".gridview").click(function(){
        var keys = $("input[name='order_id[]']:checked").length;
        if(keys<1){
            alert('请至少选择一项');
        }else{
            var v='';
            $("input[name='order_id[]']:checked").each(function(){
                v+=$(this).val()+',';
            });
            $.get("index.php?r=order/delall",{"ids":v},function(data){
                if(data==1){
                    $("input[name='order_id[]']:checked").each(function(){
                        $(this).parents('tr').hide();
                    });
                }
            });
        }
    });
});
</script>
