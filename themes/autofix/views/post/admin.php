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
		//'content',
		//'full_content',
		//'tags',
		array(
            'name'=>'status',
			'value'=>'Lookup::item("PostStatus",$data->status)',
			'filter'=>Lookup::items('PostStatus'),
        ),
		array(
			'name'=>'rating.rating',
			//'filter'=>false,
			'value'=>'PostRating::getRating($data->id)',
		),
		array(
			'name'=>'create_time',
			'filter'=>false,
			'value'=>'Yii::app()->getDateFormatter()->format("d MMMM yyyy, HH:mm", $data->create_time)',
		),
		array(
			'name'=>'update_time',
			'filter'=>false,
			'value'=>'Yii::app()->getDateFormatter()->format("d MMMM yyyy, HH:mm", $data->update_time)',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
		),
	),
)); ?>
