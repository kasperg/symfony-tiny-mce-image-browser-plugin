<?php

/**
 * sfTinyMceImage form.
 *
 * @package    sfTinyMceImageBrowserPlugin
 * @subpackage form
 * @author     Kasper Garnæs
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class sfTinyMceImageForm extends BasesfTinyMceImageForm
{
  public function configure()
  {
  }

  public function setup()
  {
  	parent::setup();
  	
  	sfApplicationConfiguration::getActive()->loadHelpers('I18N');
    
  	$this->setWidgets(array());
  	$this->setValidators(array());
  	
  	$this->setWidget('file', new sfWidgetFormInputFile());
  	$this->setValidator('file', new sfValidatorFile(array('mime_types' => 'web_images')));

  	if (sfConfig::get('app_sfTinyMceImageBrowserPlugin_allow_resize', true))
  	{
	  	$this->setWidget('width', new sfWidgetFormInput());
	  	$this->setValidator('width', new sfValidatorInteger(array('required' => false)));
	  	$this->setWidget('height', new sfWidgetFormInput());
	    $this->setValidator('height', new sfValidatorInteger(array('required' => false)));
  	}
    
    $this->setWidget('submit', new sfWidgetFormInput(array('type' => 'submit', 'label' => false), array('class' => 'submit-button', 'value' => __('Save changes'))));
    $this->setValidator('submit', new sfValidatorPass());

    $this->widgetSchema->setNameFormat('sf_tiny_mce_image[%s]');
    
  }
  
  protected function doSave($con = null)
  {
    $file = $this->getValue('file');
    $filename = sha1($file->getOriginalName().time()).$file->getExtension($file->getOriginalExtension());

    $filePath = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_sfTinyMceImageBrowserPlugin_directory', 'sfTinyMceImageBrowser').'/'.$filename;
    $file->save($filePath);
      
    if (sfConfig::get('app_sfTinyMceImageBrowserPlugin_allow_resize', true))
    {
      $width = ($this->getValue('width')) ? $this->getValue('width') : null;
      $height = ($this->getValue('height')) ? $this->getValue('height') : null;
      if ($width || $height)
      {
      	$fit = ($width && $height) ? 'outside' : 'inside';
        $wiImage = wiImage::load($filePath)->resize($width, $height, $fit);
        if ($width && $height)
        {
          $wiImage = $wiImage->crop(round(($wiImage->getWidth() - $width)/2), round(($wiImage->getHeight() - $height)/2), $width, $height);
        }
        $wiImage->saveToFile($filePath, substr($file->getExtension(), 1));
      }
    }
    
    return parent::doSave($con);
  }

  public function updateObject($values = null)
  {
    $object = parent::updateObject($values);
    
    //determine file name
    $file = $this->getValue('file');
    $object->setName($file->getOriginalName());
    
    //determine image dimensions
    $size = @getimagesize($object->getFile());
    if ($size)
    {
      $object->setWidth($size[0]);
      $object->setHeight($size[1]);    	
    }
    
    //remove configuration values from path
    $object->setFile(str_replace(sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_sfTinyMceImageBrowser_directory', 'sfTinyMceImageBrowser').'/', '', $object->getFile()));
    
    return $object;
  }
  
}
