<?php
/*
# ------------------------------------------------------------------------
# Vina Product Carousel for VirtueMart for Joomla 3
# ------------------------------------------------------------------------
# Copyright(C) 2014 www.VinaGecko.com. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: VinaGecko.com
# Websites: http://vinagecko.com
# Forum: http://vinagecko.com/forum/
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.modal');
$doc = JFactory::getDocument();
$doc->addScript('modules/' . $module->module . '/assets/js/owl.carousel.js', 'text/javascript');
$doc->addScript('modules/' . $module->module . '/assets/js/jquery.countdown.js', 'text/javascript');
$doc->addStyleSheet('modules/' . $module->module . '/assets/css/owl.carousel.css');
$doc->addStyleSheet('modules/' . $module->module . '/assets/css/owl.theme.css');
$doc->addStyleSheet('modules/' . $module->module . '/assets/css/custom.css');

// Timthumb Class Path
$timthumb = 'modules/'.$module->module.'/libs/timthumb.php?a=c&amp;q=99&amp;z=0&amp;w='.$imageWidth.'&amp;h='.$imageHeight;
$timthumb = JURI::base() . $timthumb;

$session = JFactory::getSession();
$timer_date	 	= $session->get('timer_date');
$cvtimer_date	= date("Y/m/d", strtotime($timer_date)); 

// Get New Products
$db     = JFactory::getDBO();
$query  = "SELECT virtuemart_product_id FROM #__virtuemart_products ORDER BY virtuemart_product_id DESC LIMIT 0, 10";
$db->setQuery($query);
$newIds = $db->loadColumn();
?>


<!--style type="text/css" scoped>
#vina-carousel-virtuemart<?php echo $module->id; ?> {
	width: <?php echo $moduleWidth; ?>;
	height: <?php echo $moduleHeight; ?>;
	margin: <?php echo $moduleMargin; ?>;
	padding: <?php echo $modulePadding; ?>;
	<?php echo ($bgImage != '') ? "background: url({$bgImage}) repeat scroll 0 0;" : ''; ?>
	<?php echo ($isBgColor) ? "background-color: {$bgColor};" : '';?>
	/*overflow: hidden;*/
}
#vina-carousel-virtuemart<?php echo $module->id; ?> .item {
	color: <?php echo $itemTextColor; ?>;
	padding: <?php echo $itemPadding; ?>;
	margin: <?php echo $itemMargin; ?>;
}
#vina-carousel-virtuemart<?php echo $module->id; ?> .ma-box-content {
	<?php echo ($isItemBgColor) ? "background-color: {$itemBgColor};" : ""; ?>;	
}
#vina-carousel-virtuemart<?php echo $module->id; ?> .item a {
	color: <?php echo $itemLinkColor; ?>;
}

</style-->
<?php 
	$ratingModel = VmModel::getModel('ratings');
	$ItemidStr = '';
	$Itemid = shopFunctionsF::getLastVisitedItemId();
	if(!empty($Itemid)){
		$ItemidStr = '&Itemid='.$Itemid;
	}
