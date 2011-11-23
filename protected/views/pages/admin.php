<?php
$this->breadcrumbs=array(
	'Страницы'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Создать', 'url'=>array('create')),
);
?>

<h1>Управление страницами</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	//'id'=>'pages-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'slug',
		//'description',
		//'keywords',
		//'text',
		/*
		'update_time',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
)); ?>
