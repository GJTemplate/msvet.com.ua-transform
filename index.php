<?php defined( '_JEXEC' ) or die;

JLoader::registerNamespace( 'GNZ11' , JPATH_LIBRARIES . '/GNZ11' , $reset = false , $prepend = false , $type = 'psr4' );
$GNZ11_js =  \GNZ11\Core\Js::instance();

?>
<?php if( $this->countModules('mod-home-2')) : ?>
	<?php 
		$timer_date = '16-07-2018';	// день/месяц/год
		$session = JFactory::getSession();
		$session->set('timer_date', $timer_date);
	?>
<?php endif; ?>

<?php
    

    
if (!class_exists( 'VmConfig' )) require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
defined('VM_REV') or define('VM_REV',vmVersion::$REVISION);
JHtml::_('behavior.framework', true);
JHtml::_('bootstrap.framework');
$doc = JFactory::getDocument();

$menu = \Joomla\CMS\Factory::getApplication()->getMenu();
$current_menu = $menu->getActive();

/**
 * Если включена отладка шаблона - разрешить выделение текста на странице
 */
if ( !$this->params->get("debug_on") )
{

    $doc->addStyleDeclaration('
        #main-content-handler{
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
        }
    ') ;
}#END IF



	$headData = $doc->getHeadData();
	  unset ( $headData['scripts']['/media/jui/js/jquery-noconflict.js'] )  ;
	  unset ( $headData['styleSheets']['/components/com_virtuemart/assets/css/facebox.css?vmver='.VM_REV] )  ; 			
	$doc->setHeadData($headData); 
	$v = 'if (typeof Virtuemart === "undefined") Virtuemart = {};';
			$v .= "Virtuemart.vmSiteurl = vmSiteurl = '".JURI::root()."' ;\n";
			$v .= 'Virtuemart.vmLang = vmLang = "&lang='.VmConfig::$vmlangSef.'";'."\n";
			$v .= 'Virtuemart.vmLangTag = vmLangTag = "'.VmConfig::$vmlangSef.'";'."\n";
 	
	$doc->addScriptDeclaration( $v );

JHtml::_('bootstrap.loadCss', true, $this->direction);
if($this->params->get("useresponsivemode") != 1) : 
unset($doc->_styleSheets[JURI::root(true) . '/media/jui/css/bootstrap-responsive.min.css']);
endif;
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<!--<![endif]-->

<head>






<?php if($this->params->get("useresponsivemode") == true ) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="ch7tKkkao556cOK031qm9EU9YjYhvcmx9zwtnsua5xA" />
    <meta name='yandex-verification' content='6b950a8e49f6d743' />
	<meta name="p:domain_verify" content="a1659f7785cb8cc53e74417a782a77b7"/>
<?php endif; ?>
	
