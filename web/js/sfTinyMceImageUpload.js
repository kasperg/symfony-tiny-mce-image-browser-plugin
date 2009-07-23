function sfTinyMceImageBrowser_select(url)
{
  
  var win = tinyMCEPopup.getWindowArg("window");

  // insert information now
  win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = url;

  // are we an image browser
  if (typeof(win.ImageDialog) != "undefined") {
    // we are, so update image dimensions...
    if (win.ImageDialog.getImageData)
      win.ImageDialog.getImageData();

    // ... and preview if necessary
    if (win.ImageDialog.showPreviewImage)
      win.ImageDialog.showPreviewImage(URL);
  }

  // close popup window
  tinyMCEPopup.close();
}
  
function sfTinyMceImageBrowser_browser (field_name, url, type, win)
{
  tinyMCE.activeEditor.windowManager.open({
    file : '/sfTinyMceImageBrowser/create',
    title : 'Image Upload',
    width : 360,
    height : 640,
    resizable : "no",
    inline : "yes",
    close_previous : "no"
  }, {
        window : win,
        input : field_name
  });
  return false;
}