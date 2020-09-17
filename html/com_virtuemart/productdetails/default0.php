<?php
defined('_JEXEC') or die('Restricted access');

if (empty($this->product)) {
	echo vmText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');
	echo '<br /><br />  ' . $this->continue_link_html;
	return;
}

echo shopFunctionsF::renderVmSubLayout('askrecomjs',array('product'=>$this->product));

if(vRequest::getInt('print',false)){
?>
<body onLoad="javascript:print();">
<?php }

// addon for joomla modal Box
JHtml::_('behavior.modal'); 

$MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';

$boxFuncReco = '';
$boxFuncAsk = '';
if(VmConfig::get('usefancy',0)){
	vmJsApi::js( 'fancybox/jquery.fancybox-1.3.4.pack');
	vmJsApi::css('jquery.fancybox-1.3.4');
	if(VmConfig::get('show_emailfriend',0)){
		$boxReco = "jQuery.fancybox({
				href: '" . $MailLink . "',
				type: 'iframe',
				height: '550'
			});";
	}
	if(VmConfig::get('ask_question', 0)){
		$boxAsk = "jQuery.fancybox({
				href: '" . $this->askquestion_url . "',
				type: 'iframe',
				height: '550'
			});";
	}

} else {
	vmJsApi::js( 'facebox' );
	vmJsApi::css( 'facebox' );
	if(VmConfig::get('show_emailfriend',0)){
		$boxReco = "jQuery.facebox({
				iframe: '" . $MailLink . "',
				rev: 'iframe|550|550'
			});";
	}
	if(VmConfig::get('ask_question', 0)){
		$boxAsk = "jQuery.facebox({
				iframe: '" . $this->askquestion_url . "',
				rev: 'iframe|550|550'
			});";
	}
}
if(VmConfig::get('show_emailfriend',0) ){
	$boxFuncReco = "jQuery('a.recommened-to-friend').click( function(){
					".$boxReco."
			return false ;
		});";
}

