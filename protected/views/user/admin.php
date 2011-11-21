<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Управление',
);

$this->menu=array(
	//array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Управление пользователями</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'username',
		//'email',
		array(
            'name'=>'role',
			'filter'=>User::model()->getRoleOptions(),
            'value'=>'$data->getRoleText()',
		),
		'group.name',
		'profile.first_name',
		//'profile.last_name',
		'profile.email',
		array(
			'name'=>'create_time',
			'filter'=>false,
			'value'=>'Yii::app()->getDateFormatter()->format("d MMMM yyyy, HH:mm", $data->create_time)',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>
