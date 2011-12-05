<?php
/*
$this->pageTitle = $model->title;
$this->pageDescription = $model->description;
$this->pageKeywords = $model->keywords;
*/
?>

<h1><?php echo $model->name; ?></h1>

<?php echo $model->text; ?>

<p>
	<?php 
	if(Yii::app()->user->checkAccess(User::ROLE_MODER))
		echo CHtml::link('Редактировать', array('page/update', 'id'=>$model->id));
	?>
</p>