if(!empty($boxFuncAsk) or !empty($boxFuncReco)){
	$document = JFactory::getDocument();
	$document->addScriptDeclaration("
//<![CDATA[
	jQuery(document).ready(function($) {
		".$boxFuncReco."
		".$boxFuncAsk."
	/*	$('.additional-images a').mouseover(function() {
			var himg = this.href ;
			var extension=himg.substring(himg.lastIndexOf('.')+1);
			if (extension =='png' || extension =='jpg' || extension =='gif') {
				$('.main-image img').attr('src',himg );
			}
			console.log(extension)
		});*/
	});
//]]>
");
}
// This is the rows for the customfields, as long you have only one product, just increase it by one,
// if you have more than one product, reset it for every product
$this->row = 0;
?>

<div class="productdetails-view productdetails">
<div><?php echo $this->edit_link; ?></div>

	<div class="row-fluid">


		<div class="span6">
			<?php echo $this->loadTemplate('images'); ?>
		</div>

		<div id="b-area" class="span6">
			<div class="spacer-buy-area">

				<?php
				// PDF - Print - Email Icon
				if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_button_enable')) {
				?>
				<div class="icons hidden-phone">
					<?php
					//$link = (JVM_VERSION===1) ? 'index2.php' : 'index.php';
					$link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;
					$MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';

					echo "<span class=\"vm-print-button\">".$this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon')."</span>";
					echo "<span class=\"vm-email-button\">".$this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend')."</span>";
					?>
					<div class="clear"></div>
				</div>
				<?php } // PDF - Print - Email Icon END
				?>

				<?php // Product Title   ?>
				<h1><?php echo $this->product->product_name ?> </h1>
				<?php // Product Title END   ?>
                            
                <div class="partnomer">
                    <span class="product_sku_label">
                    <?php echo JText::_('COM_VIRTUEMART_PRODUCT_PARTNOMER'); ?></span>
                    <span class="product_sku"><?php echo $this->product->product_sku  //Артикул ?></span>
                </div>
                
				<?php // afterDisplayTitle Event
				echo $this->product->event->afterDisplayTitle ?>

				<?php

				if (!empty($this->product->customfieldsSorted['ontop'])) {
					$this->position = 'ontop';
					echo $this->loadTemplate('customfields');
				} // Product Custom ontop end
				?>

			<?php
			if ($this->showRating) {
				$maxrating = VmConfig::get('vm_maximum_rating_scale', 5);

				if (empty($this->rating)) {
					?>
						<span class="vote"><?php echo vmText::_('COM_VIRTUEMART_RATING') . ' ' . vmText::_('COM_VIRTUEMART_UNRATED') ?></span>
					<?php
				} else {
					$ratingwidth = $this->rating->rating * 24; //I don't use round as percetntage with works perfect, as for me
					?>
					<span class="vote">
						<?php echo vmText::_('COM_VIRTUEMART_RATING') . ' ' . round($this->rating->rating) . '/' . $maxrating; ?> <span title=" <?php echo (vmText::_("COM_VIRTUEMART_RATING_TITLE") . round($this->rating->rating) . '/' . $maxrating) ?>" class="ratingbox" style="display:inline-block;">
						<span class="stars-orange" style="width:<?php echo $ratingwidth.'px'; ?>">
						</span>
						</span>
					</span>
				<?php
				}
			}
			?>



			<?php
			// TODO in Multi-Vendor not needed at the moment and just would lead to confusion
			/* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
			$text = vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
			echo '<span class="bold">'. vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
			*/

			// Product Short Description
			if (!empty($this->product->product_s_desc)) {
			?>
				<div class="product-short-description"><span class="module-arrow"></span>
					<?php
					/** @todo Test if content plugins modify the product description */
					echo nl2br($this->product->product_s_desc);
					?>
				</div>
			<?php
			} // Product Short Description END
			?>
            
            

			<?php
			// Manufacturer of the Product
			if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
				echo $this->loadTemplate('manufacturer');
			}
			?>

			<?php

			if (is_array($this->productDisplayShipments)) {
				foreach ($this->productDisplayShipments as $productDisplayShipment) {
					echo $productDisplayShipment . '<br />';
				}
			}
			if (is_array($this->productDisplayPayments)) {
				foreach ($this->productDisplayPayments as $productDisplayPayment) {
					echo $productDisplayPayment . '<br />';
			}
			}
			// Product Price
			// the test is done in show_prices
			//if ($this->show_prices and (empty($this->product->images[0]) or $this->product->images[0]->file_is_downloadable == 0)) {
			echo $this->loadTemplate('showprices');
			//}
			?>

			<?php
			// Add To Cart Button
			// 			if (!empty($this->product->prices) and !empty($this->product->images[0]) and $this->product->images[0]->file_is_downloadable==0 ) {
			if (!VmConfig::get('use_as_catalog', 0) and !empty($this->product->prices['salesPrice'])) {
			echo $this->loadTemplate('addtocart');
			}  // Add To Cart Button END
			?>

			<?php
			// Availability
			$stockhandle = VmConfig::get('stockhandle', 'none');
			$product_available_date = substr($this->product->product_available_date,0,10);
			$current_date = date("Y-m-d");
			if (($this->product->product_in_stock - $this->product->product_ordered) < 1) {
			if ($product_available_date != '0000-00-00' and $current_date < $product_available_date) {
			?>	<div class="availability">
			<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_AVAILABLE_DATE') .': '. JHtml::_('date', $this->product->product_available_date, vmText::_('DATE_FORMAT_LC4')); ?>
			</div>
			<?php
			} else if ($stockhandle == 'risetime' and VmConfig::get('rised_availability') and empty($this->product->product_availability)) {
			?>	<div class="availability">
			<?php echo (file_exists(JPATH_BASE . DS . VmConfig::get('assets_general_path') . 'images/availability/' . VmConfig::get('rised_availability'))) ? JHtml::image(JURI::root() . VmConfig::get('assets_general_path') . 'images/availability/' . VmConfig::get('rised_availability', '7d.gif'), VmConfig::get('rised_availability', '7d.gif'), array('class' => 'availability')) : vmText::_(VmConfig::get('rised_availability')); ?>
			</div>
			<?php
			} else if (!empty($this->product->product_availability)) {
			?>
			<div class="availability">
			<?php echo (file_exists(JPATH_BASE . DS . VmConfig::get('assets_general_path') . 'images/availability/' . $this->product->product_availability)) ? JHtml::image(JURI::root() . VmConfig::get('assets_general_path') . 'images/availability/' . $this->product->product_availability, $this->product->product_availability, array('class' => 'availability')) : vmText::_($this->product->product_availability); ?>
			</div>
			<?php
			}
			}
			else if ($product_available_date != '0000-00-00' and $current_date < $product_available_date) {
			?>	<div class="availability">
			<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_AVAILABLE_DATE') .': '. JHtml::_('date', $this->product->product_available_date, vmText::_('DATE_FORMAT_LC4')); ?>
			</div>
			<?php
			}
			?>
            
            
            
			<?php
                // Product Navigation
                if (VmConfig::get('product_navigation', 1)) {
                ?>
                    <?php // Back To Category Button
                                    if ($this->product->virtuemart_category_id) {
                                        $catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id);
                                        $categoryName = $this->product->category_name ;
                                    } else {
                                        $catURL =  JRoute::_('index.php?option=com_virtuemart');
                                        $categoryName = vmText::_('COM_VIRTUEMART_SHOP_HOME') ;
                                    }
                                ?>
                                <div class="back-to-category">
                                    <a href="<?php echo $catURL ?>" class="" title="<?php echo $categoryName ?>"><?php echo JText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO',$categoryName) ?></a>
                                </div>
                    
            <?php } 
                
                // Product Navigation END ?> 
                
                
			
            </div>
		</div>
		<div class="clear"></div>
	</div>


    




    <?php
    // Product Files
    // foreach ($this->product->images as $fkey => $file) {
    // Todo add downloadable files again
    // if( $file->filesize > 0.5) $filesize_display = ' ('. number_format($file->filesize, 2,',','.')." MB)";
    // else $filesize_display = ' ('. number_format($file->filesize*1024, 2,',','.')." KB)";

    /* Show pdf in a new Window, other file types will be offered as download */
    // $target = stristr($file->file_mimetype, "pdf") ? "_blank" : "_self";
    // $link = JRoute::_('index.php?view=productdetails&task=getfile&virtuemart_media_id='.$file->virtuemart_media_id.'&virtuemart_product_id='.$this->product->virtuemart_product_id);
    // echo JHTMl::_('link', $link, $file->file_title.$filesize_display, array('target' => $target));
    // }
	
    if (!empty($this->product->customfieldsRelatedProducts)) {
	echo $this->loadTemplate('relatedproducts');
    } // Product customfieldsRelatedProducts END

    if (!empty($this->product->customfieldsRelatedCategories)) {
	echo $this->loadTemplate('relatedcategories');
    } // Product customfieldsRelatedCategories END
    // Show child categories
    if (VmConfig::get('showCategory', 1)) {
	echo $this->loadTemplate('showcategory');
    }
    if (!empty($this->product->customfieldsSorted['onbot'])) {
    	$this->position='onbot';
    	echo $this->loadTemplate('customfields');
    } // Product Custom ontop end
    ?>




			<!-- модуль lending1 -->
            <?php 
            $pos = "lending1";
            $modules =& JModuleHelper::getModules($pos);
            foreach ($modules as $module){
            echo JModuleHelper::renderModule($module);
            }
            ?>
            <!-- END модуль lending1 -->   

 