<!-- A-B-Test -->
<?php
	





	
?> 	

	
	<jdoc:include type="head" />
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/selectivizr-min.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/modernizr.js"></script>
<![endif]-->
	<link href="//msvet.com.ua/templates/transform/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/all_css.css?vmver=<?=VM_REV?>" media="screen" />	
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/print.css?vmver=<?=VM_REV?>" media="print" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/vm-transform.css?vmver=<?=VM_REV?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/custom_fields.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/registracia.css" media="screen" />

	<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/selectnav.min.js"></script>
    <!--[if IE 6]> <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie6.css" media="screen" /> <![endif]-->
    <!--[if IE 7]> <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/ie.css" media="screen" /> <![endif]-->

    <?php
    if($this->params->get('usetheme')==true) : ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/presets/<?php echo $this->params->get('choosetheme'); ?>.css" media="screen" />
    <?php
    endif; ?>


	<?php

    if($this->params->get("usedropdown")) : ?>
	<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/js/superfish.js"></script>
	<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/js/supersubs.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function(){ 
        jQuery("ul.menu-nav").supersubs({ 
			minWidth: <?php echo $this->params->get("dropdownhandler1"); ?>,
            extraWidth:  1
        }).superfish({ 
            delay:500,
            animation:{
                opacity:'<?php if($this->params->get("dropopacity")) : ?>show<?php else: ?>hide<?php endif; ?>',height:'<?php if($this->params->get("dropheight")) : ?>show<?php else: ?>hide<?php endif; ?>',width:'<?php if($this->params->get("dropwidth")): ?>show<?php else: ?>hide<?php endif; ?>'},
            speed:'<?php echo $this->params->get("dropspeed"); ?>',
            autoArrows:true,
            dropShadows:false 
        });
    }); 
	
	jQuery(function() {                      
		jQuery(".closeMenu").click(function() { 
			jQuery('#social-links').attr('style','display:none');		
		});
	});
	</script>

	<?php
    endif; ?>


	<?php
    if( $this->countModules('position-1')) : ?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#menupanel').on('click', function() {
			jQuery('div.panel1').animate({
				'width': 'show'
			}, 300, function() {
				jQuery('div.menupanel').fadeIn(200);
			});
		});
		jQuery('span.closemenu').on('click', function() {
			jQuery('div.menupanel').fadeOut(200, function() {
				jQuery('div.panel1').animate({
					'width': 'hide'
				}, 300);
			});
		});
	});
	</script>
	<?php
    endif; ?>


	<?php echo $this->params->get("headcode"); ?>
	<?php if( $this->countModules('currency')) : ?>
	<script type="text/javascript" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template ?>/js/jquery.dropkick-1.0.0.js"></script>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.default-currency').dropkick();
	});
	</script>
	<?php endif; ?>
		
	<?php if( $this->countModules('builtin-slideshow')) : ?>
	<!-- Built-in Slideshow -->
	<?php if($this->params->get("cam_turnOn")) : ?>
		<link rel="stylesheet" id="camera-css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/camera.css" type="text/css" media="all" /> 
		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.mobile.customized.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.easing.1.3.js"></script> 
		<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/camera.min.js"></script> 
		<script>
			jQuery(function(){		
				jQuery('#ph-camera-slideshow').camera({
					alignment: 'topCenter',
					autoAdvance: <?php if ($this->params->get("cam_autoAdvance")) : ?>true<?php else: ?>false<?php endif; ?>,
					mobileAutoAdvance: <?php if ($this->params->get("cam_mobileAutoAdvance")) : ?>true<?php else: ?>false<?php endif; ?>, 
					slideOn: '<?php if($this->params->get("cam_slideOn")) : echo $this->params->get("cam_slideOn"); else : ?>random<?php endif; ?>',	
					thumbnails: <?php if ($this->params->get("cam_thumbnails")) : ?>true<?php else: ?>false<?php endif; ?>,
					time: <?php if($this->params->get("cam_time")) : echo $this->params->get("cam_time"); else : ?>7000<?php endif; ?>,
					transPeriod: <?php if($this->params->get("cam_transPeriod")) : echo $this->params->get("cam_transPeriod"); else : ?>1500<?php endif; ?>,
					cols: <?php if($this->params->get("cam_cols")) : echo $this->params->get("cam_cols"); else : ?>10<?php endif; ?>,
					rows: <?php if($this->params->get("cam_rows")) : echo $this->params->get("cam_rows"); else : ?>10<?php endif; ?>,
					slicedCols: <?php if($this->params->get("cam_slicedCols")) : echo $this->params->get("cam_slicedCols"); else : ?>10<?php endif; ?>,	
					slicedRows: <?php if($this->params->get("cam_slicedRows")) : echo $this->params->get("cam_slicedRows"); else : ?>10<?php endif; ?>,
					fx: '<?php if($this->params->get("cam_fx_multiple_on")) : echo $this->params->get("cam_fx_multi"); else : echo $this->params->get("cam_fx"); endif; ?>',
					gridDifference: <?php if($this->params->get("cam_gridDifference")) : echo $this->params->get("cam_gridDifference"); else : ?>250<?php endif; ?>,
					height: '<?php if($this->params->get("cam_height")) : echo $this->params->get("cam_height"); else : ?>50%<?php endif; ?>',
					minHeight: '<?php echo $this->params->get("cam_minHeight"); ?>',
					imagePath: '<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/',	
					hover: <?php if ($this->params->get("cam_hover")) : ?>true<?php else: ?>false<?php endif; ?>,
					loader: '<?php if($this->params->get("cam_loader")) : echo $this->params->get("cam_loader"); else : ?>pie<?php endif; ?>',
					barDirection: '<?php if($this->params->get("cam_barDirection")) : echo $this->params->get("cam_barDirection"); else : ?>leftToRight<?php endif; ?>',
					barPosition: '<?php if($this->params->get("cam_barPosition")) : echo $this->params->get("cam_barPosition"); else : ?>bottom<?php endif; ?>',	
					pieDiameter: <?php if($this->params->get("cam_pieDiameter")) : echo $this->params->get("cam_pieDiameter"); else : ?>38<?php endif; ?>,
					piePosition: '<?php if($this->params->get("cam_piePosition")) : echo $this->params->get("cam_piePosition"); else : ?>rightTop<?php endif; ?>',
					loaderColor: '<?php if($this->params->get("cam_loaderColor")) : echo $this->params->get("cam_loaderColor"); else : ?>#eeeeee<?php endif; ?>', 
					loaderBgColor: '<?php if($this->params->get("cam_loaderBgColor")) : echo $this->params->get("cam_loaderBgColor"); else : ?>#222222<?php endif; ?>', 
					loaderOpacity: <?php if($this->params->get("cam_loaderOpacity")) : echo $this->params->get("cam_loaderOpacity"); else : ?>8<?php endif; ?>,
					loaderPadding: <?php if($this->params->get("cam_loaderPadding")) : echo $this->params->get("cam_loaderPadding"); else : ?>2<?php endif; ?>,
					loaderStroke: <?php if($this->params->get("cam_loaderStroke")) : echo $this->params->get("cam_loaderStroke"); else : ?>7<?php endif; ?>,
					navigation: <?php if ($this->params->get("cam_navigation")) : ?>true<?php else: ?>false<?php endif; ?>,
					playPause: <?php if ($this->params->get("cam_playPause")) : ?>true<?php else: ?>false<?php endif; ?>,
					navigationHover: <?php if ($this->params->get("cam_navigationHover")) : ?>true<?php else: ?>false<?php endif; ?>,
					mobileNavHover: <?php if ($this->params->get("cam_mobileNavHover")) : ?>true<?php else: ?>false<?php endif; ?>,
					opacityOnGrid: <?php if ($this->params->get("cam_opacityOnGrid")) : ?>true<?php else: ?>false<?php endif; ?>,
					pagination: <?php if ($this->params->get("cam_pagination")) : ?>true<?php else: ?>false<?php endif; ?>,
					pauseOnClick: <?php if ($this->params->get("cam_pauseOnClick")) : ?>true<?php else: ?>false<?php endif; ?>,
					portrait: <?php if ($this->params->get("cam_portrait")) : ?>true<?php else: ?>false<?php endif; ?>
				});
			});
		</script>
	<?php endif; ?>
	<!-- End of Built-in Slideshow -->
	<?php
    endif;






    ?>
	
    <style type="text/css">
	<?php if($this->params->get("useresponsivemode") == false ) : ?>
	.container {width:<?php echo $this->params->get('nonresponsivesitewidth'); ?>;}
	.camera_caption > div{background-color:transparent !important;}
	.camera_caption h1 {font-size: 300%;letter-spacing: -1px;margin: 4px 0px 20px 0px;}
	.camera_caption h2 {font-size: 200%;letter-spacing: 0px;margin: 4px 0px 20px 0px;}
	.camera_caption {font-size: 110%;}
	#search-position .search .inputbox, #search-position .finder .inputbox {max-width: 135px;}
	.selectnav {display:none;}#log-panel .button1{display:none;}
	.category-view .row-fluid .category img{width:100%;}
	<?php endif; ?>



	body {font-size: <?php echo $this->params->get('contentfontsize'); ?>;}
	#site-name-handler, #search-position{height:<?php echo $this->params->get('topheight'); ?>px; }
	#sn-position h1{<?php if ($this->direction == 'rtl') : ?>right<?php else: ?>left<?php endif; ?>:<?php echo $this->params->get('H1TitlePositionX'); ?>px;top:<?php echo $this->params->get('H1TitlePositionY'); ?>px;color:<?php echo $this->params->get('sitenamecolor'); ?>;font-size:<?php echo $this->params->get('sitenamefontsize'); ?>;}
	#sn-position h1 a {color:<?php echo $this->params->get('sitenamecolor'); ?>;}
	#sn-position h2 {<?php if ($this->direction == 'rtl') : ?>right<?php else: ?>left<?php endif; ?>:<?php echo $this->params->get('H2TitlePositionX'); ?>px;top:<?php echo $this->params->get('H2TitlePositionY'); ?>px;color:<?php echo $this->params->get('slogancolor'); ?>;font-size:<?php echo $this->params->get('sloganfontsize'); ?>;}
	ul.columns-2 {width: <?php echo $this->params->get('dropdownhandler2'); ?>px !important;}
	ul.columns-3 {width: <?php echo $this->params->get('dropdownhandler3'); ?>px !important;}
	ul.columns-4 {width: <?php echo $this->params->get('dropdownhandler4'); ?>px !important;}
	ul.columns-5{width: <?php echo $this->params->get('dropdownhandler5'); ?>px !important;}
	<?php if ($this->direction == 'rtl') : ?>
	ul.menu-nav li li:hover ul, ul.menu-nav li li.sfHover ul {
		right: <?php echo $this->params->get("dropdownhandler1") - 1; ?>em;
	}
	<?php endif; ?>
	<?php if( $this->countModules('builtin-slideshow')) : 
	if($this->params->get("cam_turnOn")) : ?>
	.camera_caption { top: <?php echo $this->params->get("cam_caption_y_position"); ?>; }
	.camera_caption div.container div { width: <?php echo $this->params->get("cam_caption_width"); ?>; }
	.camera_pie {
		width: <?php if($this->params->get("cam_pieDiameter")) : echo $this->params->get("cam_pieDiameter"); else : ?>38<?php endif; ?>px;
		height: <?php if($this->params->get("cam_pieDiameter")) : echo $this->params->get("cam_pieDiameter"); else : ?>38<?php endif; ?>px;
	}
	#slideshow-handler { min-height: <?php echo $this->params->get("cam_minHeight"); ?>; }
	<?php endif; endif; ?>
<?php




function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb);
}



?>		
<?php //echo $this->params->get("color1"); ?>
<?php //echo hex2rgb($this->params->get("color47")); ?>

<?php if($this->params->get('usetheme')==false) : ?> 

body {
	background-color: <?php echo $this->params->get("color1"); ?>;
	color: <?php echo $this->params->get("color2"); ?>;
}
.custom-color1{color: <?php echo $this->params->get("color3"); ?>;}
.custom-color2{color: <?php echo $this->params->get("color4"); ?>;}
.custom-color3{color: <?php echo $this->params->get("color5"); ?>;}
.custom-color4{color: <?php echo $this->params->get("color6"); ?>;}
#top-quick-nav {
	background-color: <?php echo $this->params->get("color7"); ?>;
	border-bottom: 1px solid <?php echo $this->params->get("color8"); ?>;
	color: <?php echo $this->params->get("color9"); ?>;
}

