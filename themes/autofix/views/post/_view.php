<!--
<div class="post">

    <div class="title">
        <?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
    </div>

    <div class="author">
        добавил <?php echo CHtml::link($data->user->username, array('user/view','id'=>$data->user->id)) . ' ' . Yii::app()->getDateFormatter()->format("d MMMM yyyy в HH:mm", $data->create_time); ?>
        <?php if(Yii::app()->user->checkAccess(User::ROLE_MODER)): ?>
            <span class="status_<?php echo $data->status; ?>" style="float: right;"><?php echo Lookup::item("PostStatus",$data->status); ?></span>
        <?php endif; ?>
    </div>

    <div class="content">
        <?php echo (int)$_GET['id'] ? $data->content : $data->short_content; ?>
    </div>

    <div class="nav">
        <b>Теги:</b>
        <?php echo implode(', ', $data->tagLinks); ?>
        <br/>
        <?php // echo CHtml::link('Permalink', $data->url); ?>
        <?php echo CHtml::link("Комментарии ({$data->commentCount})",$data->url.'#comments'); ?> |

        Последнее обновление <?php echo EDate::timeAgo(date('d.m.Y H:i:s',$data->update_time)); ?>

        <?php if((int)$_GET['id'] && !Yii::app()->user->isGuest): ?>
            <span style="float: right;">
                <?php echo $this->renderPartial('_rating', array('data'=>$data)); ?>
            </span>
        <?php endif; ?>

    </div>
    
</div>
-->

<div id="post">
    <div class="lefttd1">
        <div class="lefttd2">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" height="10" />
        </div>
    </div>
    <div class="pbox">
        <!-- post block -->
        <div class="p">
            <?php if(Yii::app()->user->checkAccess(User::ROLE_MODER)): ?>
                <span class="status_<?php echo $data->status; ?>" style="float: right;"><?php echo Lookup::item("PostStatus",$data->status); ?></span>
            <?php endif; ?>
            <h2>
                <?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
            </h2>
            <div class="catsmall">
                <?php echo implode(', ', $data->tagLinks); ?>
            </div>
            <p>
                <?php echo (int)$_GET['id'] ? $data->content : $data->short_content; ?>
            </p>
            <div class="morebut">
                <a href=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/morepic.gif" width="148" height="28" alt="" /></a>
            </div>
            <div class="clear"></div>
        </div>
        <!-- post block end -->
    </div>
    <div class="lefttd3">
        <div class="lefttd4">
            <div class="podpost">
                <table width="100%">
                <tr>
                    <td valign="top" align="left">
                        <span class="d"><?php echo Yii::app()->getDateFormatter()->format("d MMMM yyyy в HH:mm", $data->create_time); ?></span>
                    </td>
                    <td valign="top" align="center">
                        <span class="av">Автор: <?php echo CHtml::link($data->user->username, array('user/view','id'=>$data->user->id)); ?></span>
                    </td>
                    <td valign="top" align="right">
                        <span class="co"><?php echo CHtml::link("Комментарии ({$data->commentCount})",$data->url.'#comments'); ?></span>
                    </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>