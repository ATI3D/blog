<?php

class TagCloud extends Portlet
{
	public $title='Теги';
	public $maxTags=20;

	protected function getTag()
	{
		return Tag::model()->findTagWeights($this->maxTags);
	}

	protected function renderContent()
	{
		$this->render('TagCloud',
			array('model'=>$this->getTag())
		);
	}
}