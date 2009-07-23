<?php

class sfTinyMceImageBrowserActions extends sfActions
{

	public function exexcuteShow(sfWebRequest $request)
  {
  	$this->setLayout(FALSE);
    sfConfig::set('sf_web_debug', false);

    $request->getParameter('width');
  	$request->getParameter('height');
  }
  
	public function executeCreate(sfWebRequest $request)
	{
		$this->setLayout(FALSE);
		sfConfig::set('sf_web_debug', false);
		
		sfLoader::loadHelpers('I18N');
		$this->getResponse()->setTitle(__('Image Upload'));
    $this->getResponse()->addStyleSheet('/sfTinyMceImageBrowser/css/sfTinyMceImageBrowser.css', 'last');
    $this->getResponse()->addJavascript('/lib/tiny_mce/tiny_mce_popup.js');
    $this->getResponse()->addJavaScript('/sfTinyMceImageBrowser/js/sfTinyMceImageBrowser.js');
		
    $this->form = new sfTinyMceImageForm(new sfTinyMceImage());

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    	
      if ($this->form->isValid())
	    {
	      if ($this->form->save())
	      {
	      	$this->redirect('sfTinyMceImageBrowser/create');
	      }
	    }
    }
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		
	}
	
}