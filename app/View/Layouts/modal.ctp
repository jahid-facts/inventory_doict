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

$cakeDescription = __d('cake_dev', 'Inventory');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta content="" name="description" />
		<meta content="" name="author" />
	     <!--[if IE]>
	        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
             
	<?php
		echo $this->Html->meta('icon');
		/*echo $this->Html->css(array(
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
								);*/

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<!--END GLOBAL STYLES -->
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	 <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
      <script>
        $(function () { formValidation(); });
     </script>
</head>
<body >

        <!--PAGE CONTENT -->
        
            <div>
	            <?php //echo $this->Session->flash(); ?>
	            
                    <?php echo $this->fetch('content'); ?>
            </div>
       
        <!--END PAGE CONTENT -->
	
</body>
</html>
