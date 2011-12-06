<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data',
		'onSubmit'=>'this.yt0.disabled=true;this.yt0.value="Подождите"',
	),
)); ?>

	<p class="note">Поля обозначенные <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary(array($user, $profile)); ?>
	
	<fieldset>
	<legend>Основные параметры</legend>
		<div class="row">
			<?php echo $form->labelEx($user,'username'); ?>
			
			<?php 
			if($user->isNewRecord)
				echo $form->textField($user,'username',array('size'=>20,'maxlength'=>128));
			else
				echo $form->textField($user,'username',array('size'=>20,'maxlength'=>128,'disabled'=>'disabled'));
			?>
			
			<?php echo $form->error($user,'username'); ?>
		</div>

        <div class="row">
            <?php echo $form->labelEx($profile,'email'); ?>
            <?php echo $form->textField($profile,'email',array('size'=>20,'maxlength'=>128,'disabled'=>'disabled')); ?>
            <?php echo $form->error($profile,'email'); ?>
     	</div>

		<div class="row">
			<?php echo $form->labelEx($user,'password'); ?>
			<?php if(!$user->isNewRecord): ?>
				<div class="hint">Указывайте пароль только если вы хотите его поменять.</div>
			<?php endif; ?>
			<?php echo $form->passwordField($user,'password',array('value'=>'','size'=>20,'maxlength'=>32)); ?>
			<?php echo $form->error($user,'password'); ?>
		</div>

		<?php // if($user->isNewRecord): ?>
			<div class="row">
				<?php echo $form->labelEx($user,'password_repeat'); ?>
				<div class="hint">Еще раз введите пароль</div>
				<?php echo $form->passwordField($user,'password_repeat',array('value'=>'','size'=>20,'maxlength'=>32)); ?>
				<?php echo $form->error($user,'password_repeat'); ?>
			</div>
		<?php // endif; ?>

		<?php if(Yii::app()->user->checkAccess(User::ROLE_ADMIN)): ?>
			<div class="row">
				<?php echo $form->labelEx($user,'group_id'); ?>
				<?php echo $form->DropDownList($user,'group_id',CHtml::listData(UserGroup::model()->findAll(array('select'=>'id, name')),'id','name')); ?>
				<?php echo $form->error($user,'group_id'); ?>
			</div>
		<?php endif; ?>
		
		<?php if(Yii::app()->user->checkAccess(User::ROLE_ADMIN)): ?>
			<div class="row">
				<?php echo $form->labelEx($user,'role'); ?>
				<?php echo CHtml::activeDropDownList($user,'role', User::model()->RoleOptions); ?>
				<?php echo $form->error($user,'role'); ?>
			</div>
		<?php endif; ?>
	</fieldset>
	
	<?php if(!$user->isNewRecord): ?>
		<fieldset>
			<legend>Личные данные</legend>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'first_name'); ?>
				<?php echo $form->textField($profile,'first_name',array('size'=>20,'maxlength'=>128)); ?>
				<?php echo $form->error($profile,'first_name'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'last_name'); ?>
				<?php echo $form->textField($profile,'last_name',array('size'=>20,'maxlength'=>128)); ?>
				<?php echo $form->error($profile,'last_name'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'birthday'); ?>
				<?php			
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					'model'=>$profile,
					//'name'=>'birthday',
					'attribute'=>'birthday',
					'value'=>$profile->birthday,
					'language'=>'ru',
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fade', //fade
						'dateFormat'=>'yy-mm-dd',
						'yearRange'=>'1940:2011',
						'changeMonth'=>true,
						'changeYear'=>true,
						//'showButtonPanel'=>true,
						//'showOtherMonths'=>true,
						//'showOn'=>'button',
						//'buttonImageOnly'=>true,
					),
					'htmlOptions'=>array(
						//'style'=>'height:20px;'
					),
				));
				?>
				<?php echo $form->error($profile,'birthday'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($profile,'avatar'); ?>
					<div class="hint">Не более 1 мб, форматы: jpg, gif, png</div>
				<?php echo $form->fileField($profile,'avatar'); ?>
				<?php echo $form->error($profile,'avatar'); ?>
			</div>
			
		</fieldset>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($user->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->