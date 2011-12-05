<?php
$this->breadcrumbs=array(
	'Группы'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'List UserGroup', 'url'=>array('index')),
	array('label'=>'Create UserGroup', 'url'=>array('create')),
);
?>

<h1>Группы</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*
		array(
			'name'=>'id',
			'filter'=>false,
		),
		*/
		'name',
		array(
			'type' => 'html',
			'name' => 'users.members',
			'value' => '$data->getUsers()',
		),
		//'slug',
		//'level',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>