?>
<div id="vina-carousel-virtuemart<?php echo $module->id; ?>" class="vina-carousel-virtuemart owl-carousel">
	<?php 
		foreach($products as $key => $product) :
			$image  = $product->images[0];
			$pImage = (!empty($image)) ? JURI::base() . $image->file_url : '';
			$pImage = (!empty($pImage) && $resizeImage) ? $timthumb . '&amp;src=' . $pImage : $pImage;				

			if(!is_null($product->images[1])) {
				$image_second = $product->images[1];
				$pImage_second = (!empty($image_second)) ? JURI::base() . $image_second->file_url : $pImage;
				$pImage_second = (!empty($pImage_second) && $resizeImage) ? $timthumb . '&amp;src=' . $pImage_second : $pImage_second;	
			}

			$pLink  = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id);
			$pName  = $product->product_name;
			$rating = shopFunctionsF::renderVmSubLayout('rating', array('showRating' => $productRating, 'product' => $product));
			$sDesc  = $product->product_s_desc;
			$pDesc  = (!empty($sDesc)) ? shopFunctionsF::limitStringByWord($sDesc, 60, ' ...') : '';
			$detail = JHTML::link($pLink, vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS'), array('title' => $pName, 'class' => 'product-details'));
			$stock  = $productModel->getStockIndicator($product);
			$sLevel = $stock->stock_level;
			$sTip   = $stock->stock_tip;
			$handle = shopFunctionsF::renderVmSubLayout('stockhandle', array('product' => $product));
			$pPrice = shopFunctionsF::renderVmSubLayout('prices', array('product' => $product, 'currency' => $currency));
			$sPrice = $currency->createPriceDiv('salesPrice', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
			$dPrice = $currency->createPriceDiv('salesPriceWithDiscount', '', $product->prices, FALSE, FALSE, 1.0, TRUE);
			
			// Show Label Sale Or New
			$isSaleLabel = (!empty($product->prices['discountAmount'])) ? 1 : 0;
			
			$pid = $product->virtuemart_product_id;
			$isNewLabel = in_array($pid, $newIds);
	?>
	<div class="item vinavm-product vm-col round-corners">
		<div class="ma-box-content">
			<!-- Check Product Label -->
			<?php //if($isSaleLabel != 0) : ?>
				<!--div class="label-pro sale"><?php //echo JTEXT::_('VINA_VIRTUEMART_SALES'); ?></div>
			<?php //endif; ?>
			<?php //if($isNewLabel && $isSaleLabel != 0) : ?>
			<div class="label-pro sale-new"><?php //echo JTEXT::_('VINA_VIRTUEMART_NEW'); ?></div>
			<?php //endif; ?>
			<?php //if($isNewLabel && $isSaleLabel == 0) : ?>
			<div class="label-pro new"><?php //echo JTEXT::_('VINA_VIRTUEMART_NEW'); ?></div-->
			<?php //endif; ?>
			<!-- Image Block -->
            
                	<div class="bonus_product_wrap">
                		<?php 
						if ($product->new == 1) {
							echo '<div class="ribbon-new_cat" title="Новинка"></div>';
						}
						if ($product->hit == 1) {
							echo '<div class="ribbon-hot_cat" title="Самый популярный товар"></div>';
						}
						if ($product->action == 1) {
							echo '<div class="ribbon-special_cat" title="У нас акция!"></div>';
						} 
						?>  
        			</div> 
                                
			<?php if($productImage && !empty($pImage)) : ?>
			<div class="vm-product-media-container image-block">
				<a href="<?php echo $pLink; ?>" title="<?php echo $pName; ?>">
					<?php if(!empty($product->images[1])) :?>
						<div class="pro-image first-image">
							<img class="browseProductImage" src="<?php echo $pImage; ?>" alt="<?php echo $pName; ?>" title="<?php echo $pName; ?>" />
						</div>
						<div class="pro-image second-image">
							<img class="browseProductImage" src="<?php echo $pImage_second; ?>" alt="<?php echo $pName; ?>" title="<?php echo $pName; ?>" />				
						</div>			
					<?php else: ?>
						<div class="pro-image">
							<img class="browseProductImage" src="<?php echo $pImage; ?>" alt="<?php echo $pName; ?>" title="<?php echo $pName; ?>" />
						</div>
					<?php endif;?>
				</a>
			</div>
			<div class="clear"></div>
			<?php endif; ?>
			
			<!-- Text Block -->
				
				<!-- Product Price -->
				<?php if($productPrice) : ?>
				<div class="price-box">
					<?php if($isSaleLabel!= 0) : ?>
						<div class="sale-price">
						<?php echo $pPrice; ?>
						</div>
					<?php else : ?>
						<div class="regular-price">
						<?php echo $sPrice; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="clear"></div>
				<?php endif; ?>
                
			<div class="text-block">
				<!-- Product Name -->
				<?php if($productName) : ?>			
				<h3 class="product-title"><a href="<?php echo $pLink; ?>" title="<?php echo $pName; ?>"><?php echo $product->product_name; ?></a></h3>
				<?php endif; ?>
				
			<!-- Product Rating -->
				<?php if ($productRating) { ?>
					<div class="vm-product-rating-container">
					<?php
						$maxrating = VmConfig::get('vm_maximum_rating_scale',5);
						$rating = $ratingModel->getRatingByProduct($product->virtuemart_product_id);
						$reviews = $ratingModel->getReviewsByProduct($product->virtuemart_product_id);
						if(empty($rating->rating)) { ?>						
							<div class="ratingbox dummy" title="<?php echo vmText::_('COM_VIRTUEMART_UNRATED'); ?>" >
							</div>
						<?php } else {						
							$ratingwidth = $rating->rating * 14; ?>
							<div title=" <?php echo (vmText::_("COM_VIRTUEMART_RATING_TITLE") . round($rating->rating) . '/' . $maxrating) ?>" class="ratingbox" >
							  <div class="stars-orange" style="width:<?php echo $ratingwidth.'px'; ?>"></div>
							</div>
						<?php } ?> 
						<?php if(!empty($reviews)) {					
							$count_review = 0;
							foreach($reviews as $k=>$review) {
								$count_review ++;
							}										
						?>
							<span class="amount">
								<a href="<?php echo $pLink; ?>" target="_blank" ><?php echo $count_review.' '.JText::_('VINA_VIRTUEMART_REVIEW');?></a>
							</span>
						<?php } ?>
					</div>
				<?php } ?>
				
				<!-- Product Stock -->
				<?php if($productStock) : ?>
				<div class="product-stock">
					<span class="vmicon vm2-<?php echo $sLevel; ?>" title="<?php echo $sTip; ?>"></span>
					<?php echo $handle; ?>
				</div>
				<?php endif; ?>					
				
				<!-- Product Description -->
				<?php if($productDesc && !empty($pDesc)) : ?>
				<div class="product-description"><?php echo $pDesc; ?></div>
				<?php endif; ?>
				
			
				
				<?php if($addtocart || $viewDetails): ?>
				<div class="item-box-hover">	
					<!-- Add to Cart Button-->
					<?php if($addtocart ) : ?>
					<div class="add-to-links">
						<!-- Product Add To Cart -->
						<?php if($addtocart) : ?>
							<div class="addtocart"><?php modVinaCarouselVirtueMartHelper::addtocart($product); ?></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					
					<!-- View Details Button -->
					<?php if($viewDetails) : ?>					
						<div class="ma-links">
							<ul class="add-to-links">
					
								<!-- Add Wishlist Button -->
								<?php if(is_dir(JPATH_BASE . "/components/com_wishlist/")) :
									$app = JFactory::getApplication();
								?>
								<li class="link-wishlist">
									<div class="btn-wishlist">
										<?php require(JPATH_BASE . "/templates/".$app->getTemplate()."/html/wishlist.php"); ?>
									</div>
								</li>
								<?php else: ?>		
									<li>
										<a href="<?php echo $pLink; ?>#vina-tab" title="<?php echo JTEXT::_('VINA_VIRTUEMART_REVIEW'); ?>" class="product-review icon-star jutooltip"><span><?php echo JText::_('VINA_VIRTUEMART_REVIEW');?></span></a>
									</li>
								<?php endif;?>
								
								<li>
									<a href="<?php echo $pLink; ?>" title="<?php echo JTEXT::_('VINA_PRODUCT_DETAILS'); ?>" class="product-details icon-eye-open jutooltip">
										<span><?php echo JTEXT::_('VINA_PRODUCT_DETAILS'); ?></span>
									</a>
								</li>
							</ul>	
						</div>
						
					<?php endif; ?>
				</div>
				<?php endif; ?>
				
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
<?php
	
 $arr = explode(" ",$params->get('moduleclass_sfx')); 

//echo '<pre>'; print_r ( $timer_date ); echo '</pre>'.__FILE__.' in line:  '.__LINE__ ;

if( in_array('timer_countdown',$arr) && $timer_date) :?>
	
<div class="box-timer clearfix">
	<div class="timer-grid" data-countdown="<?php echo $cvtimer_date;?>"></div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('[data-countdown]').each(function() {
		var $this = $(this), 
			finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
			$this.html(event.strftime('<div class="day span6">До конца акции осталось: <span class="number">%D</span>дней</div> <div class="span5 wrap_time"><div class="hour"><span class="number">%H </span>часов</div><div class="min"><span class="number"> %M</span> минут</div> <div class="sec"><span class="number">%S </span>секунд</div></div>'));
		});
	});
});
</script>
<?php endif;?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$("#vina-carousel-virtuemart<?php echo $module->id; ?>").owlCarousel({
		items : 			<?php echo $itemsVisible; ?>,
        itemsDesktop : 		<?php echo $itemsDesktop; ?>,
        itemsDesktopSmall : <?php echo $itemsDesktopSmall; ?>,
        itemsTablet : 		<?php echo $itemsTablet; ?>,
        itemsTabletSmall : 	<?php echo $itemsTabletSmall; ?>,
        itemsMobile : 		<?php echo $itemsMobile; ?>,
        singleItem : 		<?php echo ($singleItem) ? 'true' : 'false'; ?>,
        itemsScaleUp : 		<?php echo ($itemsScaleUp) ? 'true' : 'false'; ?>,

        slideSpeed : 		<?php echo $slideSpeed; ?>,
        paginationSpeed : 	<?php echo $paginationSpeed; ?>,
        rewindSpeed : 		<?php echo $rewindSpeed; ?>,

        autoPlay : 		<?php echo $autoPlay; ?>,
        stopOnHover : 	<?php echo ($stopOnHover) ? 'true' : 'false'; ?>,

        navigation : 	<?php echo ($navigation) ? 'true' : 'false'; ?>,
        rewindNav : 	<?php echo ($rewindNav) ? 'true' : 'false'; ?>,
        scrollPerPage : <?php echo ($scrollPerPage) ? 'true' : 'false'; ?>,

        pagination : 		<?php echo ($pagination) ? 'true' : 'false'; ?>,
        paginationNumbers : <?php echo ($paginationNumbers) ? 'true' : 'false'; ?>,

        responsive : 	<?php echo ($responsive) ? 'true' : 'false'; ?>,
        autoHeight : 	<?php echo ($autoHeight) ? 'true' : 'false'; ?>,
        mouseDrag : 	<?php echo ($mouseDrag) ? 'true' : 'false'; ?>,
        touchDrag : 	<?php echo ($touchDrag) ? 'true' : 'false'; ?>,
	});
	
}); 
</script>