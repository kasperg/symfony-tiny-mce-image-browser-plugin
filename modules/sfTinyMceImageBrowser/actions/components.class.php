<?php

class sfTinyMceImageBrowserComponents extends sfComponents
{
	
	public function executeList()
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(sfTinyMceImagePeer::CREATED_AT);
		$this->images = sfTinyMceImagePeer::doSelect($c);
	}
	
}