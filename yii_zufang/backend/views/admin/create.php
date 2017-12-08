<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\WAdmin */

$this->title = '添加管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wadmin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="wadmin-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'admin_type')->hiddenInput(['value'=>2]) ?>

		<?= $form->field($model, 'admin_nickname')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'admin_sex')->radioList(['0'=>'保密','1'=>'男','2'=>'女']) ?>

	    <?= $form->field($model, 'admin_pass')->passwordInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'admin_tel')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'num_wechat')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'num_alipay')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'admin_status')->hiddenInput(['value'=>1]) ?>

	    <div class="form-group">
	        <?= Html::submitButton('添加', ['class' =>'btn btn-success']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>

</div>
