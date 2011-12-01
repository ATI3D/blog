<?php
$this->pageTitle=Yii::app()->name . ' - Регистрация';
?>

<!-- page -->
<div id="text">

	<h1>Регистрация</h1>

	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'registration-form',
		'enableAjaxValidation'=>false,
		//'enableClientValidation'=>true,
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
			<p class="hint"></p>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'password_repeat'); ?>
			<?php echo $form->passwordField($model,'password_repeat'); ?>
			<?php echo $form->error($model,'password_repeat'); ?>
			<p class="hint">
				Повторите пароль.
			</p>
		</div>

		<?php if(CCaptcha::checkRequirements()): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'verifyCode'); ?>
			<div>
				<?php $this->widget('CCaptcha'); ?>
				<?php echo $form->textField($model,'verifyCode'); ?>
			</div>
			    <div class="hint">Введите символы с картинки.</div>
            <?php echo $form->error($model,'verifyCode'); ?>
		</div>
		<?php endif; ?>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Регистрация'); ?>
		</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->

</div>
<!-- #page -->
