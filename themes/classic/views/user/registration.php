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
			<?php echo $form->labelEx($user,'username'); ?>
			<?php echo $form->textField($user,'username'); ?>
			<?php echo $form->error($user,'username'); ?>
		</div>

        <div class="row">
      			<?php echo $form->labelEx($profile,'email'); ?>
      			<?php echo $form->textField($profile,'email'); ?>
      			<?php echo $form->error($profile,'email'); ?>
      		</div>

		<div class="row">
			<?php echo $form->labelEx($user,'password'); ?>
			<?php echo $form->passwordField($user,'password'); ?>
			<?php echo $form->error($user,'password'); ?>
			<p class="hint"></p>
		</div>

		<div class="row">
			<?php echo $form->labelEx($user,'password_repeat'); ?>
			<?php echo $form->passwordField($user,'password_repeat'); ?>
			<?php echo $form->error($user,'password_repeat'); ?>
			<p class="hint">
				Повторите пароль.
			</p>
		</div>

		<?php if(CCaptcha::checkRequirements()): ?>
		<div class="row">
			<?php echo $form->labelEx($user,'verifyCode'); ?>
			<div>
				<?php $this->widget('CCaptcha'); ?>
				<?php echo $form->textField($user,'verifyCode'); ?>
			</div>
			    <div class="hint">Введите символы с картинки.</div>
            <?php echo $form->error($user,'verifyCode'); ?>
		</div>
		<?php endif; ?>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Регистрация'); ?>
		</div>

	<?php $this->endWidget(); ?>
	</div><!-- form -->

</div>
<!-- #page -->
