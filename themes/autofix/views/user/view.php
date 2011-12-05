<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->id,
);

/*
$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
*/
?>

<h1>Пользователь &rarr; <?php echo $model->username; ?></h1>

<?php/* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'role',
	),
)); */?>

<div class="view">

	<?php if($model->profile->avatar): ?>
		<?php echo CHtml::image(Yii::app()->baseUrl . '/upload/avatars/' . $model->username . '/' . $model->profile->avatar, $model->username, array(
			'title'=>$model->username,
			'width'=>50,
			'height'=>50,
		));
		?>
	<?php else: ?>
		<?php echo CHtml::image(Yii::app()->baseUrl . '/images/' . 'default_avatar.gif', $model->username, array(
			'title'=>$model->username,
			'width'=>50,
			'height'=>50,
		));
		?>
	<?php endif; ?>
	
	<span style="padding: 10px;"></span>
	
</div>


