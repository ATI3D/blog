<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />

    <!--[if IE 6]>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/DD_belatedPNG_0.0.8a.js"></script>
    <script>DD_belatedPNG.fix('img, .jcarousel-next-horizontal, .jcarousel-prev-horizontal, ul#navmenu-v li, .headright');</script>
    <![endif]-->

    <!--[if lt IE 7]>
    <style media="screen" type="text/css">#container {height:100%;}</style>
    <![endif]-->

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

   	<?php
   		Yii::app()->clientScript->registerScript(
   		   'myHideEffect',
   		   '$(".flash-success").animate({opacity: 1.0}, 5000).fadeOut("slow");',
   		   CClientScript::POS_READY
   		);
   	?>

    <script type="text/javascript">
         $(document).ready(function() {
            $("div.comment").mouseover(function(){
                $(this).children('span.answer').css("display", "block");
            });
            $("div.comment").mouseout(function(){
                $(this).children('span.answer').css("display", "none");
            });
         });
    </script>

    <link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png" />
</head>

<body>

<div id="container">

    <!--
    <div class="banbox">
		<a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/728x90.gif" width="728" height="90" alt="" /></a>
    </div>
    -->

	<!-- header -->
    <div id="header">
    
		<div class="logo">
            <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . '/images/logo.jpg', Yii::app()->name, array('width'=>222, 'height'=>41)), Yii::app()->homeUrl) ?>
        </div>
        
        <div class="topmenu">
        	<ul>
            	<li class="glav"><?php echo CHtml::link('Главная', Yii::app()->homeUrl); ?></li>
                <li class="users"><?php echo CHtml::link('Пользователи', array('user/index')); ?></li>
                <!--<li class="arch"><a href="">Архивы</a></li>-->
                <li class="cont"><?php echo CHtml::link('Контакты', array('page/view', 'id'=>2)); ?></li>
            </ul>
        </div>
            
    <div class="clear"></div>
    </div>
    <!-- header end -->
    
    <!-- body -->
    <div id="body">
        <table width="100%">
            <tr>
                <td valign="top" width="70%">
                    <!-- main td -->

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
                    <!-- main td end -->
                </td>
                <td valign="top" width="20"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" width="20" height="1" alt="" /></td>
                <td valign="top" width="30%"><!-- sidebar -->
                    <div id="sidebar">

                        <?php if(!Yii::app()->user->isGuest): ?>
                        <!-- login -->
                            <?php $this->widget('UserProfileBox'); ?>
                        <!-- login end -->
                        <?php endif; ?>

                        <?php if(Yii::app()->user->checkAccess(User::ROLE_MODER)): ?>
                            <!-- admin menu -->
                            <div id="thebest">
                                <div class="s1">
                                    <div class="s2">
                                        <span class="s_title">Главное меню</span>
                                    </div>
                                </div>
                                <div class="s">
                                    <div class="s2b">
                                        <?php
                                            $this->beginWidget('zii.widgets.CPortlet', array(
                                                'title'=>null,
                                            ));
                                            $this->widget('zii.widgets.CMenu', array(
                                                'items'=>array(
                                                    array('label'=>'Записи', 'url'=>array('/post/admin'), 'visible'=>Yii::app()->user->checkAccess(User::ROLE_MODER)),
                                                    array('label'=>'Пользователи', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMIN)),
                                                    array('label'=>'Группы', 'url'=>array('/userGroup/admin'), 'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMIN)),
                                                    array('label'=>'Страницы', 'url'=>array('/page/admin'), 'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMIN)),
                                                    array('label'=>'Настройки', 'url'=>array('/coreSetting/admin'), 'visible'=>Yii::app()->user->checkAccess(User::ROLE_ADMIN)),
                                                ),
                                                'htmlOptions'=>array('class'=>'operations'),
                                            ));
                                            $this->endWidget();
                                        ?>
                                    </div>
                                </div><!-- s s2b -->
                                <div class="s3"><div class="s4"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" height="7" /></div></div>
                            </div>
                            <!-- end admin menu -->
                        <?php endif; ?>

                        <?php if(Yii::app()->user->checkAccess(User::ROLE_MODER) && $this->menu): ?>
                            <!-- admin menu -->
                            <div id="thebest">
                                <div class="s1">
                                    <div class="s2">
                                        <span class="s_title">Операции</span>
                                    </div>
                                </div>
                                <div class="s">
                                    <div class="s2b">
                                        <?php
                                            $this->beginWidget('zii.widgets.CPortlet', array(
                                                'title'=>null,
                                            ));
                                            $this->widget('zii.widgets.CMenu', array(
                                                'items'=>$this->menu,
                                                'htmlOptions'=>array('class'=>'operations'),
                                            ));
                                            $this->endWidget();
                                        ?>
                                    </div>
                                </div><!-- s s2b -->
                                <div class="s3"><div class="s4"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" height="7" /></div></div>
                            </div>
                            <!-- end admin menu -->
                        <?php endif; ?>

                        <!-- comments  -->
                            <?php $this->widget('RecentComments'); ?>
                        <!-- comments end -->

                        <!-- best -->
                        <div id="thebest">
                            <div class="s1">
                                <div class="s2">
                                    <span class="s_title">Лучшее</span>
                                </div>
                            </div>
                            <div class="s">
                                <div class="s2b">
                                    <dl class="best">
                                    <dd>
                                        <dl>
                                            <dt><a class="gde" href="">ТАВРИЯ</a>&nbsp;&rarr;</dt>
                                            <dd><a class="topic" href=""> 1/2ОФФ: Сделал таки ТО и замену дисков, сам))</a>&nbsp;</dd>
                                        </dl>
                                    </dd>
                                    </dl>
                                </div>
                            </div><!-- s s2b -->
                            <div class="s3"><div class="s4"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" height="7" /></div></div>
                        </div>
                        <!-- best end -->

                        <!-- tags  -->
                            <?php $this->widget('TagCloud'); ?>
                        <!-- tags end -->

                    </div>
                <!-- sidebar end -->
                </td>
            </tr>
        </table>
      <div class="clear" style="height:20px;"></div>
    </div>
    <!-- body end -->
    
    <!-- footer -->
    <div id="footer">
        <div class="copyright">
            <?php echo date('Y'); ?> г.
        </div>
        <div class="counters">
            <a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/count.jpg" width="88" height="31" alt="" /></a>
        </div>
    </div>
    <!-- footer end -->

</div>

</body>
</html>