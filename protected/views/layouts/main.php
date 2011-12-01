<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	
	<?php 
		Yii::app()->clientScript->registerScript(
		   'myHideEffect',
		   '$(".flash-success").animate({opacity: 1.0}, 5000).fadeOut("slow");',
		   CClientScript::POS_READY
		);
	?>

    <!--
	<script type="text/javascript">
	var timetogo = 60;
	var timer = window.setInterval(function()
	{
		var str = timetogo;
		$('#counter').text(str);
		
		if (timetogo <= 0)
		{ 
			$('#newdiv').text('Время вышло');
			window.clearInterval(timer);
		}
		timetogo--;
	}, 1000);
	</script>
	-->
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <script type="text/javascript">
         $(document).ready(function() {
            $("div.comment").mouseover(function(){
                //$(this).css("background", "#F5F5F5");
                $(this).parent("li").css("list-style","disc");
                $(this).children('span.answer').css("display", "block");
            });
            $("div.comment").mouseout(function(){
                //$(this).css("background", "");
                $(this).parent("li").css("list-style","none");
                $(this).children('span.answer').css("display", "none");
            });
         });
    </script>

</head>

<body>

<div class="container" id="page">

<!--
<div id="counter"></div>
<div id="newdiv"></div>
-->

	<div id="header">
	
		<?php if(!Yii::app()->user->isGuest): ?>
			<?php $this->widget('UserProfileBox'); ?>
		<?php endif; ?>
		
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
		
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Главная', 'url'=>array('/post/index')),
				array('label'=>'О нас', 'url'=>array('/page/view', 'id'=>1)),
				array('label'=>'Участники', 'url'=>array('/user/index')),
				array('label'=>'Контакты', 'url'=>array('/page/view', 'id'=>2)),
				//array('label'=>'Профиль', 'url'=>array('/user/update','id'=>Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Регистрация', 'url'=>array('/user/registration'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Вход', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
				//array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	
	<!--
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
	<?php if(Yii::app()->user->hasFlash('success')):?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
	<?php endif; ?>
	
	<?php if(Yii::app()->user->hasFlash('error')):?>
		<div class="flash-error">
			<?php echo Yii::app()->user->getFlash('error'); ?>
		</div>
	<?php endif; ?>
	
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php // echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>