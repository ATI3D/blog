<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Управление',
);

$this->menu=array(
	//array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Управление записями</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'user_id',
		'title',
		'content',
		//'full_content',
		//'tags',
		/*
		'status',
		'rating',
		'create_time',
		'update_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
