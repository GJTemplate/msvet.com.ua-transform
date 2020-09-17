<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


echo JText::sprintf('COM_VIRTUEMART_CART_NOTIFY_MAIL_RAW', $this->productName,$this->url);


if(!empty($this->orderDetails['details']['BT']->customer_note)) {
	echo "\n" . JText::sprintf('COM_VIRTUEMART_CART_MAIL_VENDOR_SHOPPER_QUESTION', $this->orderDetails['details']['BT']->customer_note);
}
echo "\n";