<section class="tabs">
<input id="tab_1" type="radio" name="tab" checked="checked" />
<input id="tab_2" type="radio" name="tab" />
<input id="tab_3" type="radio" name="tab" />
<input id="tab_4" type="radio" name="tab" />
<input id="tab_5" type="radio" name="tab" />
 
	<label for="tab_1" id="tab_l1">
		<?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?> 
    </label><!--Заголовок 1 вкладки-->
	<label for="tab_2" id="tab_l2">Технические характеристики</label><!--Заголовок 2 вкладки-->
	<label for="tab_3" id="tab_l3">Отзывы</label><!--Заголовок 3 вкладки-->
    <label for="tab_4" id="tab_l4">Гарантии и доставка</label><!--Заголовок 4 вкладки-->
    <label for="tab_5" id="tab_l5">Экспертиза 'Мой свет'</label><!--Заголовок 5 вкладки-->
    
<div style="clear:both"></div>
<div class="tabs_cont">
<div id="tab_c1"><!--Содержание 1 вкладки-->
<div class="product_desc">

	<?php // event onContentBeforeDisplay
	echo $this->product->event->beforeDisplayContent; ?>

	<?php
	// Product Description
	if (!empty($this->product->product_desc)) {
	    ?>
        <div class="product-description">
			<?php echo $this->product->product_desc; ?>
        </div>

</div>   
</div>
 
<div id="tab_c2"><!--Содержание 2 вкладки-->
	<?php
    } 

	
    if (!empty($this->product->customfieldsSorted['normal'])) {
	$this->position = 'normal';
	echo $this->loadTemplate('customfields');
    } // Product custom_fields END
	
	
    // Product Packaging
    $product_packaging = '';
    if ($this->product->product_box) {
	?>
        <div class="product-box">
	    <?php
	        echo vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;
	    ?>
        </div>
    <?php } // Product Packaging END
    ?>

  
</div>
 
<div id="tab_c3"><!--Содержание 3 вкладки-->
	
	<?php
		echo $this->product->event->afterDisplayContent; 
		$comments = JPATH_ROOT . '/components/com_jcomments/jcomments.php';
		if (file_exists($comments)) {
		require_once($comments);
		echo JComments::showComments($this->product->virtuemart_product_id, 'com_virtuemart', $this->product->product_name);
		}
    ?>
    
    <?php
    echo $this->loadTemplate('reviews');
    
    ?>

</div>


<div id="tab_c4"><!--Содержание 4 вкладки-->
	Содержание 4 вкладки
</div>
<div id="tab_c5"><!--Содержание 5 вкладки-->
	Содержание 5 вкладки
</div>


</div>
</section>  



</div>