#top-quick-nav a {
	color: <?php echo $this->params->get("color10"); ?>;
}

#top-quick-nav a:hover {
	color: <?php echo $this->params->get("color11"); ?>;
}

section#bottom-long {
	background: <?php echo $this->params->get("color12"); ?>;
	border-top: 1px solid <?php echo $this->params->get("color13"); ?>;
	border-bottom: 1px solid <?php echo $this->params->get("color14"); ?>;
}

dt.tabs.open, .latest-view .spacer, .topten-view .spacer, .recent-view .spacer, .featured-view .spacer, .browse-view .spacer {
	background-color: <?php echo $this->params->get("color1"); ?>;
}

#search-position .search .inputbox {
	color: <?php echo $this->params->get("color15"); ?>;
	border: 1px solid <?php echo $this->params->get("color16"); ?>;
}

.is-empty {
	color: <?php echo $this->params->get("color15"); ?> !important;
}

a,a:hover, .moduletable_menu ul.menu li ul li a:hover {
	color: <?php echo $this->params->get("color17"); ?>;
}

.PricesalesPrice {
	color: <?php echo $this->params->get("color18"); ?>;
}

.pr-add, .pr-add-bottom,.featured-view .spacer h3, .latest-view .spacer h3, .topten-view .spacer h3, .recent-view .spacer h3, .related-products-view .spacer h3, .browse-view .product .spacer h2,.featured-view .spacer .product_s_desc, .latest-view .spacer .product_s_desc, .topten-view .spacer .product_s_desc, .recent-view .spacer .product_s_desc, .related-products-view .spacer .product_s_desc, .browse-view .product .spacer .product_s_desc {
	color: <?php echo $this->params->get("color19"); ?>;
}

.category-view .row-fluid .category .spacer h2 a .cat-title {
	color: <?php echo $this->params->get("color20"); ?>;
}

.category .spacer {
	background: <?php echo $this->params->get("color21"); ?>;
}

.category .spacer:hover {
	background: <?php echo $this->params->get("color22"); ?>;
}


.pr-add a, .pr-add-bottom a,.featured-view .spacer h3 a, .latest-view .spacer h3 a, .topten-view .spacer h3 a, .recent-view .spacer h3 a, .related-products-view .spacer h3 a, .browse-view .product .spacer h2 a, .h-pr-title a {
	color: <?php echo $this->params->get("color23"); ?>;
}

.button, button, a.button, dt.tabs.closed:hover, dt.tabs.closed:hover h3 a, .closemenu, .vmproduct.productdetails .spacer:hover .pr-add, .vmproduct.productdetails .spacer:hover .pr-add-bottom, a.product-details, input.addtocart-button, a.ask-a-question, .highlight-button, .vm-button-correct, .cartpanel span.closecart, .vm-pagination ul li a, #LoginForm .btn-group > .dropdown-menu, #LoginForm .btn-group > .dropdown-menu a, a.details {
	color: <?php echo $this->params->get("color24"); ?> !important;
	background-color: <?php echo $this->params->get("color25"); ?> !important;
}

a#menupanel {
	background-color: <?php echo $this->params->get("color26"); ?>;
}

a#menupanel:hover {
	background-color: <?php echo $this->params->get("color27"); ?>;
}

.row-fluid .spacer .pr-img-handler .popout-price .product-details:hover,
.row-fluid .spacer .pr-img-handler .popout-price .show-pop-up-image:hover {
	background-color: <?php echo $this->params->get("color28"); ?> !important;
}

.button:hover, button:hover, a.button:hover, .closemenu:hover, a.product-details:hover, input.addtocart-button:hover, a.ask-a-question:hover, .highlight-button:hover, .vm-button-correct:hover, span.quantity-controls input.quantity-plus:hover, span.quantity-controls input.quantity-minus:hover, .cartpanel span.closecart:hover, .vm-pagination ul li a:hover, .quantity-input,  span.quantity-controls input.quantity-plus, span.quantity-controls input.quantity-minus,
.row-fluid .spacer .pr-img-handler .popout-price .product-details, .row-fluid .spacer .pr-img-handler .popout-price .show-pop-up-image, a.details:hover {
	color: <?php echo $this->params->get("color29"); ?> !important;
	background-color: <?php echo $this->params->get("color30"); ?> !important;
}

.cart-button {
	background-color: <?php echo $this->params->get("color28"); ?>;
}

.total-items > strong {
	color: <?php echo $this->params->get("color31"); ?>;
}

.cart-button:hover {
	background-color: <?php echo $this->params->get("color30"); ?> !important;
}

.rm-line {background-color: <?php echo $this->params->get("color31a"); ?>;}

.cart-button .popover-content {color: <?php echo $this->params->get("color32"); ?>;}

.cart-button .popover {background: <?php echo $this->params->get("color33"); ?>; }
.cart-button .popover.bottom .arrow{border-bottom-color: <?php echo $this->params->get("color34"); ?>;}

#LoginForm .btn-group > .dropdown-menu a:hover {
	background: <?php echo $this->params->get("color35"); ?> !important;
}

#LoginForm .caret {
	border-top-color: <?php echo $this->params->get("color36"); ?> !important;
}


.moduletable, div.panel2, .category_description, fieldset.phrases, fieldset.word, fieldset.only, .search .form-limit, .cart-view, .item-page,.categories-list,.blog,.blog-featured,.category-list,.archive, .is-empty, .show-both  {
	background: <?php echo $this->params->get("color37"); ?>;
	border:1px solid <?php echo $this->params->get("color38"); ?>;
	color: <?php echo $this->params->get("color39"); ?>;
}

div.spacer, li.spacer, .productdetails-view {
	background: <?php echo $this->params->get("color40"); ?>;
	border:1px solid <?php echo $this->params->get("color41"); ?>;
	color: <?php echo $this->params->get("color42"); ?>;
}

.gr-cover {
background: -moz-linear-gradient(left,  rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,0) 0%, rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,1) 100%);
background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,0)), color-stop(100%,rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,1)));
background: -webkit-linear-gradient(left,  rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,0) 0%,rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,1) 100%);
background: -o-linear-gradient(left,  rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,0) 0%,rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,1) 100%);
background: -ms-linear-gradient(left,  rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,0) 0%,rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,1) 100%);
background: linear-gradient(to right,  rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,0) 0%,rgba(<?php echo hex2rgb($this->params->get("color40")); ?>,1) 100%);
}

.moduletable a, div.panel2 a, .category_description a, .productdetails-view a {
	color: <?php echo $this->params->get("color43"); ?>;
}

#nav-line {
	background-color: <?php echo $this->params->get("color44"); ?>;
}

.camera_wrap .camera_pag .camera_pag_ul li {
background: <?php echo $this->params->get("color45"); ?>;
}

.camera_prev > span,.camera_next > span,.camera_commands > .camera_play,.camera_commands > .camera_stop,.camera_prevThumbs div,.camera_nextThumbs div {
	background-color: <?php echo $this->params->get("color46"); ?>;
}

.camera_wrap .camera_pag .camera_pag_ul li > span, .product-sl-handler ol li,
.camera_prev:hover > span,.camera_next:hover > span,.camera_commands:hover > .camera_play,.camera_commands:hover > .camera_stop {
	background-color: <?php echo $this->params->get("color47"); ?>;
}

