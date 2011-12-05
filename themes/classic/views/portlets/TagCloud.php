<?php
foreach($model as $tag=>$weight)
{
    $link=CHtml::link(CHtml::encode($tag), array('post/index','tag'=>$tag));
    echo CHtml::tag('span', array(
        'class'=>'tag',
        'style'=>"font-size:{$weight}pt",
    ), $link)."\n";
}
?>