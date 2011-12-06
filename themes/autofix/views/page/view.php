<?php
/*
$this->pageTitle = $model->title;
$this->pageDescription = $model->description;
$this->pageKeywords = $model->keywords;
*/

$this->menu=array(
	//array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Редактировать', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Создать', 'url'=>array('create')),
    array('label'=>'Управление', 'url'=>array('admin')),
);

?>

<h1><?php echo $model->name; ?></h1>

<?php echo $model->text; ?>
