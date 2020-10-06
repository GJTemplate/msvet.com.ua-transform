<?php
defined('_JEXEC') or die('Restricted access');

/*--- Микроразметка Open Graph для карточки товара ---*/
$doc = JFactory::getDocument();
$head = '<meta property="og:title" content="'.$this->product->product_name.'" />';
if (!empty($this->product->product_s_desc)) {
   $head .= '<meta property="og:description" content="'.htmlspecialchars(strip_tags($this->product->product_desc)).'" />';
   } elseif (!empty($this->product->product_desc)) { 
  $head .= '<meta property="og:description" content="'.htmlspecialchars(strip_tags($this->product->product_desc)).'"/>'; 
   } 
$head .= '<meta property="og:image" content="'.JURI::base().$this->product->images[0]->file_url.'" />';
$head .= '<meta property="og:type" content="website" />';
$head .= '<meta property="og:site_name" content="msvet.com.ua"/>';
$head .= '<meta property="og:url" content="'.JFactory::getURI().'" />';
$doc->addCustomTag($head);
/*--- END Микроразметка Open Graph для карточки товара ---*/


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
	if(VmConfig::get('ask_question', 0) && isset( $this->askquestion_url )){
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
	/*if(VmConfig::get('ask_question', 0)){
		$boxAsk = "jQuery.facebox({
				iframe: '" . $this->askquestion_url . "',
				rev: 'iframe|550|550'
			});";
	}*/
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

$app    = \Joomla\CMS\Factory::getApplication();
$pathway = $app->getPathway();
$pathwayNames = $pathway->getPathwayNames() ;
$pathwayNamesCount = ( count( $pathwayNames ) - 1 ) ;
unset($pathwayNames[0]) ; 
unset($pathwayNames[$pathwayNamesCount]) ;
$pathwayText = implode('/' , $pathwayNames );




?>

<div class="productdetails-view productdetails" itemscope itemtype="http://schema.org/Product">
    <div class="product-category" style="display: none">
        <?= $pathwayText ?>
    </div>

    <h1 class="product_ttl" itemprop="name">
        <?= $this->product->product_name ?>
    </h1>
	<div>
        <?php echo $this->edit_link; ?>
    </div>
	<div class="row-fluid">
    	<div class="span5">
        
        	<div class="bonus_product_wrap">
				<?php 
               	if ($this->product->hit == 1){ 
                    echo '<div class="ribbon-hot_product" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO_HIT').'"></div>';
                }
                if ($this->product->action == 1){
                    echo '<div class="ribbon-special_product" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO1').'"></div>';
                } 
                if ($this->product->action2 == 1){
                    echo '<div class="ribbon-special_product2" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO2').'"></div>';
                }
                if ($this->product->action3 == 1){
                    echo '<div class="ribbon-special_product3" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO3').'"></div>';
                }				 
                if ($this->product->new == 1){
                    echo '<div class="ribbon-new_product" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO_NEW').'"></div>';
                } 
             	?>	 
			</div><!-- .bonus_product_wrap -->
            <?php echo $this->loadTemplate('images'); ?>   
        </div><!-- .span6 -->
		
        <div id="b-area" class="span5"> 
			<div class="spacer-buy-area"> 
			  <?php // afterDisplayTitle Event
				echo $this->product->event->afterDisplayTitle ?>

				<?php

				if (!empty($this->product->customfieldsSorted['ontop'])) {
					$this->position = 'ontop';
					echo $this->loadTemplate('customfields');
				} // Product Custom ontop end
				?>

			<?php /*
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
			*/ ?>


			<div class="product-rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
				<?php
				JPluginHelper::importPlugin( 'content', 'vrvote' );
				$dispatcher = JDispatcher::getInstance();
				$results = $dispatcher->trigger( 'vrvote', $this->product->virtuemart_product_id );
				?>
			</div>



			<?php
			// TODO in Multi-Vendor not needed at the moment and just would lead to confusion
			/* $link = JRoute::_('index2.php?option=com_virtuemart&view=virtuemart&task=vendorinfo&virtuemart_vendor_id='.$this->product->virtuemart_vendor_id);
			$text = vmText::_('COM_VIRTUEMART_VENDOR_FORM_INFO_LBL');
			echo '<span class="bold">'. vmText::_('COM_VIRTUEMART_PRODUCT_DETAILS_VENDOR_LBL'). '</span>'; ?><a class="modal" href="<?php echo $link ?>"><?php echo $text ?></a><br />
			*/
		
			// Product Short Description
			if (!empty($this->product->product_s_desc)) {
			?>
				<div class="product-short-description" itemprop="description">
					<span class="module-arrow"></span>
					<?php
					/** @todo Test if content plugins modify the product description */
					echo nl2br($this->product->product_s_desc);
					?>
				</div>
			<?php
			} // Product Short Description END

			?>
            
          
                <!-- div class="partnomer">
                    <span class="product_sku_label">
                    <?php //echo JText::_('COM_VIRTUEMART_PRODUCT_PARTNOMER'); ?></span>
                    <span class="product_sku"><?php //echo $this->product->product_sku  //Артикул ?></span>
                </div-->
                
          
        		<?php if (!empty($this->product->product_mpn)): ?>
                <div class="partnomer">
                    <span class="product_sku_label">
                    <?php echo JText::_('COM_VIRTUEMART_PRODUCT_MPN1'); ?>:</span>
                    <span class="product_sku"><?php echo $this->product->product_mpn  //Код товара ?></span>
                </div>
                <?php endif; ?>

                 
           	<div class="bonus_product_wrap_text">
				<?php 
 
                if ($this->product->action2 == 1){
                    echo '<div class="bonus_wrap_text" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO2').'">'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO2').'</div>';
                }
                if ($this->product->action3 == 1){
                    echo '<div class="bonus_wrap_text" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO3').'">'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO3').'</div>';
                }				  
             	?>	 
			</div><!-- .bonus_product_wrap -->            

				<?php
				// Manufacturer of the Product
				//if (VmConfig::get('show_manufacturers', 1) && !empty($this->product->virtuemart_manufacturer_id)) {
					//echo $this->loadTemplate('manufacturer');
				//}
				?>			
			
			<div class="vm-product-details-container" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<?php

				//if (is_array($this->productDisplayShipments)) {
					//foreach ($this->productDisplayShipments as $productDisplayShipment) {
						//echo $productDisplayShipment . '<br />';
					//}
				//}
				//if (is_array($this->productDisplayPayments)) {
					//foreach ($this->productDisplayPayments as $productDisplayPayment) {
						//echo $productDisplayPayment . '<br />';
				//}
				//}


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
					echo '<div class="availability">', JText::_('COM_VIRTUEMART_STOCK_LEVEL_DISPLAY_OUT_TIP'), '</div>';

				}
				else {
				?>   <div class="availability">
						<?php 
							echo JText::_('COM_VIRTUEMART_STOCK_LEVEL_DISPLAY_NORMAL_TIP'); 
								if($this->product->product_in_stock > 0){
									echo "<meta itemprop='availability' content='http://schema.org/InStock' />";
								} else {
									echo "<meta itemprop='availability' content='http://schema.org/OutOfStock' />";
								}
						?>
					</div>
				<?php
				}
				?>
			</div>
        
        
            <?php 
				$modules = JModuleHelper::getModules( 'cart-tovara' );
				if(count($modules)!=0){?>
					<div class="cart-tovara">
                   	<h3 class="h-dop-mod">Не забудьте купить</h3>
                    	<?php  
							foreach ( $modules as $module ) {
								echo JModuleHelper::renderModule( $module );
							} //  end foreach
						?>
                    </div><!-- /.cart-tovara-->
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
                                    <!--a href="<?php //echo $catURL ?>" class="" title="<?php //echo $categoryName ?>">
										<?php //echo JText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO',$categoryName) ?>
                                    </a-->

                                    <p><span><?php echo JText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO_CAT') ?></span>
                                    <a href="<?php echo $catURL ?>" class="" title="<?php echo JText::sprintf('COM_VIRTUEMART_CATEGORY_BACK_TO',$categoryName) ?>"><?php echo $categoryName ?></a>
                                    </p>
                                    
                                </div>				
				
				<?php // Product URL
					$urlproduct = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id);					
				?>
								
				<div class="fb-share-button" data-href="https://msvet.com.ua<?php echo /*JURI::base().*/$urlproduct ?>" data-layout="button" data-size="large">
					<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fmsvet.com.ua%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Поделиться</a>
				</div>				
				
            <?php } 
                // Product Navigation END ?> 
            </div>
		</div>
		<div class="span2">
            <?php 
				$modules = JModuleHelper::getModules( 'cart-tovara2' );
				if(count($modules)!=0){?>
					<div class="mod-righ-product">
                    	<?php  
							foreach ( $modules as $module ) {
								echo JModuleHelper::renderModule( $module );
							} 
						?>
                    </div>
				<?php						
				} 
			?>
		</div>
		<div class="clear"></div>
	</div>

   
        <!-- Видео -->
    <?php 
		if( !empty ($this->product->customfieldsSorted['Video'] [0]->display) ){?> 
		<div class="product_video">
		<?php 
			if( isset ($this->product->customfieldsSorted['Video'] [0]) ){
				foreach ( $this->product->customfieldsSorted['Video']  as  $k => $video ){ 
					$vidId = str_replace('https://youtu.be/', "", $video->customfield_value);
					?>
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$vidId?>" frameborder="0" allowfullscreen></iframe>
					<?php
				}//foreach	
			} // end if
		  ?>   

		</div> 
	   <?php }?>
    <div class="clear"></div>



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
    //if (VmConfig::get('showCategory', 1)) {
	//echo $this->loadTemplate('showcategory');
    //}
	
    if (!empty($this->product->customfieldsSorted['onbot'])) {
    	$this->position='onbot';
    	echo $this->loadTemplate('customfields');
    } // Product Custom ontop end
    ?>
    
			<!-- Плагин Сatproduct -->
            <div class="wrap_Сatproduct">
			<?php
         if (!empty($this->product->customfieldsSorted['normal'])) {
            $this->position = 'catproduct';
            echo $this->loadTemplate('customfields2');
            }
            ?>
            </div>
            <!-- END Плагин Сatproduct -->       



            
    