.camera_wrap .camera_pag .camera_pag_ul li.cameracurrent > span, .camera_wrap .camera_pag .camera_pag_ul li:hover > span,
.product-sl-handler ol li:hover, .product-sl-handler ol li.current {
	background-color: <?php echo $this->params->get("color48"); ?>;
}

.camera_thumbs_cont ul li > img {
	border: 1px solid <?php echo $this->params->get("color49"); ?> !important;
}

.camera_caption {
	color: <?php echo $this->params->get("color50"); ?>;
}

@media (max-width: 767px) { 
	.camera_caption > div {
		background-color: rgba(<?php echo hex2rgb($this->params->get("color51")); ?>,0.7);
	}
}

.camera_caption .button {
	background-color: <?php echo $this->params->get("color52"); ?> !important;
}

.camera_caption .button:hover {
	background-color: <?php echo $this->params->get("color53"); ?> !important;
}

#menu {
	background: <?php echo $this->params->get("color54"); ?>;
}

#menu .menu-nav li a, #menu .menu-nav ul a, #menu .menu-nav ul ul a, #menu ul.menu-nav li a small {
	color: <?php echo $this->params->get("color55"); ?>;
}

.dk_options a,.cartpanel a {
	color: <?php echo $this->params->get("color56"); ?>;
}

#menu .menu-nav ul li {
	border-top: 1px solid <?php echo $this->params->get("color57"); ?>;
}

#menu .menu-nav ul li a {
	color: <?php echo $this->params->get("color58"); ?>;
}
.dk_options_inner a, .panel1, .panel1 a {
	color: <?php echo $this->params->get("color59"); ?> !important;
}
.dk_options_inner a:hover, .dk_option_current a {
	background-color: <?php echo $this->params->get("color60"); ?>;
	color: <?php echo $this->params->get("color61"); ?> !important;
}

#menu .menu-nav ul li a:hover, .menu-nav ul li.sfHover > a {
	color: <?php echo $this->params->get("color62"); ?> !important;
}

#menu .menu-nav ul li a .sf-sub-indicator {
	border-left-color: <?php echo $this->params->get("color62"); ?> !important;
}

#menu .menu-nav > li > a:hover, #menu .menu-nav > li.sfHover > a, #menu .menu-nav > li.active > a, .menupanel ul.selectnav li a:hover, a#menupanel:hover {
	background-color: <?php echo $this->params->get("color64"); ?>;
	color: <?php echo $this->params->get("color65"); ?> !important;
}

#menu .menu-nav ul li a:hover .sf-sub-indicator,
#menu .menu-nav ul li.sfHover > a .sf-sub-indicator  {
	border-left-color: <?php echo $this->params->get("color62"); ?> !important;
}

#menu .menu-nav li ul, #menu .menu-nav li ul li ul, #nav ol, #nav ul, #nav ol ol, #nav ul ul,
.dk_options, .panel1, ul#social-links {
	background-color: <?php echo $this->params->get("color66"); ?> !important;
}

#menu .menu-nav > li > a .sf-sub-indicator {
	border: 2px solid <?php echo $this->params->get("color67"); ?> !important;
	background-color: <?php echo $this->params->get("color68"); ?>;
}

thead th, table th, tbody th, tbody td {
	border-top: 1px solid <?php echo $this->params->get("color69"); ?>;
}
tbody th, tbody td, h2 .contact-name, .search-results dt.result-title{
	border-bottom: 1px solid <?php echo $this->params->get("color69"); ?>;
}

.popout-price .PricesalesPrice {
	background-color: <?php echo $this->params->get("color70"); ?>;
	color: <?php echo $this->params->get("color71"); ?>;
}

.product-price {
	color: <?php echo $this->params->get("color72"); ?>;
}

.moduletable_menu > h3, .moduletable_menu > h3 .h-cl {
	color: <?php echo $this->params->get("color73"); ?>;
	background: <?php echo $this->params->get("color74"); ?>;
}

.moduletable_menu .module-content {
	background: <?php echo $this->params->get("color75"); ?>;
	border: 1px solid <?php echo $this->params->get("color76"); ?>;
}

.moduletable_menu ul.menu li, .VMmenu li {
	border-bottom: 1px solid <?php echo $this->params->get("color77"); ?>;
}

.moduletable_menu ul.menu li a, .latestnews_menu li a, .VMmenu li div a {
	color: <?php echo $this->params->get("color78"); ?>;
}

.VMmenu ul li div a:hover {
	color: <?php echo $this->params->get("color79"); ?> !important;
}
.moduletable_menu ul.menu li a:hover, ul.latestnews_menu li a:hover, .VMmenu li div a:hover {
	color: <?php echo $this->params->get("color80"); ?>;
}

.moduletable_style1 {
	background-color: <?php echo $this->params->get("color81"); ?>;
	color: <?php echo $this->params->get("color82"); ?>;
}

.moduletable_style1 a {
	color: <?php echo $this->params->get("color83"); ?> !important;
}

.moduletable_style1:hover {
	background-color: <?php echo $this->params->get("color84"); ?>;
	color: <?php echo $this->params->get("color85"); ?>;
}

.moduletable_style1:hover a {
	color: <?php echo $this->params->get("color86"); ?> !important;
}

.moduletable_motion .custom_motion {
	background-color: <?php echo $this->params->get("color87"); ?>;
}

.h-cl {
	color: <?php echo $this->params->get("color88"); ?>;
}

.mod-color1 {
	background-color: <?php echo $this->params->get("color89"); ?>;
	color: <?php echo $this->params->get("color90"); ?>;
}

.mod-color2 {
	background-color: <?php echo $this->params->get("color91"); ?>;
	color: <?php echo $this->params->get("color92"); ?>;
}

#bot-modules-2 {
	border-bottom: 8px solid <?php echo $this->params->get("color93"); ?>;
}

#footer {
	background-color: <?php echo $this->params->get("color94"); ?>;
	color: <?php echo $this->params->get("color95"); ?>;
}

#footer a {
	color: <?php echo $this->params->get("color96"); ?>;
}
#footer a:hover, #footer h3 {
	color: <?php echo $this->params->get("color97"); ?>;
}
<?php endif; ?>
</style>






<?php

