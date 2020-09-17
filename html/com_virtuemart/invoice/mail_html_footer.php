<div style="padding:20px 20px 20px 20px; font-size:14px;">
<?php
/**
*
* Layout for the shopping cart, look in mailshopper for more details
*
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
/* TODO Chnage the footer place in helper or assets ???*/
if (empty($this->vendor)) {
		$vendorModel = VmModel::getModel('vendor');
		$this->vendor = $vendorModel->getVendor();
}

//$link = shopFunctionsF::getRootRoutedUrl('index.php?option=com_virtuemart');
$link = JURI::root().'';

echo '<p>';
//$link='<b>'.JHTML::_('link', JURI::root().$link, $this->vendor->vendor_name).'</b> ';

//	echo JText::_('COM_VIRTUEMART_MAIL_VENDOR_TITLE').$this->vendor->vendor_name.'<br/>';
/* GENERAL FOOTER FOR ALL MAILS */
	echo JText::_('COM_VIRTUEMART_MAIL_FOOTER' );
        echo '</p>';
	
	echo JText::_('COM_VIRTUEMART_MAIL_FOOTER2' ) .'<a href="'.$link.'">'.$this->vendor->vendor_store_name.'</a>';
?>  



  
  <p style="color: #333333; font-size: 14px;margin: 0;padding:20px 0 10px 0;">Тел.:&nbsp;+38 <span style="color: #49892D; font-size: 1.3em; font-weight: bold; text-shadow: 1px 2px 1px #656565;">(067)&nbsp;613 45 44</span></p>
 


 

</div>
