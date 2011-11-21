<div class="view">
	
	<!--
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('role')); ?>:</b>
	<?php echo CHtml::encode($data->role); ?>
	<br />
	-->
	
	<?php if(!empty($data->profile->avatar)): ?>
		<?php echo CHtml::image(Yii::app()->baseUrl . '/upload/avatars/' . $data->username . '/' . $data->profile->avatar, $data->username, array(
			'title'=>$data->username,
			'width'=>50,
			'height'=>50,
		));
		?>
	<?php else: ?>
		<?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . 'default_avatar.gif', $data->username, array(
			'title'=>$data->username,
			'width'=>50,
			'height'=>50,
		));
		?>
	<?php endif; ?>
	
	<span style="float: right;">
		<?php echo CHtml::link(CHtml::encode($data->username), array('view', 'id'=>$data->id)); ?>
	</span>


</div>