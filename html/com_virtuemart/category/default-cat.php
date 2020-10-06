<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 6556 2012-10-17 18:15:30Z kkmediaproduction $
 */

//vmdebug('$this->category',$this->category);
//vmdebug ('$this->category ' . $this->category->category_name);
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
JHTML::_ ('behavior.modal');
/* javascript for list Slide
  Only here for the order list
  can be changed by the template maker
*/
$js = "
jQuery(document).ready(function () {
	jQuery('.orderlistcontainer').hover(
		function() { jQuery(this).find('.orderlist').stop().show()},
		function() { jQuery(this).find('.orderlist').stop().hide()}
	)
});
";

$document = JFactory::getDocument ();
$document->addScriptDeclaration ($js);

	if (empty($this->keyword) and !empty($this->category)) {
		?>
		
	<?php
	}

/* Show child categories */
if (VmConfig::get ('showCategory', 1) and empty($this->keyword)) {
	if (!empty($this->category->haschildren)) {

		// Category and Columns Counter
		$iCol = 1;
		$iCategory = 1;

		// Calculating Categories Per Row
		$categories_per_row = VmConfig::get ('categories_per_row', 3);
		//$category_cellwidth = ' width' . floor (100 / $categories_per_row);

		if ($categories_per_row == 4) { $category_cellwidth = 'span3'; }
		elseif ($categories_per_row == 3) { $category_cellwidth = 'span4'; }
		elseif ($categories_per_row == 2) { $category_cellwidth = 'span6'; }
		elseif ($categories_per_row == 1) { $category_cellwidth = 'span12'; }
		
		// Separator
		$verticalseparator = " vertical-separator";
		?>

		<div class="category-view">

		<?php // Start the Output
		if (!empty($this->category->children)) {
			foreach ($this->category->children as $category) {

				// Show the horizontal seperator
				if ($iCol == 1 && $iCategory > $categories_per_row) {
					?>
					<div class="horizontal-separator"></div>
					<?php
				}

				// this is an indicator wether a row needs to be opened or not
				if ($iCol == 1) {
					?>
			<div class="row-fluid">
			<?php
				}

				// Show the vertical seperator
				if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {
					$show_vertical_separator = ' ';
				} else {
					$show_vertical_separator = $verticalseparator;
				}

				// Category Link
				$caturl = JRoute::_ ('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id);

				// Show Category
				?>
				<div class="category floatleft <?php echo $category_cellwidth . $show_vertical_separator ?>">
					<div class="spacer">
						<h2 class="category-view-title">
							<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">
							
							
								<?php // if ($category->ids) {
								 $img = $category->images[0]->displayMediaThumb ("", FALSE);
								
								$img = str_replace(".jpg", ".jpg?v=1", $img);
								
								echo $img;
								//} ?>
								
							<br />
							<span class="cat-title"><?php echo $category->category_name ?></span>
								
							</a>
						</h2>
					</div>
				</div>
				<?php
				$iCategory++;

				// Do we need to close the current row now?
				if ($iCol == $categories_per_row) {
					?>
					<div class="clear"></div>
		</div>
			<?php
					$iCol = 1;
				} else {
					$iCol++;
				}
			}
		}
		// Do we need a final closing row tag?
		if ($iCol != 1) {
			?>
			<div class="clear"></div>
		</div>
	<?php } ?>
	</div>

	<?php
	}
}
?>

    <h1><?php echo $this->category->category_name; ?></h1>	
	
	<?php 
	if (!empty($this->keyword)) {?>
		<h3><?=$this->keyword; ?></h3>
	<?php 
	}   // end if 
	?>
    
    
	<?php 
	if (!empty($this->keyword)) {
		$category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>
		<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0&virtuemart_category_id=' . $this->category->virtuemart_category_id); ?>" method="get">

            <!--BEGIN Search Box -->
            <div class="virtuemart_search">
                <?php echo $this->searchcustom ?>
                <br/>
                <?php echo $this->searchcustomvalues ?>
                <input name="keyword" class="inputbox" type="text" size="20" value="<?php echo $this->keyword ?>"/>
                <input type="submit" value="<?php echo vmText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
            </div>
            <input type="hidden" name="search" value="true"/>
            <input type="hidden" name="view" value="category"/>
            <input type="hidden" name="option" value="com_virtuemart"/>
            <input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
		</form>
<!-- End Search Box -->
	<?php 
	}// end if 
	?>
	
	<?php 
	$start = JRequest::getInt('limitstart',0);  
	$option = JRequest::getVar('option',''); 
	if(!$start && $option == 'com_virtuemart'){ ?>
		<div class="category_description seo-abs">
			 <?php echo $this->category->category_description ; ?>
		</div>
	<?php } ?>
   
    <?php
    die(__FILE__ .' '. __LINE__ );


	if (!empty($this->products)) {?>
		<div class="orderby-displaynumber row-fluid">
            	
                <?php // сортировка продуктов ?>
                <div class="span8 floatleft">
                	<?=$this->orderByList['orderby']; ?>
                	<?php //echo $this->orderByList['manufacturer']; ?>
            	</div>
            	<?php // количество товаров на странице  ?>
                <div class="span4 floatright display-number">
					<?=$this->vmPagination->getResultsCounter ();?>
            		<br/>
					<?= $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?>
                </div><!--/.span4.floatright-->
                
                <!-- 
                div class="vm-pagination">
                    <?php //echo $this->vmPagination->getPagesLinks (); ?>
                    <span style="float:right"><?php //echo $this->vmPagination->getPagesCounter (); ?></span>
                </div 
                -->
        		<div class="clear"></div>
        	</div> 
    		<!-- end of orderby-displaynumber -->
	<?php 
    }// end if





	?>

	<div class="browse-view ajaxNavigation">
		<?php // Show child categories
		if (!empty($this->products)) {?>
   			
			<?php
			// Category and Columns Counter
			$iBrowseCol = 1;	//  счетчик сторок товаров
			$iBrowseProduct = 1; //  счетчик товаров в строке

			// Calculating Products Per Row
			$BrowseProducts_per_row = $this->perRow; //  количиство товаров в стороке
			if ($BrowseProducts_per_row == 4) { $Browsecellwidth = 'span3'; }
			else if ($BrowseProducts_per_row == 3) { $Browsecellwidth = 'span4'; }
			else if ($BrowseProducts_per_row == 2) { $Browsecellwidth = 'span6'; }
			else if ($BrowseProducts_per_row == 1) { $Browsecellwidth = 'span12'; }

			// Separator
			$verticalseparator = " vertical-separator";
			$BrowseTotalProducts = count($this->products); // Количество товаров на стронице 
			$intr = 0;
	
			
			
			
			
			// Start the Output
			foreach ($this->products as $product) {
				
				
				 
				/*==========================================================*/ 
				if ($product->product_parent_id !== "0") { 
				
					 
  					$iBrowseProduct --; 
 				} else { 
				/*==========================================================*/ 
				
				// Show the horizontal seperator
				if ($iBrowseCol == 1 && $iBrowseProduct > $BrowseProducts_per_row) { ?>
					<div class="horizontal-separator"></div>
				<?php
				}   // end if

				// this is an indicator wether a row needs to be opened or not
				if ($iBrowseCol == 1) {?>
					<div class="product_block_page">
            			<div class="row-fluid">
		<?php
		}	
			
			 
	

		// Show the vertical seperator
		if ($iBrowseProduct == $BrowseProducts_per_row or $iBrowseProduct % $BrowseProducts_per_row == 0) {
			$show_vertical_separator = ' ';
		} else {
			$show_vertical_separator = $verticalseparator;
		}

		
		
		// Show Products
		$intr++;
		 
        if( $intr==7 ){
		//  Вывод модуля рекламмы	
		?>
		<div class="product floatleft vertical-separator span6" style=" ">
			<div class="spacer bloc-image-rendom">
				<?php 	  
                $BrowseTotalProducts = $BrowseTotalProducts +2;  
                $ModulPosition  = 'image-rendom1';		  
                jimport( 'joomla.application.module.helper' ); // подключаем нужный класс, один раз на странице, перед первым выводом
                $module = JModuleHelper::getModules($ModulPosition); // получаем в массив все модули из заданной позиции
                $attribs['style'] = 'xhtml'; // задаём, если нужно, оболочку модулей (module chrome)
                echo JModuleHelper::renderModule($module[0], $attribs); // выводим первый модуль из заданной позиции 
                 ?>
			</div>
		</div><!-- /.product-->
		
		
		<div class="clear"></div>
        </div>
         <div class="horizontal-separator"></div>	
         
         <div class="row-fluid">
         
        
		<?php
		$show_vertical_separator = ' vertical-separator ';

			$iBrowseProduct++;
			$iBrowseProduct++;

			$iBrowseCol = 1;	
		 	
			} // end if
		
		
		
			if( $iBrowseProduct==21  ){
				$iBrowseCol = 3; ?>
				<div class="product floatleft span6 <?php echo $show_vertical_separator ?>" style="max-height:390px;overflow: hidden;">
					<div class="spacer bloc-image-rendom">
						<?php 
						$ModulPosition  = 'image-rendom2';		  
						jimport( 'joomla.application.module.helper' ); // подключаем нужный класс, один раз на странице, перед первым выводом
						$module = JModuleHelper::getModules($ModulPosition); // получаем в массив все модули из заданной позиции
						$attribs['style'] = 'xhtml'; // задаём, если нужно, оболочку модулей (module chrome)
						echo JModuleHelper::renderModule($module[0], $attribs); // выводим первый модуль из заданной пози
						?>
					</div>
				</div>
			<?php		
			} // end if ?>
		
         	
			<div class="product floatleft <?php echo $Browsecellwidth . $show_vertical_separator ?>">
				
                <div class="spacer">
	        		
                    <div class="DefWrap">
              			
                        <div class="bonus_product_wrap">
							<?php
							if (@$product->new == 1) {
								echo '<div class="ribbon-new_cat" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO_NEW').'"></div>';
								}
							if (@$product->hit == 1) {
								echo '<div class="ribbon-hot_cat" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO_HIT').'"></div>';
								}
							if (@$product->action == 1) {
								echo '<div class="ribbon-special_cat" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO1').'"></div>';
								}
							if (@$product->action2 == 1) {
								echo '<div class="ribbon-special_cat2" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO2').'"></div>';
								} 
							if (@$product->action3 == 1) {
								echo '<div class="ribbon-special_cat3" title="'. JText::_('COM_VIRTUEMART_ACTION_TEXT_INFO3').'"></div>';
								}																 
						 	?>
						</div>
                        
                 		<!-- Картинка товара -->
                        <div class="spacer-handler pr-img-handler">
                        
                            
                            <a href="<?php echo $product->link;?>">
                                <?php
                                $img = $product->images[0]->displayMediaThumb ('class="browseProductImage" border="0" title="' . $product->product_name . '" ', FALSE, 'class="modal"');
                                $img = str_replace(".jpg", ".jpg?v=1", $img);
                                $img = str_replace("src=", "data_src=", $img);
                                $img = str_replace("<img ", '<img src="/templates/transform/images/_.gif?v=1"', $img);
                                echo $img;
                                ?>
                            </a>
                        
                            <!--
                            <div class="popout-price">
                                <div class="popout-price-buttons-handler">
                                    <?php 
                                    if ($product->images) {
                                        echo '<div class="show-pop-up-image">'.$product->images[0]->displayMediaThumb( 'class="featuredProductImage"',true,'class="modal"' ).'</div>';
                                    }
                                    echo JHTML::link ( JRoute::_ ( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id ), vmText::_ ( 'COM_VIRTUEMART_PRODUCT_DETAILS' ), array ('title' => $product->product_name, 'class' => 'product-details' ) );				
                                    ?>
                                </div>
                            </div>
                       		-->
					
						</div>
                 	
                  		<?php 
						// Вывод фильтра для цветов и пр.
						//echo '<!--  '.__FILE__.' строка '.__LINE__.' -->';  	
					
						if(isset ($product->customfieldsSorted['addtocart'] )  ){
							
							foreach ( $product->customfieldsSorted['addtocart'] as $field) { ?>
						
								<div class="product-field product-field-type-<?=$field->field_type ?>">
								<?php 
                                if ($field->show_title) { ?>
                                    <span class="product-fields-title-wrapper">
                                        <span class="product-fields-title">
                                            <strong><?php echo vmText::_ ($field->custom_title) ?></strong>
                                        </span>
                                        <?php 
                                        if ($field->custom_tip) {
                                            echo JHtml::tooltip ($field->custom_tip, vmText::_ ($field->custom_title), 'tooltip.png');
                                        } ?>
                                    </span>
                                <?php 
                                } ?> 
                                <span class="product-field-display">
                                     <?php echo $field->display ?> 
                                </span> 

                                <span class="product-field-desc">
                                    <?= $field->custom_desc ?>
                                </span>
							</div>
							
							<?php
							} //foreach	
						
						} // end if ?>
					 	
                        <h2 class="h-pr-title">
                            <?=JHTML::link ($product->link, $product->product_name); ?>
                        </h2>
                 	
                    	<?php 
						if (!empty($product->product_mpn)): ?>
                			<div class="partnomer">
                    			<span class="product_sku_label">
                    				<?=JText::_('COM_VIRTUEMART_PRODUCT_MPN'); ?>:
                               	</span><br />
                    			<span class="product_sku"><?php echo $product->product_mpn  //Код товара ?></span>
                			</div>
                		<?php 
						endif; ?>
                    
                    
                   		<div class="product-price-1" id="productPrice<?php echo $product->virtuemart_product_id ?>">
							<?php
                            if ($this->show_prices == '1') {
                                    if ($product->prices['salesPrice']<=0 and VmConfig::get ('askprice', 1) and  !$product->images[0]->file_is_downloadable) {
                                        echo vmText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE');
                                    }
                                    //todo add config settings
                                    if ($this->showBasePrice) {
                                        echo $this->currency->createPriceDiv ('basePrice', 'COM_VIRTUEMART_PRODUCT_BASEPRICE', $product->prices);
                                        echo $this->currency->createPriceDiv ('basePriceVariant', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_VARIANT', $product->prices);
                                    }
                                    echo $this->currency->createPriceDiv ('variantModification', 'COM_VIRTUEMART_PRODUCT_VARIANT_MOD', $product->prices);
                                    if (round($product->prices['basePriceWithTax'],$this->currency->_priceConfig['salesPrice'][1]) != $product->prices['salesPrice']) {
                                        //echo '<div class="price-crossed" >' . $this->currency->createPriceDiv ('basePriceWithTax', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_WITHTAX', $product->prices) . "</div>";
                                        
                                        echo '<div class="price-crossed" >' . $this->currency->createPriceDiv ('basePriceWithTax', '', $product->prices) . "</div>";
                                        //echo '<div class="price-crossed">&nbsp;</div>';
                                    }
                                
                                    if (round($product->prices['salesPriceWithDiscount'],$this->currency->_priceConfig['salesPrice'][1])!=$product->prices['salesPrice']) {
                                        echo $this->currency->createPriceDiv ('salesPriceWithDiscount', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITH_DISCOUNT', $product->prices);
                                    }
                                    echo $this->currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $product->prices);
                                    
                                    if ($product->prices['discountedPriceWithoutTax'] != $product->prices['priceWithoutTax']) {
                                        echo $this->currency->createPriceDiv ('discountedPriceWithoutTax', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITHOUT_TAX', $product->prices);
                                    } else {
                                        echo $this->currency->createPriceDiv ('priceWithoutTax', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITHOUT_TAX', $product->prices);
                                    }
                                    
                                    //echo $this->currency->createPriceDiv ('discountAmount', 'COM_VIRTUEMART_PRODUCT_DISCOUNT_AMOUNT', $product->prices);
                                    echo $this->currency->createPriceDiv ('taxAmount', 'COM_VIRTUEMART_PRODUCT_TAX_AMOUNT', $product->prices);
                                    $unitPriceDescription = vmText::sprintf ('COM_VIRTUEMART_PRODUCT_UNITPRICE', $product->product_unit);
                                    echo $this->currency->createPriceDiv ('unitPrice', $unitPriceDescription, $product->prices);
                                }  // end if ?>
						</div> <!-- .product-price-1 -->
                 	
						<?php // Товар на складе или под заказ
                        if ( VmConfig::get ('display_stock', 1)) {?>
                            <div class="paddingtop8">
                                <span class="stock-level"><?php echo $product->stock->stock_tip ?></span>
                            </div>
                        <?php								
                        } ?>
                 	
                    	<div class="h-pr-details">
                    		<form method="post" class="product" action="index.php" id="addtocartproduct<?php echo $product->virtuemart_product_id ?>">
                  				<div class="addtocart-bar">
									
									<?php 
                                    // Display the quantity box ?>
                                    <span class="quantity-box">
                                        <input  type="text" class="quantity-input" name="quantity[]" value="1" />
                                    </span>
                                    <span class="quantity-controls">
                                        <input type="button" class="quantity-controls quantity-plus" />
                                        <input type="button" class="quantity-controls quantity-minus" />
                                    </span>
                                    <?php // Display the quantity box END ?>
        
                    				<?php 
									// Add the button
									$button_lbl = JText::_('COM_VIRTUEMART_CART_ADD_TO');
									$button_cls = ''; //$button_cls = 'addtocart_button';
									if (VmConfig::get('check_stock') == '1' && !$product->product_in_stock) {
										$button_lbl = JText::_('COM_VIRTUEMART_CART_NOTIFY');
										$button_cls = 'notify-button';
									}  // end if
									
									// Display the add to cart button ?>
                                    <span class="addtocart-button">
                                        <input type="submit" name="addtocart" onClick="ga('send', 'event', 'Buy', 'Submit');" class="addtocart-button" value="<?php echo $button_lbl ?>" title="<?php echo $button_lbl ?>" />
                                    </span>
        							<div class="clear"></div>
                				</div> <!-- .addtocart-bar -->
								<?php // Display the add to cart button END ?>
                                <input type="hidden" class="pname" value="<?php echo $product->product_name ?>">
                                <input type="hidden" name="option" value="com_virtuemart" />
                                <input type="hidden" name="view" value="cart" />
                                <noscript><input type="hidden" name="task" value="add" /></noscript>
                                <input type="hidden" class="PRODUCT_virtuemart_product_id" name="virtuemart_product_id[]" value="<?=$product->virtuemart_product_id ?>" />
								<?php /** @todo Handle the manufacturer view */ ?>
                                <input type="hidden" name="virtuemart_manufacturer_id" value="<?php echo $product->virtuemart_manufacturer_id ?>" />
                                <input type="hidden" name="virtuemart_category_id[]" value="<?php echo $product->virtuemart_category_id ?>" />
        					</form>
                        </div> <!-- .h-pr-details -->
             			
						<?php 
                        // Product Short Description
                        if (!empty($product->product_s_desc)) {?>
                            <p class="product_s_desc">
                                <?=$product->product_s_desc; ?>
                                <?php // echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 42, '...') ?>
                            </p>
                        <?php 
                        } // end if ?>
					
                    </div> <!-- .DefWrap -->
            		
                    <div class="addWrap"></div>
					<div class="h-pr-details"></div> 
                     
				</div><!-- end of spacer -->
                
			</div> <!-- end of product -->
			<?php
			// Do we need to close the current row now?
			if ($iBrowseCol == $BrowseProducts_per_row || $iBrowseProduct == $BrowseTotalProducts) {?>
				<div class="clear"></div>
				</div> <!-- end of row -->
				</div><!-- /.product_block_page-->
				<?php
				$iBrowseCol = 1;
			} else {
				$iBrowseCol++;
			}
			$iBrowseProduct++;
		
		} //end of if ($product->product_parent_id !== "0") 
	 	
	} // end of foreach ( $this->products as $product )
	
	// Do we need a final closing row tag?
	if ($iBrowseCol != 1) {?>
		<div class="clear"></div>

	<?php
	}
	?>


	<?php
    } elseif ($this->search !== NULL) {
        echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
    }
    ?>

</div><!-- end browse-view -->

<div class="vm-pagination">
		<?= $this->vmPagination->getPagesLinks (); ?>
        <!--span style="float:right"><?php //echo $this->vmPagination->getPagesCounter (); ?></span-->
    </div>
    <div class="clear"></div>
    
<div class="seo-fix"></div>
<div class="clear"></div>