<section class="tabs">
 <input id="tab_1" type="radio" name="tab" checked="checked" />
<input id="tab_2" type="radio" name="tab" />
<!--<input id="tab_3" type="radio" name="tab" />-->
<input id="tab_4" type="radio" name="tab" />
<input id="tab_5" type="radio" name="tab" /> 
 
	
    
    
 
	
    <label for="tab_1" id="tab_l1"><?php echo vmText::_('TEKHNICHESKIE_HARAKTERISTIKI') ?> </label><!--Заголовок 1 вкладки-->
    
    <label for="tab_2" id="tab_l2"><?php echo vmText::_('COM_VIRTUEMART_PRODUCT_DESC_TITLE') ?></label><!--Заголовок 2 вкладки-->  
		
       
	
	<?php 	
		//if ($this->product->video == 1){
			//echo '<label for="tab_5" id="tab_l5">Видео</label>';
		//} 
	?>	
                                     
                                     
    <?php 
	if (JModuleHelper::renderModule(array_shift(JModuleHelper::getModules('tab_3'))) != "")  : ?> 
    	<label for="tab_3" id="tab_l3"><?php echo vmText::_('KAK_PLATIT') ?></label> <!--Заголовок 3 вкладки--> 
    <?php 
	endif; ?>  
   
	<?php 
	if (JModuleHelper::renderModule(array_shift(JModuleHelper::getModules('tab_4'))) != "")  : ?>
		<label for="tab_4" id="tab_l4"> <?php echo vmText::_('GARANT__DOSTAVKA') ?></label><!--Заголовок 4 вкладки-->
	<?php 
	endif; ?>  
    
    <label for="tab_5" id="tab_l5"><?php echo vmText::_('OTZYVY') ?></label><!--Заголовок 5 вкладки-->
    
	<div style="clear:both"></div>

	<div class="tabs_cont">
		<div id="tab_c1"><!--Содержание 1 вкладки-->
			<?php
    		if (!empty($this->product->customfieldsSorted['normal'])) {
				$this->position = 'normal';
				echo $this->loadTemplate('customfields');
    		} // Product custom_fields END
			
			// Product Packaging
    		$product_packaging = '';
    		if ($this->product->product_box) {?>
				<div class="product-box">
	    			<?=vmText::_('COM_VIRTUEMART_PRODUCT_UNITS_IN_BOX') .$this->product->product_box;?>
	    		</div>
    		<?php 
			} // Product Packaging END ?>
 		</div><!-- /.tab_c1 -->
		
        <div id="tab_c2"><!--Содержание 2 вкладки-->
			<div class="product_desc">
				<?php // event onContentBeforeDisplay
                echo $this->product->event->beforeDisplayContent; ?>
                <div class="product-description" itemprop="description">
					<?= $this->product->product_desc; ?>
        		</div>
			</div><!-- /.product_desc -->   
		</div><!-- /. tab_c2 -->

		<div id="tab_c3"><!--Содержание 3 вкладки-->
			<div class="mod_tab_tovar">
				<?php
                $pos = "tab_3";
				$modules =& JModuleHelper::getModules($pos);
				foreach ($modules as $module){
					echo JModuleHelper::renderModule($module);
				}?>
			</div> <!-- /.mod_tab_tovar -->
		</div><!-- /#tab_c3 -->
		
        <div id="tab_c4"><!--Содержание 4 вкладки-->
			<div class="mod_tab_tovar">
				<?php
                $pos = "tab_4";
                $modules =& JModuleHelper::getModules($pos);
                foreach ($modules as $module){
                	echo JModuleHelper::renderModule($module);
                }?>
			</div><!-- /.mod_tab_tovar --> 
		</div><!-- /#tab_c4 -->
		<!--Содержание 5 вкладки-->
        <div id="tab_c5">
			<?php
            echo $this->product->event->afterDisplayContent; 
			$comments = JPATH_ROOT . '/components/com_jcomments/jcomments.php';
			if (file_exists($comments)) {
				require_once($comments);
				echo JComments::showComments($this->product->virtuemart_product_id, 'com_virtuemart', $this->product->product_name);
			}?>
    		<?php
    		//  echo $this->loadTemplate('reviews'); ?>
    	</div> <!-- /#tab_c5 -->
	</div><!-- /.tabs_cont -->
