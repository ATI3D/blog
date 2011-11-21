<?php
$this->breadcrumbs=array(
	'Core Settings',
);

$this->menu=array(
	array('label'=>'Create CoreSetting', 'url'=>array('create')),
	array('label'=>'Manage CoreSetting', 'url'=>array('admin')),
);
?>

<h1>Core Settings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
