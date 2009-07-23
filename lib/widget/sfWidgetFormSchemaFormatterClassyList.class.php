<?php

class sfWidgetFormSchemaFormatterClassyList extends sfWidgetFormSchemaFormatterNamed
{
  protected
    $rowFormat       = "<li class=\"%name%_container\">\n  %error%%label%\n  %field%%help%\n%hidden_fields%</li>\n",
    $errorRowFormat  = "<li>\n%errors%</li>\n",
    $helpFormat      = '<br />%help%',
    $decoratorFormat = "<ul>\n  %content%</ul>";

}
