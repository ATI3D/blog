<?php
$this->pageTitle=Yii::app()->name . ' - Вход';
$this->breadcrumbs=array(
	'Вход',
);
?>

<h1>Вход</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
)); ?>

	<p class="note">Поля обозначенные <span class="required">*</span> обязательны для заполнения.</p>
	
	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		<p class="hint">
			Введите ваши регистрационные данные.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Вход'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
