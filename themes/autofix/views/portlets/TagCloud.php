<div id="tags">
    <div class="s1">
        <div class="s2">
            <span class="s_title">Теги</span>
        </div>
    </div>
    <div class="s">
        <div class="s2b">
            <div id="sidebar_tags">
                <?php
                foreach($model as $tag=>$weight)
                {
                    $link=CHtml::link(CHtml::encode($tag), array('post/index','tag'=>$tag));
                    echo CHtml::tag('span', array(
                        //'class'=>'tag',
                        'style'=>"font-size:{$weight}pt",
                    ), $link)."\n";
                }
                ?>
            </div>
        </div>
    </div><!-- s s2b -->
    <div class="s3">
        <div class="s4">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/spacer.gif" height="7" />
        </div>
    </div>
</div>