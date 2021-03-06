<div style="padding:20px 20px 20px 20px; font-size:14px;">
<?php
/**
*
* Layout for the shopping cart, look in mailshopper for more details
*
* @package	VirtueMart
* @subpackage Cart
* @author Max Milbers
*
* @link http://www.virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
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
$link = JURI::root().'index.php?option=com_virtuemart';

echo '<p>';
//$link='<b>'.JHTML::_('link', JURI::root().$link, $this->vendor->vendor_name).'</b> ';

//	echo JText::_('COM_VIRTUEMART_MAIL_VENDOR_TITLE').$this->vendor->vendor_name.'<br/>';
/* GENERAL FOOTER FOR ALL MAILS */
	echo JText::_('COM_VIRTUEMART_MAIL_FOOTER' ) . '<br /><a href="'.$link.'">'.$this->vendor->vendor_name.'</a>';
        echo '</p>';
	//echo $this->vendor->vendor_name .'<br />'.$this->vendor->vendor_phone .' '.$this->vendor->vendor_store_name .'<br /> '.$this->vendor->vendor_store_desc.'<br />';
?>  

<p><?php echo JText::sprintf('COM_VIRTUEMART_MAIL_FOOTWELCOM') ?></p>
  
  <p style="margin:20px 0;">КС &nbsp;&nbsp;&nbsp;- +38 (097) 665-94-33<br />
    Life &nbsp;&nbsp;- +38 (093) 602-67-33<br />
    МТС - +38 (066) 920-67-33
</p>
 
<?php if ($this->vendor->vendor_letter_footer == 1) { ?>

<div id="vmdoc-footer" class="vmdoc-footer" style="font-size: <?php echo $this->vendor->vendor_letter_footer_font_size; ?>pt;">
<?php echo $this->replaceVendorFields($this->vendor->vendor_letter_footer_html, $this->vendor); ?>
</div>

<?php } // END if footer ?>
</div>
