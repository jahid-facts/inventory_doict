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
	<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
	<style type="text/css">
    	*{
    		font-family: "SolaimanLipi", Arial, sans-serif!important;
    	}
    	html, body {
    		font-family: "SolaimanLipi", Arial, sans-serif!important;
    	}
    </style>
	<?php
		echo $this->Html->meta('icon');   
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script'); 
        echo $this->Html->css(array('slidercss/blueberry','style1','bootstrap')); 
	?>
	<script type="application/x-javascript"> 
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
    </script>
</head>
<style>
    .my_wrapp{
		position:absolute;
		width:100%; height:100%;
		margin:0px; padding:0px;
		
		background-image: url("../img/slider_bg2.png");
	    background-attachment: fixed;
	    background-position: center;
	    background-size: cover;
		font-family:Lucida sans;
	}

	.my_login_box{
		width:400px;
		background-color: rgba(255, 255, 255, 0.3);
		margin:100px auto;
		padding:20px;
		border-radius:10px;
		box-shadow:0px 0px 5px #333;
	}

	.my_login_box form{
		margin:0px;
		padding:0px;
	}

	.my_login_box form li{
		background:#e8f0fe;
	}

	.my_logo{
		border-radius:50%;
		width:100px; height:100px;
		border:5px solid Red;
		margin:-70px auto 10px;
		overflow:hidden;
		box-shadow:0px 0px 5px Red;
	} 
	center{
		font-size:16px; 
	}
    @media screen and (max-width: 500px) and (min-width: 320px) {
        .my_login_box{
			width:300px;
			margin:100px auto;
		}

		.my_login_box form{
			margin:20px;
			padding:0px;
		}

		.my_login_box form li{
			background:#e8f0fe;
		}

		
    }
    
    @media screen and (max-width: 321px){
        .my_login_box{ 
			margin:100px auto;
		}

		.my_login_box form{
			margin:20px;
			padding:0px;
		}

		.my_login_box form li{
			background:#e8f0fe;
		}

		.my_logo{
			border-radius:50%;
			width:80px; height:80px;
			border:5px solid Red;
			margin:-70px auto 10px;
			overflow:hidden;
			box-shadow:0px 0px 5px Red;
		}

		center {
			font-size:14px; 
		}
    }

    input[type="text"], input[type="password"] {
	  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	  border: medium none;
	  color: #000;
	  font-family: inherit;  
	  outline: medium none; 
	  width: 80%;
	}


    input[type="text"], input[type="email"] {
	  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
	  border: medium none;
	  color: #000;
	  font-family: inherit;  
	  outline: medium none; 
	  width: 80%;
	}
	#content {
		margin: 0 auto;
		min-width: 740px;
		max-width: 1140px;
	} 
	.blueberry { max-width: 1050px; } 
	.fp a{
		float: left; 
		padding-top: 15px;
		padding-left: 3px;
		color: #8b0000;
		font-size: 15px;
	} 
	.alert {
		margin-top: 5px;
		margin-bottom: -15px;
		text-align: center;
	} 
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<?php echo $this->Html->script(array('sliderJs/jquery.blueberry')); ?>

<script>
	$(window).load(function() {
		$('.blueberry').blueberry();
	});
</script>
<body> 
	<div class="my_wrapp">
		<div class="my_login_box">
		
			<div class="my_logo">
				<img src="<?php echo $this->webroot;?>images/mem2.jpg" alt="" height="100px"/>
			</div> 
			<center>
				<span style="font-size:20px; color:#fff; text-shadow:1px 1px 5px #0b3b6b;">ষ্টোর ব্যবস্থাপনা এবং ই-রিকুজিশন   </span> <br>
				তথ্য ও যোগাযোগ প্রযুক্তি অধিদপ্তর 
			</center> 
			<?php  echo $this->fetch('content'); ?> 
			<div style="clear: both; height: 10px;"> </div>
		</div> 
		<div style="clear: both;"></div>	 
	</div>  
</body>
</html>