if( $this->countModules('top-1 or top-2 or top-3 or top-4 or top-5 or top-6')) :
	if( $this->countModules('top-1') ) $a[0] = 0;
	if( $this->countModules('top-2') ) $a[1] = 1;
	if( $this->countModules('top-3') ) $a[2] = 2;
	if( $this->countModules('top-4') ) $a[3] = 3;
	if( $this->countModules('top-5') ) $a[4] = 4;
	if( $this->countModules('top-6') ) $a[5] = 5; 
	$topmodules1 = count($a); 
	if ($topmodules1 == 1) $tm1class = "span12";
	if ($topmodules1 == 2) $tm1class = "span6";
	if ($topmodules1 == 3) $tm1class = "span4";
	if ($topmodules1 == 4) $tm1class = "span3";
	if ($topmodules1 == 5) { $tm1class = "span2"; $tm1class5w = "17.9%"; };
	if ($topmodules1 == 6) $tm1class = "span2";
	endif; 
	

	if( $this->countModules('top-7 or top-8 or top-9 or top-10 or top-11 or top-12')) :
	if( $this->countModules('top-7') ) $b[0] = 0;
	if( $this->countModules('top-8') ) $b[1] = 1;
	if( $this->countModules('top-9') ) $b[2] = 2;
	if( $this->countModules('top-10') ) $b[3] = 3;
	if( $this->countModules('top-11') ) $b[4] = 4;
	if( $this->countModules('top-12') ) $b[5] = 5; 
	$topmodules2 = count($b); 
	if ($topmodules2 == 1) $tm2class = "span12";
	if ($topmodules2 == 2) $tm2class = "span6";
	if ($topmodules2 == 3) $tm2class = "span4";
	if ($topmodules2 == 4) $tm2class = "span3";
	if ($topmodules2 == 5) { $tm2class = "span2"; $tm2class5w = "17.9%"; };
	if ($topmodules2 == 6) $tm2class = "span2";
	endif; 
	
	if( $this->countModules('bottom-1 or bottom-2 or bottom-3 or bottom-4 or bottom-5 or bottom-6')) :
	if( $this->countModules('bottom-1') ) $c[0] = 0; 
	if( $this->countModules('bottom-2') ) $c[1] = 1; 
	if( $this->countModules('bottom-3') ) $c[2] = 2; 
	if( $this->countModules('bottom-4') ) $c[3] = 3; 
	if( $this->countModules('bottom-5') ) $c[4] = 4; 
	if( $this->countModules('bottom-6') ) $c[5] = 5; 
	$botmodules = count($c); 
	if ($botmodules == 1) $bmclass = "span12";
	if ($botmodules == 2) $bmclass = "span6";
	if ($botmodules == 3) $bmclass = "span4";
	if ($botmodules == 4) $bmclass = "span3";
	if ($botmodules == 5) { $bmclass = "span2"; $bmclass5w = "17.7%"; };
	if ($botmodules == 6) $bmclass = "span2";
	endif; 
	
	if( $this->countModules('bottom-7 or bottom-8 or bottom-9 or bottom-10 or bottom-11 or bottom-12')) :
	if( $this->countModules('bottom-7') ) $cb[0] = 0; 
	if( $this->countModules('bottom-8') ) $cb[1] = 1; 
	if( $this->countModules('bottom-9') ) $cb[2] = 2; 
	if( $this->countModules('bottom-10') ) $cb[3] = 3; 
	if( $this->countModules('bottom-11') ) $cb[4] = 4; 
	if( $this->countModules('bottom-12') ) $cb[5] = 5; 
	$botmodules2 = count($cb); 
	if ($botmodules2 == 1) $bm2class = "span12";
	if ($botmodules2 == 2) $bm2class = "span6";
	if ($botmodules2 == 3) $bm2class = "span4";
	if ($botmodules2 == 4) $bm2class = "span3";
	if ($botmodules2 == 5) { $bm2class = "span2"; $bm2class5w = "17.7%"; };
	if ($botmodules2 == 6) $bm2class = "span2";
	endif; 
	
	if( $this->countModules('top-a or top-b or top-c or top-d')) :
	if( $this->countModules('top-a') ) $d[0] = 0; 
	if( $this->countModules('top-b') ) $d[1] = 1; 
	if( $this->countModules('top-c') ) $d[2] = 2; 
	if( $this->countModules('top-d') ) $d[3] = 3; 
	$topamodules = count($d); 
	if ($topamodules == 1) $tpaclass = "span12";
	if ($topamodules == 2) $tpaclass = "span6";
	if ($topamodules == 3) $tpaclass = "span4";
	if ($topamodules == 4) $tpaclass = "span3";
	endif; 
	
	if( $this->countModules('bottom-a or bottom-b or bottom-c or bottom-d')) :
	if( $this->countModules('bottom-a') ) $e[0] = 0; 
	if( $this->countModules('bottom-b') ) $e[1] = 1; 
	if( $this->countModules('bottom-c') ) $e[2] = 2; 
	if( $this->countModules('bottom-d') ) $e[3] = 3; 
	$bottomamodules = count($e); 
	if ($bottomamodules == 1) $bmaclass = "span12";
	if ($bottomamodules == 2) $bmaclass = "span6";
	if ($bottomamodules == 3) $bmaclass = "span4";
	if ($bottomamodules == 4) $bmaclass = "span3";
	endif; 
	
	if( $this->countModules('top-right-1 or top-right-2 or position-6 or bottom-right-1 or bottom-right-2') && $this->countModules('top-left-1 or top-left-2 or position-7 or bottom-left-1 or bottom-left-2')  ) : $mcols = 'span6'; 
	elseif( $this->countModules('top-right-1 or top-right-2 or position-6 or bottom-right-1 or bottom-right-2') && !$this->countModules('top-left-1 or top-left-2 or position-7 or bottom-left-1 or bottom-left-2')  ) : $mcols = 'span9'; 
	elseif( !$this->countModules('top-right-1 or top-right-2 or position-6 or bottom-right-1 or bottom-right-2') && $this->countModules('top-left-1 or top-left-2 or position-7 or bottom-left-1 or bottom-left-2')  ) : $mcols = 'span9'; else : $mcols = 'span12'; endif; ?>
	<?php if ($this->direction == 'rtl') : ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/bootstrap-rtl.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template_rtl.css" media="screen" />
	
	<?php if($this->params->get("useresponsivemode") == true ) : ?>
	<style type="text/css">
	@media (min-width: 1200px) {
		.row-fluid [class*="span"] {
			margin-right:2.564102564102564%;
		}
	}

	@media (min-width: 768px) and (max-width: 979px) {
		.row-fluid [class*="span"] {
			margin-right:2.564102564102564%;
		}
	}
	</style>
	<?php endif; endif; ?> 
<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700&subset=cyrillic,latin,cyrillic-ext' rel='stylesheet' type='text/css'>




<?php /*-- Facebook --*/?>
	<meta property="fb:admins" content="100002135514048"/>
	<meta property="fb:app_id" content="312291229874410"/>    
	
<?php /*-- Facebook Pixel Code --*/?>
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '486848201785646');
	  fbq('track', 'PageView');
	</script>

	<!-- Carrot quest BEGIN -->
	<script type="text/javascript">
	!function(){function t(t,e){return function(){window.carrotquestasync.push(t,arguments)}}if("undefined"==typeof carrotquest){var e=document.createElement("script");e.type="text/javascript",e.async=!0,e.src="//cdn.carrotquest.app/api.min.js",document.getElementsByTagName("head")[0].appendChild(e),window.carrotquest={},window.carrotquestasync=[],carrotquest.settings={};for(var n=["connect","track","identify","auth","oth","onReady","addCallback","removeCallback","trackMessageInteraction"],a=0;a<n.length;a++)carrotquest[n[a]]=t(n[a])}}(),carrotquest.connect("19940-f2848ac4ca1eef1a73a9b61165");
	</script>
	<!-- Carrot quest END -->	
	
</head>
<body>
<?php /*-- Facebook Pixel Code --*/ ?>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=486848201785646&ev=PageView&noscript=1"
	/></noscript>
<?php /*-- End Facebook Pixel Code --*/?>
	
<?php /* -- Приложения FB -- */ ?> 					
	<?php  /* проверка com_virtuemart */
		$option = JRequest::getVar('option', null);  
		?>						
		<?php if ( $option == 'com_virtuemart' ) : ?>			
		<div id="fb-root"></div>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v8.0&appId=312291229874410&autoLogAppEvents=1" nonce="GO5LZ8K2"></script>	
	
	<?php endif; ?>
<?php /* -- END Приложения FB -- */ ?> 	
	


<?php /*-- Google Tag Manager (noscript) --*/?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T62TJ48"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php /*-- End Google Tag Manager (noscript) --*/?>

<!-- Global site tag (gtag.js) - Google Analytics -->



