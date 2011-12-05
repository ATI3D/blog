<?php

class RecentComments extends Portlet
{
	//public $title='Прямой Эфир';
	public $maxComments=10;

	public function getRecentComments()
	{
		return Comment::model()->published()->findAll(array('limit'=>$this->maxComments));
	}

	protected function renderContent()
	{
		$this->render('recentComments',array(
			'comments'=>$this->getRecentComments(),
		));
	}
}