</section>  

	<div class="sublayouts_product">
	<?php 
echo shopFunctionsF::renderVmSubLayout('customfields',array('product'=>$this->product,'position'=>'related_products','class'=> 'product-related-products','customTitle' => true ));
?>
</div>

			<!-- модуль lending1 -->
            <?php 
            $pos = "lending1";
            $modules =& JModuleHelper::getModules($pos);
            foreach ($modules as $module){
            echo JModuleHelper::renderModule($module);
            }
            ?>
            <!-- END модуль lending1 -->   
            
            
            
            

</div>
<?php 

/** GALT
 * Notice for Template Developers!
 * Templates must set a Virtuemart.container variable as it takes part in
 * dynamic content update.
 * This variable points to a topmost element that holds other content.
 */
$j = "Virtuemart.container = jQuery('.productdetails-view');
Virtuemart.containerSelector = '.productdetails-view';";

vmJsApi::addJScript('ajaxContent',$j);

if(VmConfig::get ('jdynupdate', TRUE)){
	$j = "jQuery(document).ready(function($) {
	 Virtuemart.stopVmLoading();
	var msg = '';
	jQuery('a[data-dynamic-update=\"1\"]').off('click', Virtuemart.startVmLoading).on('click', {msg:msg}, Virtuemart.startVmLoading);
	jQuery('[data-dynamic-update=\"1\"]').off('change', Virtuemart.startVmLoading).on('change', {msg:msg}, Virtuemart.startVmLoading);
});";

	vmJsApi::addJScript('vmPreloader',$j);
}

echo vmJsApi::writeJS();

 ?>