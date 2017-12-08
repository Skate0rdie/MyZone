<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WAdmin */

$this->title = '编辑管理员: ' . $model->admin_nickname;
$this->params['breadcrumbs'][] = ['label' => '管理员中心', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->admin_nickname, 'url' => ['view', 'id' => $model->admin_id]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="wadmin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="wadmin-form">

	    <?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'admin_nickname')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'admin_sex')->radioList(['0'=>'保密','1'=>'男','2'=>'女']) ?>

	    <?= $form->field($model, 'admin_pass')->passwordInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'admin_tel')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'num_wechat')->textInput(['maxlength' => true]) ?>

	    <?= $form->field($model, 'num_alipay')->textInput(['maxlength' => true]) ?>

	    <div class="form-group">
	        <?= Html::submitButton('修改', ['class' => 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>

</div>
