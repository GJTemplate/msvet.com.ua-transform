<?php 
defined('_JEXEC') or die('Restricted access');

if (!class_exists( 'my_utl' )) require(JPATH_ROOT .DS.'templates'.DS.'transform'.DS.'utils'.DS.'my_utl.php');

	$customfield = $viewData['customfield'];
	$jsArray = $viewData['jsArray'];
	$mediaArr = $viewData['mediaArr'];
	$tag =  $viewData['tag'];
	$customfield_params =  explode ("|" , $customfield->customfield_params) ;

	$hesh = $viewData['hesh'];
 

	// $customfield ->customfield_params  - JSON param

  	// my_utl :: str2url('Зеленый ')   - Транс лит

	 
	 
// echo '<pre>'; print_r (    $mediaArr  ); echo '</pre>'.__FILE__.' in line:  '.__LINE__ ;
 
 	$o = new stdClass();
	$o->value = $tag; ?>
 
 	<div class="wrapGrafFilters" style=""  >
 	<input type="hidden" hesh="<?=  $hesh ?>" value='<?= json_encode ($o )  ?>'>
 	<?php 
	
	// echo '<pre>'; print_r ( $jsArray ); echo '</pre>'.__FILE__.' in line:  '.__LINE__ ;
	 
	
 	foreach ( $customfield ->selectoptions  as  $k => $v_arr ){
    	
		
    ?>    
        
		<div class="filter_<?= $k ?> filterRow" indexselectelement="<?= $k ?>" >
        	<!--<span><?= $v_arr->clabel ?></span>-->
         	<div class="wrap_obj obj_selectorParenID_<?=$k?>">
				<?php 
				$arr_values = explode ("\n" , $v_arr->values) ;
			 
			 	// echo '<pre>'; print_r ( $arr_values ); echo '</pre>'.__FILE__.' in line:  '.__LINE__ ;
			 
				foreach (  $arr_values  as $i =>  $property ){
				
					 
					
					/*  $url_prod = json_decode (	$jsArray[$i]) ;
					echo '<pre>'; print_r (  $url_prod ); echo '</pre>'.__FILE__.'Строка '.__LINE__ ;*/
					
					if( empty ($property) ){ continue; } // end if
					$property = preg_replace ("/^[^a-zA-ZА-Яа-я0-9\s]*$/","",$property); 
					$property = str_replace(array("\r","\n"), '', $property);
					?>
					<div class="wrapProperty">
                		<div class="<?= my_utl :: str2url( $property)  ?> selectProperty"   title="<?= $property ?>"></div><!-- .selectProperty -->	
                	</div>	
				<?php
				}//foreach ?>
        	</div> <!-- .obj_selectorParenID_-->  
        </div><!-- .filter_ -->
	<?php 
	}//foreach ?>
 </div><!-- .wrapGrafFilters -->   