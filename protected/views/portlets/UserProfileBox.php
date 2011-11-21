<div style="float: right; padding: 10px 0px 10px 0px; width: 350px;">
	<span style="float: right; padding-right: 10px;">
		<?php if($model->profile->avatar): ?>
			<?php echo CHtml::image(Yii::app()->baseUrl . '/upload/avatars/' . $model->username . '/' . $model->profile->avatar, $model->username, array(
				'title'=>$model->username,
				'width'=>35,
				'height'=>35,
			));
			?>
		<?php else: ?>
			<?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . 'default_avatar.gif', $model->username, array(
				'title'=>$model->username,
				'width'=>35,
				'height'=>35,
			));
			?>
		<?php endif; ?>
	</span>
	<?php/* $this->widget('zii.widgets.CMenu',array(
		'htmlOptions'=>array(
			'class'=>'usermenu',
		),
		'items'=>array(
			//array('label'=>'На сайт', 'url'=>Yii::app()->homeUrl, 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Профиль', 'url'=>array('/user/update', 'id'=>$model->id), 'visible'=>!Yii::app()->user->isGuest),
			array('label'=>'Выход ('.$model->username.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
		),
	)); */?>
	
	Вы вошли как, <strong><?php echo $model->username; ?></strong> | 
	<?php echo CHtml::link('Профиль', array('/user/update', 'id'=>$model->id)); ?> | 
	<?php echo CHtml::link('Выход', array('/user/logout')); ?> <br />
	<span style="color: gray;">Личных сообщений нет</span>
	
</div>