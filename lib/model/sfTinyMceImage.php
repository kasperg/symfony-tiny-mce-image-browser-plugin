<?php

class sfTinyMceImage extends BasesfTinyMceImage
{

  public function getLocalPath()
  {
    return sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_sfTinyMceImageBrowser_directory', 'sfTinyMceImageBrowser').'/'.$this->getFile();
  }
  	
	public function getWebPath()
	{
		return str_replace(sfConfig::get('sf_web_dir'), '', $this->getLocalPath());		
	}
  
  public function getResizedWebPath($width = null, $height = null)
  {
  	$resizedPath = sfConfig::get('sf_upload_dir').'/'.sfConfig::get('app_sfTinyMceImageBrowser_directory', 'sfTinyMceImageBrowser').'/'.$this->getResizedFileName($width, $height);
  	
    if (!file_exists($resizedPath) && ($width || $height))
    {
      $wiImage = wiImage::load($this->getLocalPath())->resize($width, $height, 'outside');
      if ($width && $height)
      {
        $wiImage = $wiImage->crop(round(($wiImage->getWidth() - $width)/2), round(($wiImage->getHeight() - $height)/2), $width, $height);
      }
      $wiImage->saveToFile($resizedPath, 'jpeg', 80);
    }
    
    return str_replace(sfConfig::get('sf_web_dir'), '', $resizedPath);
  }

  protected function getResizedFileName($width = null, $height = null)
  {
  	$name = substr($this->getFile(), 0, strrpos($this->getFile(), '.'));
  	$extension = substr($this->getFile(), strrpos($this->getFile(), '.'));
  	
  	$name .= ($width) ? '_w'.$width : '';
    $name .= ($height) ? '_h'.$height : '';

    return $name.$extension;
  }
	
}