<?php //include_once("analyticstracking.php") ?>


<header id="top-handler">
	
	
	<?php if( $this->countModules('banner-top-header') ) : ?>
		<div class="container">
			<jdoc:include type="modules" name="banner-top-header" style="none" />
			<div class="clear-sep"></div>
		</div>
	<?php endif; ?>
	
	
	
	<div class="container">	
		<div id="top"> 
			<div class="row-fluid">
				<div id="top0-1" class="span5">
					<div id="site-top0-1-menu">
						<jdoc:include type="modules" name="top-menu" style="none" />            	
					</div>
					<div class="clear"></div>
					<div class="row-fluid">
						<div id="logo-wr" class="span7">
							<div id="sn-position">                        
								<div class="logo">
								<?php /* Проверка HOME */?>	
								<?php
									
									$menu = JFactory::getApplication()->getMenu();
                                   //  $menu = & JSite::getMenu();
									if ($menu->getActive() == $menu->getDefault()) { ?>
									<img alt="Интернет-магазин «Мой СВЕТ»" src="/images/logo2.png">
								<?php /* END home */?>	

								<?php } else { ?>
								<?php /* Другие страницы */?>
									<a title="Интернет-магазин «Мой СВЕТ»" href="/">
										<img alt="Интернет-магазин «Мой СВЕТ»" src="/images/logo2.png">
									</a> 
								<?php /* END Другие страницы */?>	    
								<?php } ?>                     
								</div>                                                
							</div><!-- /#sn-position-->
						</div>
						<div id="tel_top-position" class="span5">
							<?php if( $this->countModules('header-top-tel')) : ?>									
								<jdoc:include type="modules" name="header-top-tel" style="vmdefault" />
							<?php endif; ?>
						</div>
																
					</div>
				</div>
				<div id="top0-2" class="span4">
					<div class="banner-header">
						<a class="stepslink" href="index.php?option=com_content&amp;view=article&amp;id=99&amp;Itemid=2924" title="Подобрать люстру за 4 шага">
							<div class="stepslink-wr">
								Подобрать люстру за<br/><span>4 шага</span>							
							</div>				
						</a>
					</div> 
				</div>
				<div id="top0-3" class="span3">
					<div class="row-fluid">
					<?php 
					if( $this->countModules('cart')) : ?>
						<div id="cart-position" class="span12">
							<div class="wrap_top_bloc_search_cart_text">                	
								<jdoc:include type="modules" name="cart" />                
							</div>                                          
						</div>
					<?php endif; ?>	
					</div>	
					<div class="row-fluid">
					<?php if( $this->countModules('position-0')) : ?>
						<div id="search-position2" class="span12">
							<div class="wrap_top_bloc_search_menu">
                                <div class="wrap_top_bloc_search_menu-wrp" style="float:right">
                                    <jdoc:include type="modules" name="position-0" />
                                </div>
								                
							</div>                                          
						</div>
					<?php endif; ?>
					</div>
				</div>								
			</div>
		</div>
	</div>
</header>
<div class="nav-line-menu">
	<div class="container navline_wrap">
		<div class="row-fluid">
			<div id="menu" class="span12 menu-space">
				<jdoc:include type="modules" name="position-1" />
			</div>
		</div>
	</div>
</div>
<?php if( $this->countModules('position-2')) : ?>
<div id="nav-line">
	<div class="container nav_wrap">
		<div class="row-fluid">
			<div class="span12" id="brcr"><jdoc:include type="modules" name="position-2" /></div>
		</div>
	</div>
