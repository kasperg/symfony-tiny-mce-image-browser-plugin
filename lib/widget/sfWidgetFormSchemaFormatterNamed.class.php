<?php

class sfWidgetFormSchemaFormatterNamed extends sfWidgetFormSchemaFormatter
{

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    $name = substr($field, strpos($field, 'id="') + strlen('id="'));
    $name = substr($name, 0, strpos($name, '"'));
    
    return strtr($this->getRowFormat(), array(
      '%name%'          => $name,
      '%label%'         => $label,
      '%field%'         => $field,
      '%error%'         => $this->formatErrorsForRow($errors),
      '%help%'          => $this->formatHelp($help),
      '%hidden_fields%' => is_null($hiddenFields) ? '%hidden_fields%' : $hiddenFields,
    ));
  }
}
