<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
 echo "\n";
 echo JText::_('COM_VIRTUEMART_USER_FORM_BILLTO_LBL'). "\n";
echo sprintf("%'-64.64s",'');
 echo "\n";
  foreach ($this->userfields['fields'] as $field) {
		if(!empty($field['value'])){
			echo $field['title'].': '.$this->escape($field['value'])."\n";
		}
	}
 echo "\n";
echo JText::_('COM_VIRTUEMART_USER_FORM_SHIPTO_LBL'). "\n";
echo sprintf("%'-64.64s",'');
 echo "\n";


	 foreach ($this->shipmentfields['fields'] as $field) {
		if(!empty($field['value'])){
			echo $field['title'].': '.$this->escape($field['value'])."\n";
		}
	}

 echo "\n";