</div>
<?php endif; ?>
<div class="container main-bg" id="main-handler">

	<?php if( $this->countModules('top-1 or top-2 or top-3 or top-4 or top-5 or top-6')) : ?>
	<section id="tab-modules">
		<div id="tab-modules-handler" class="row-fluid">
			<?php if( $this->countModules('top-1')) : ?><div class="<?php echo $tm1class; ?>" style="<?php if ($topmodules1 == 5) {echo "width:".$tm1class5w;} ?>"><jdoc:include type="modules" name="top-1" style="vmdefault" /></div><?php endif; ?>
			<?php if( $this->countModules('top-2')) : ?><div class="<?php echo $tm1class; ?>" style="<?php if ($topmodules1 == 5) {echo "width:".$tm1class5w;} ?>"><jdoc:include type="modules" name="top-2" style="vmdefault" /></div><?php endif; ?>
			<?php if( $this->countModules('top-3')) : ?><div class="<?php echo $tm1class; ?>" style="<?php if ($topmodules1 == 5) {echo "width:".$tm1class5w;} ?>"><jdoc:include type="modules" name="top-3" style="vmdefault" /></div><?php endif; ?>
			<?php if( $this->countModules('top-4')) : ?><div class="<?php echo $tm1class; ?>" style="<?php if ($topmodules1 == 5) {echo "width:".$tm1class5w;} ?>"><jdoc:include type="modules" name="top-4" style="vmdefault" /></div><?php endif; ?>
			<?php if( $this->countModules('top-5')) : ?><div class="<?php echo $tm1class; ?>" style="<?php if ($topmodules1 == 5) {echo "width:".$tm1class5w;} ?>"><jdoc:include type="modules" name="top-5" style="vmdefault" /></div><?php endif; ?>
			<?php if( $this->countModules('top-6')) : ?><div class="<?php echo $tm1class; ?>" style="<?php if ($topmodules1 == 5) {echo "width:".$tm1class5w;} ?>"><jdoc:include type="modules" name="top-6" style="vmdefault" /></div><?php endif; ?>
		</div>
	</section>
	<?php endif; ?>
	

	<?php if( $this->countModules('banner-1170') ) : ?>
		<div class="container">
			<jdoc:include type="modules" name="banner-1170" style="none" />
			<div class="clear-sep"></div>
		</div>
	<?php endif; ?> 	

	<div class="row-fluid" id="slideshow-header">
	<?php if( $this->countModules('header-left') ) : ?>
		<div class="span3">
        	<jdoc:include type="modules" name="header-left" style="vmdefault" />
        </div>
	<?php endif; ?>

		<?php if( $this->countModules('mod-home-1 or mod-home-2 or mod-home-3 or mod-home-4 or mod-home-5')) : ?>
			<div id="content-mod-home" class="<?php if( $this->countModules('header-left and header-right') ) : ?>span6<?php elseif( $this->countModules('header-left or header-right2') ): ?>span8<?php else: ?>span12<?php endif; ?>">
				<div class="containerHome wrap-mod-home">
					<jdoc:include type="modules" name="mod-home-1" style="vmdefault" />
					<jdoc:include type="modules" name="mod-home-2" style="vmdefault" />
					<jdoc:include type="modules" name="mod-home-3" style="vmdefault" />
					<jdoc:include type="modules" name="mod-home-4" style="vmdefault" />
					<jdoc:include type="modules" name="mod-home-5" style="vmdefault" />
				</div>	
			</div>  
		<?php endif; ?> 
		
		<?php if( $this->countModules('header-right2') ) : ?>
			<div class="span4"><jdoc:include type="modules" name="header-right2" style="vmdefault" /></div>
		<?php endif; ?>
	
		<?php if( $this->countModules('builtin-slideshow or slideshow') ) : ?>
		<div id="slideshow-handler-bg" class="<?php if( $this->countModules('header-left and header-right') ) : ?>span6<?php elseif( $this->countModules('header-left or header-right') ): ?>span9<?php else: ?>span12<?php endif; ?>">
			
			
			<div id="slideshow-handler"> 
				<?php if( $this->countModules('builtin-slideshow') ) : ?>
				<?php
				$count_slides = JDocumentHTML::countModules('builtin-slideshow');
				$module = JModuleHelper::getModules('builtin-slideshow');
				$moduleParams = new JRegistry();
				echo "<div class=\"camera_wrap\" id=\"ph-camera-slideshow\">"; 
				for($sld_a=0;$sld_a<$count_slides;$sld_a++) { 
					$moduleParams->loadString($module[$sld_a]->params);
					$bgimage[$sld_a] = $moduleParams->get('backgroundimage', 'defaultValue'); 
					$caption_effect[$sld_a] = $moduleParams->get('moduleclass_sfx', 'defaultValue'); 
				?>
				<div data-thumb="<?php if($bgimage[$sld_a] == "defaultValue") : echo $this->baseurl."/templates/".$this->template."/images/slideshow/no-image.png"; else : echo $this->baseurl."/".$bgimage[$sld_a]; endif; ?>" data-src="<?php if($bgimage[$sld_a] == "defaultValue") : echo $this->baseurl."/templates/".$this->template."/images/slideshow/no-image.png"; else : echo $this->baseurl."/".$bgimage[$sld_a]; endif; ?>">
					<div class="camera_caption <?php if(($caption_effect[$sld_a] == "defaultValue")) : ?>fadeIn<?php else: echo $caption_effect[$sld_a]; endif; ?>" style="<?php if(empty($module[$sld_a]->content)) : ?>display:none !important;visibility: hidden !important; opacity: 0 !important;<?php endif; ?>">
						<div><?php echo $module[$sld_a]->content; ?></div>
					</div>
				</div>
				<?php } echo "</div>"; // End of camera_wrap ?> 
				<?php elseif( $this->countModules('slideshow') ) : ?>
				<div class="sl-3rd-parties">
					<jdoc:include type="modules" name="slideshow" />
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>		
		
		<?php if( $this->countModules('header-right') ) : ?>
			<div class="span3"><jdoc:include type="modules" name="header-right" style="vmdefault" /></div>
		<?php endif; ?>
	</div>

	<div id="content-handler">
	
		<?php if( $this->countModules('top-7 or top-8 or top-9 or top-10 or top-11 or top-12')) : ?>
		<div id="top-modules">
			<div class="row-fluid">
				<?php if( $this->countModules('top-7')) : ?><div class="<?php echo $tm2class; ?>" style="<?php if ($topmodules2 == 5) {echo "width:".$tm2class5w;} ?>"><jdoc:include type="modules" name="top-7" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('top-8')) : ?><div class="<?php echo $tm2class; ?>" style="<?php if ($topmodules2 == 5) {echo "width:".$tm2class5w;} ?>"><jdoc:include type="modules" name="top-8" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('top-9')) : ?><div class="<?php echo $tm2class; ?>" style="<?php if ($topmodules2 == 5) {echo "width:".$tm2class5w;} ?>"><jdoc:include type="modules" name="top-9" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('top-10')) : ?><div class="<?php echo $tm2class; ?>" style="<?php if ($topmodules2 == 5) {echo "width:".$tm2class5w;} ?>"><jdoc:include type="modules" name="top-10" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('top-11')) : ?><div class="<?php echo $tm2class; ?>" style="<?php if ($topmodules2 == 5) {echo "width:".$tm2class5w;} ?>"><jdoc:include type="modules" name="top-11" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('top-12')) : ?><div class="<?php echo $tm2class; ?>" style="<?php if ($topmodules2 == 5) {echo "width:".$tm2class5w;} ?>"><jdoc:include type="modules" name="top-12" style="vmdefault" /></div><?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
					
		<div id="tmp-container">
				
			<?php if( $this->countModules('position-3')) : ?>
			<div class="row-fluid">
				<div class="span12"><div id="newsflash-position"><jdoc:include type="modules" name="position-3" style="vmdefault" /></div></div>
			</div>
			<?php endif; ?>
			<div id="main-content-handler">
				<div class="row-fluid">
					<?php $is_details = (JFactory::getApplication()->input->get('view') == 'productdetails')?>
					<?php if( !$is_details
							&& $this->countModules('top-left-1 or top-left-2 or position-7 or bottom-left-1 or bottom-left-2')
						) : ?>
					<div class="span3">
						<jdoc:include type="modules" name="top-left-1" style="vmdefault" />
						<jdoc:include type="modules" name="top-left-2" style="vmdefault" />
						<jdoc:include type="modules" name="position-7" style="vmdefault" />
						<jdoc:include type="modules" name="bottom-left-1" style="vmdefault" />
						<jdoc:include type="modules" name="bottom-left-2" style="vmdefault" />
					</div>
					<?php endif; ?>
					
                   <div class="<?=$is_details?'span12':$mcols?>">		
						<?php if( $this->countModules('top-long')) : ?>
							<jdoc:include type="modules" name="top-long" style="vmdefault" />
							<div class="clear-sep"></div>
						<?php endif; ?>
	
	     
                    
                    
    	<?php if( $this->countModules('banner-slid') ) : ?>
        <div class="span12">
        	<jdoc:include type="modules" name="banner-slid" style="none" />
            <div class="clear-sep"></div>
        </div>
        <?php endif; ?>                     
											
						<?php if( $this->countModules('top-a or top-b or top-c or top-d')) : ?>
						<div id="top-content-modules">
							<div class="row-fluid">
								<?php if( $this->countModules('top-a')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-a" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-b')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-b" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-c')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-c" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-d')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-d" style="vmdefault" /></div><?php endif; ?>
							</div>
						</div>
						<?php endif; ?>
                        

						<?php if( $this->countModules('top-a1 or top-b1 or top-c1 or top-d1')) : ?>
						<div id="top-content-modules2">
							<div class="row-fluid">
								<?php if( $this->countModules('top-a1')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-a1" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-b1')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-b1" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-c1')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-c1" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-d1')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-d1" style="vmdefault" /></div><?php endif; ?>
							</div>
						</div>
						<?php endif; ?>
                                                
                        
						<?php if( $this->countModules('top-a2 or top-b2 or top-c2 or top-d2')) : ?>
						<div id="top-content-modules3">
							<div class="row-fluid">
								<?php if( $this->countModules('top-a2')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-a2" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-b2')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-b2" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-c2')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-c2" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-d2')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-d2" style="vmdefault" /></div><?php endif; ?>
							</div>
						</div>
						<?php endif; ?>    
                        
                        
						<?php if( $this->countModules('top-a3 or top-b3 or top-c3 or top-d3')) : ?>
						<div id="top-content-modules4">
							<div class="row-fluid">
								<?php if( $this->countModules('top-a3')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-a3" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-b3')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-b3" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-c3')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-c3" style="vmdefault" /></div><?php endif; ?>
								<?php if( $this->countModules('top-d3')) : ?><div class="<?php echo $tpaclass; ?>"><jdoc:include type="modules" name="top-d3" style="vmdefault" /></div><?php endif; ?>
							</div>
						</div>
						<?php endif; ?>                                             
                        
                        
						<div class="tmp-content-area">
                        
						
						<?php if(JFactory::getApplication()->getMessageQueue()) : ?>
						<div class="navbar-fixed-top" id="top-com-handler">
							<jdoc:include type="message" />
						</div>
						<?php endif; ?>
						<jdoc:include type="component" />
						</div>
                        
                        
						<?php if( $this->countModules('bottom-a or bottom-b or bottom-c or bottom-d')) : ?>
                            <div id="bottom-content-modules">
                                <div class="row-fluid">

                                    <?php if ($this->countModules('bottom-a')) : ?>
                                    <div class="<?php echo $bmaclass; ?>">
                                            <jdoc:include type="modules" name="bottom-a" style="vmdefault"/>
                                        </div><?php endif; ?>

                                    <?php if ($this->countModules('bottom-b')) : ?>
                                        <div class="<?php echo $bmaclass; ?>">
                                            <jdoc:include type="modules" name="bottom-b" style="vmdefault"/>
                                        </div><?php endif; ?>

                                    <?php if ($this->countModules('bottom-c')) : ?>
                                        <div class="<?php echo $bmaclass; ?>">
                                            <jdoc:include type="modules" name="bottom-c" style="vmdefault"/>
                                        </div><?php endif; ?>

                                    <?php if ($this->countModules('bottom-d')) : ?>
                                        <div class="<?php echo $bmaclass; ?>">
                                            <jdoc:include type="modules" name="bottom-d" style="vmdefault"/>
                                        </div><?php endif; ?>

                                </div>
                            </div>
						<?php endif; ?>
					</div>
					<?php if( $this->countModules('top-right-1 or top-right-2 or position-6 or bottom-right-1 or bottom-right-2')) : ?>
					<div class="span3">
						<jdoc:include type="modules" name="top-right-1" style="vmdefault" />
						<jdoc:include type="modules" name="top-right-2" style="vmdefault" />
						<jdoc:include type="modules" name="position-6" style="vmdefault" />
						<jdoc:include type="modules" name="bottom-right-1" style="vmdefault" />
						<jdoc:include type="modules" name="bottom-right-2" style="vmdefault" />
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if( $this->countModules('bottom-long')) : ?>
<section id="bottom-long">
	<div class="container">
		<div class="row-fluid">
			<div class="span12">
				<jdoc:include type="modules" name="bottom-long" style="vmdefault" />
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<section id="bottom-bg">
	<div class="container">
		<?php if( $this->countModules('bottom-1 or bottom-2 or bottom-3 or bottom-4 or bottom-5 or bottom-6')) : ?>
		<div id="bot-modules">
			<div class="row-fluid">
				<?php if( $this->countModules('bottom-1')) : ?><div class="<?php echo $bmclass; ?>" style="<?php if ($botmodules == 5) {echo "width:".$bmclass5w;} ?>"><jdoc:include type="modules" name="bottom-1" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-2')) : ?><div class="<?php echo $bmclass; ?>" style="<?php if ($botmodules == 5) {echo "width:".$bmclass5w;} ?>"><jdoc:include type="modules" name="bottom-2" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-3')) : ?><div class="<?php echo $bmclass; ?>" style="<?php if ($botmodules == 5) {echo "width:".$bmclass5w;} ?>"><jdoc:include type="modules" name="bottom-3" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-4')) : ?><div class="<?php echo $bmclass; ?>" style="<?php if ($botmodules == 5) {echo "width:".$bmclass5w;} ?>"><jdoc:include type="modules" name="bottom-4" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-5')) : ?><div class="<?php echo $bmclass; ?>" style="<?php if ($botmodules == 5) {echo "width:".$bmclass5w;} ?>"><jdoc:include type="modules" name="bottom-5" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-6')) : ?><div class="<?php echo $bmclass; ?>" style="<?php if ($botmodules == 5) {echo "width:".$bmclass5w;} ?>"><jdoc:include type="modules" name="bottom-6" style="vmdefault" /></div><?php endif; ?>
			</div>
		</div>
		<div class="clear"></div>
		<?php endif; ?>
	</div>
