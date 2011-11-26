<!--
<?php foreach($data as $comment): ?>

    <div class="comment" id="c<?php echo $comment->id; ?>" style="margin-left: <?php echo $comment->level > 2 ? $comment->level * 10 : 0; ?>px">

        <?php echo CHtml::link("#{$comment->id}", array('post/view', 'id'=>$comment->post_id, '#'=>'c' . $comment->id), array(
            'class'=>'cid',
            'title'=>'Permalink to this comment',
        )); ?>

        <div class="author">
            <?php echo $comment->user->username; ?> says:
        </div>

        <div class="time">
            <?php echo Yii::app()->getDateFormatter()->format("d MMMM yyyy, HH:mm", $comment->create_time); ?>
        </div>

        <div class="content">
            <?php echo nl2br(CHtml::encode($comment->content)); ?>
        </div>

    </div>

<?php endforeach; ?>
-->

<?php $level=0; ?>
<?php foreach($data as $n=>$comment): ?>
    <?php if($comment->level==$level): ?>
        <?php echo CHtml::closeTag('li')."\n"; ?>
    <?php elseif($comment->level>$level): ?>
        <?php echo CHtml::openTag('ul')."\n"; ?>
    <?php else: ?>
        <?php echo CHtml::closeTag('li')."\n"; ?>

        <?php for($i=$level-$comment->level;$i;$i--): ?>
            <?php echo CHtml::closeTag('ul')."\n"; ?>
            <?php echo CHtml::closeTag('li')."\n"; ?>
        <?php endfor; ?>
    <?php endif; ?>

    <?php echo CHtml::openTag('li'); ?>
        <div class="comment">
            <?php echo CHtml::link("#{$comment->id}", array('post/view', 'id'=>$comment->post_id, '#'=>'c' . $comment->id), array(
                'class'=>'cid',
                'title'=>'Permalink to this comment',
            )); ?>

            <div class="author">
                <?php echo $comment->user->username; ?> says:
            </div>

            <div class="time">
                <?php echo Yii::app()->getDateFormatter()->format("d MMMM yyyy, HH:mm", $comment->create_time); ?>
            </div>

            <div class="content">
                <?php echo nl2br(CHtml::encode($comment->content)); ?>
            </div>
        </div>
    <?php $level=$comment->level; ?>
<?php endforeach; ?>

<?php for($i=$level;$i;$i--): ?>
    <?php echo CHtml::closeTag('li')."\n"; ?>
    <?php echo CHtml::closeTag('ul')."\n"; ?>
<?php endfor; ?>