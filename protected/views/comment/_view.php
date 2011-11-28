<?php if(!$data): ?>
    <h3>Комментариев нет</h3>
<?php else: ?>
    <h3>Комментарии:</h3>

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
            <div class="comment" style="background-color: <?php echo $comment->id == $_GET['pid'] ? '#F5F5F5' : ''; ?>">
                <?php echo CHtml::link("", array('post/view', 'id'=>$comment->post_id, '#'=>'c' . $comment->id), array(
                    'class'=>'cid',
                )); ?>

                <div class="author">
                    <?php echo $comment->user->username; ?>
                </div>

                <div class="time">
                    <?php echo Yii::app()->getDateFormatter()->format("d MMMM yyyy, HH:mm", $comment->create_time); ?>
                </div>

                <div class="answer">
                    <?php echo CHtml::link('Ответить', array('post/view','id'=>$_GET['id'], 'pid'=>$comment->id, '#'=>'comment-form')); ?>
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

<?php endif; ?>