</section>
<?php if( $this->countModules('footer or footer-left or footer-right')) : ?>
<footer id="footer">
	<div class="container">
	
		<?php if( $this->countModules('bottom-7 or bottom-8 or bottom-9 or bottom-10 or bottom-11 or bottom-12')) : ?>
		<div id="bot-modules-2">
			<div class="row-fluid">
				<?php if( $this->countModules('bottom-7')) : ?><div class="<?php echo $bm2class; ?>" style="<?php if ($botmodules2 == 5) {echo "width:".$bm2class5w;} ?>"><jdoc:include type="modules" name="bottom-7" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-8')) : ?><div class="<?php echo $bm2class; ?>" style="<?php if ($botmodules2 == 5) {echo "width:".$bm2class5w;} ?>"><jdoc:include type="modules" name="bottom-8" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-9')) : ?><div class="<?php echo $bm2class; ?>" style="<?php if ($botmodules2 == 5) {echo "width:".$bm2class5w;} ?>"><jdoc:include type="modules" name="bottom-9" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-10')) : ?><div class="<?php echo $bm2class; ?>" style="<?php if ($botmodules2 == 5) {echo "width:".$bm2class5w;} ?>"><jdoc:include type="modules" name="bottom-10" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-11')) : ?><div class="<?php echo $bm2class; ?>" style="<?php if ($botmodules2 == 5) {echo "width:".$bm2class5w;} ?>"><jdoc:include type="modules" name="bottom-11" style="vmdefault" /></div><?php endif; ?>
				<?php if( $this->countModules('bottom-12')) : ?><div class="<?php echo $bm2class; ?>" style="<?php if ($botmodules2 == 5) {echo "width:".$bm2class5w;} ?>"><jdoc:include type="modules" name="bottom-12" style="vmdefault" /></div><?php endif; ?>
			</div>
		</div>
		<div class="clear"> </div>
		<?php endif; ?>
	
		<div id="footer-line" class="row-fluid">
			<?php if( $this->countModules('footer')) : ?>
			<div class="span12"><jdoc:include type="modules" name="footer" /></div>
			<?php endif; ?>           
            
			<?php if( $this->countModules('footer-left or footer-right')) : ?>
			<div id="foo-left-right">
				<?php if( $this->countModules('footer-left')) : ?>
				<div class="<?php if( $this->countModules('footer-left and footer-right')) : ?>span8<?php else: ?>span12<?php endif;?>">
					<jdoc:include type="modules" name="footer-left" />
				</div><?php endif; ?>
				<?php if( $this->countModules('footer-right')) : ?>
				<div class="<?php if( $this->countModules('footer-left and footer-right')) : ?>span4<?php else: ?>span12<?php endif;?>">
					<jdoc:include type="modules" name="footer-right" />
				</div><?php endif; ?>
				<div class="clear"> </div>
			</div>
			<?php endif; ?>

		</div>
		
		<?php if( $this->countModules('footer-admenu')) : ?>
		<div id="footer-admin-menu" class="row-fluid">
			<div class="span12"><jdoc:include type="modules" name="footer-admenu" /></div>
		</div>	
		<?php endif; ?>
		
	</div>
</footer>
<?php endif; ?>
<?php /* ---------- Заказать звонок --------- */?>
<div id="zvonok_feedback" class="rsform_feedback nomobile">
	<jdoc:include type="modules" name="zakaz-zvonok" />
</div>
<?php if($this->params->get("bodybackgroundimage")) : ?>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.backstretch.min.js"></script>

<script type="text/javascript">
jQuery.backstretch("<?php echo $this->params->get("bodybackgroundimage"); ?>");
</script>
<?php endif; ?>
<jdoc:include type="modules" name="debug" />
<?php echo $this->params->get("footercode"); ?>
<?php /* ---------- getresponse--------- */?>
<jdoc:include type="modules" name="getresponse" />








<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/updateProductDetail.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/registracia.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/common.min.js"></script>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/inputmask_by_gartes.min.js?v=1"></script>
<script> jQuery.noConflict();</script>



	
</body>
</html>