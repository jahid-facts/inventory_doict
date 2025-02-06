<!-- Designed By Arun Kumar -->
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'ষ্টোর ব্যবস্থাপনা এবং ই-রিকুজিশন');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?> 	     
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="DoICT" name="ষ্টোর ব্যবস্থাপনা এবং ই-রিকুজিশন" />
    <meta content="ICPL" name="Arun Kumar - arun24542@gmail.com" />
    <meta content="ICPL" name="www.ipsitasoft.com" />
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"> 
    <style type="text/css">
    	*{
    		font-family: "SolaimanLipi", Arial, sans-serif;
    	}
    	html, body {
    		font-family: "SolaimanLipi", Arial, sans-serif;
    	}
    </style>  
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css(array(
            'bootstrap',
            'main',
            'MoneAdmin',
            'font-awesome/css/font-awesome.min',
            'font-awesome',
            'dataTables.bootstrap',
            'bootstrap-fileupload.min',
            'validationEngine.jquery',
            'custom'
            )
        );

		echo $this->Html->script(array(
			'jquery-2.0.3.min',
			'bootstrap.min',
			'jquery.dataTables',
			'dataTables.bootstrap',
			'bootstrap-fileupload',
			'jquery.validationEngine',
			'jquery.validate.min',
			'validationInit'
			)
		); 
	?> 
	<script> 
	  	$(document).ready(function () {

		  	$("#icount").html('<?php echo $itemcart;?>');

			//if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
			var $L = 1200,
				$menu_navigation = $('#main-nav'),
				$cart_trigger = $('#cd-cart-trigger'),
				$hamburger_icon = $('#cd-hamburger-menu'),
				$lateral_cart = $('#cd-cart'),
				$shadow_layer = $('#cd-shadow-layer');

			//open lateral menu on mobile
			$hamburger_icon.on('click', function(event){
				event.preventDefault();
				//close cart panel (if it's open)
				$lateral_cart.removeClass('speed-in');
				toggle_panel_visibility($menu_navigation, $shadow_layer, $('body'));
			});

			//open cart
			$cart_trigger.on('click', function(event){
				event.preventDefault();
				//close lateral menu (if it's open)
				$menu_navigation.removeClass('speed-in');
				toggle_panel_visibility($lateral_cart, $shadow_layer, $('body'));
			});

			//close lateral cart or lateral menu
			$shadow_layer.on('click', function(){
				$shadow_layer.removeClass('is-visible');
				// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
				if( $lateral_cart.hasClass('speed-in') ) {
					$lateral_cart.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
						$('body').removeClass('overflow-hidden');
					});
					$menu_navigation.removeClass('speed-in');
				} else {
					$menu_navigation.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
						$('body').removeClass('overflow-hidden');
					});
					$lateral_cart.removeClass('speed-in');
				}
			});

			//move #main-navigation inside header on laptop
			//insert #main-navigation after header on mobile
			move_navigation( $menu_navigation, $L);
			$(window).on('resize', function(){
				move_navigation( $menu_navigation, $L);
				
				if( $(window).width() >= $L && $menu_navigation.hasClass('speed-in')) {
					$menu_navigation.removeClass('speed-in');
					$shadow_layer.removeClass('is-visible');
					$('body').removeClass('overflow-hidden');
				}

			});
		});

		function toggle_panel_visibility ($lateral_panel, $background_layer, $body) {
			if( $lateral_panel.hasClass('speed-in') ) {
				// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
				$lateral_panel.removeClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					$body.removeClass('overflow-hidden');
				});
				$background_layer.removeClass('is-visible');

			} else {
				$lateral_panel.addClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					$body.addClass('overflow-hidden');
				});
				$background_layer.addClass('is-visible');
			}
		}

		function move_navigation( $navigation, $MQ) {
			if ( $(window).width() >= $MQ ) {
				$navigation.detach();
				$navigation.appendTo('header');
			} else {
				$navigation.detach();
				$navigation.insertAfter('header');
			}
		}
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
    </script>
    <script>
        $(function () { formValidation(); });
    </script> 
	<link rel="stylesheet" href="<?php echo $this->webroot;?>css/sitepart/style.css">
</head>
<body class="padTop53" >
	<div id="wrap" >
       <?php echo $this->element('admin_header');?> 
       <?php echo $this->element('admin_menu')?>
        <!--PAGE CONTENT -->
        <div id="content">
            <div class="inner" style="min-height: 700px;"> 
				<?php  echo $this->fetch('content'); ?>
            </div>
        </div>
        <?php echo $this->element('addtocard');?>
	</div>
	<div style="clear: both;">
		<?php echo $this->element('admin_footer');?>
	</div> 
	<?php echo $this->element('sql_dump');?> 
</body>
</html>
<!-- Designed By Arun Kumar -->