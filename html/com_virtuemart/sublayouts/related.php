<?php defined('_JEXEC') or die('Restricted access');

$related = $viewData['related'];
$customfield = $viewData['customfield'];
$thumb = $viewData['thumb'];


//juri::root() For whatever reason, we used this here, maybe it was for the mails
echo '<div class="related-product-image">' . JHtml::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $related->virtuemart_product_id . '&virtuemart_category_id=' . $related->virtuemart_category_id), $thumb, array('title' => $related->product_name,'target'=>'_blank')) . '</div>';

echo '<h4 class="related-product-h">'.$related->product_name.'</h4>';


//echo JHtml::link (JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $related->virtuemart_product_id . '&virtuemart_category_id=' . $related->virtuemart_category_id),$related->product_name, array('title' => $related->product_name,'target'=>'_blank'));

if($customfield->wPrice){
	$currency = calculationHelper::getInstance()->_currencyDisplay;
	echo $currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $related->prices);
}
if($customfield->wDescr){
	echo '<p class="product_s_desc">'.$related->product_s_desc.'</p>';
}