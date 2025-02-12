<!-- Designed By Arun Kumar -->
<style>
    @media screen and (max-width: 767px){
        .navbar-top-links .dropdown-user {
            right: 0;
            left: 0;
        }
        
        h4{
            font-size:16px;
            font-family: inherit;
            font-weight: bold;
        }
        .logo{
            width:100px; height:40px;
        }
        .hd h3{
            color:#0088cc;
            font-family: inherit;
            font-weight: bold;
            font-size: 16px;
        }
        .navbar-top-links .dropdown-user {
            left: -100px;
            right: 0;
        }
        
        .navbar-top-links .dropdown-menu li a {
            font-size: 12px;
          }

    }
    
    @media screen and (max-width: 466px){
        .navbar-top-links .dropdown-user {
            right: 0;
            left: 0;
        }
        
        h4{
            font-size:14px;
            font-family: inherit;
            font-weight: bold;
        }
        .logo{
            width:80px; height:30px;
        }
                
        .hd h3{
            color:#0088cc;
            font-family: inherit;
            font-weight: bold;
            font-size: 16px;
        }
        
        .navbar-top-links .dropdown-user {
            left: -100px;
            right: 0;
        }
        
        .navbar-top-links .dropdown-menu li a {
            font-size: 12px;
          }

    }
        .hd h3{
            color:#0088cc;
            font-family: inherit;
            font-weight: bold;
        }
</style>
<div id="top">
	<nav class="navbar navbar-inverse navbar-fixed-top " style="padding-bottom: 0px;">
		<a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-info btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
			<i class="fa fa-align-justify"></i>
		</a>
		<!-- LOGO SECTION -->
                <header>
                    <div class="row">                        
                        <div class="col-xs-2">
                            <img class="logo" src="<?php echo $this->Html->webroot;?>img/logo/doict.png" height="45px"/>
                        </div>
                        <div class="col-xs-8 hd">
                            <center> <h3> <i class="fa fa-leaf"></i> Inventory Management System</h3> </center>
                        </div>
                        
                        <div class="col-xs-2">
                            <!-- SETTING SECTION -->
                                <ul class="nav navbar-top-links navbar-right">
                                        <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <?php  
                                                        $imgId=AuthComponent::user('id');
                                                        $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';
                                                    
                                                        if(file_exists($check)){?>
                                                            <img  class="img-circle" width="40" height="40" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                                                    <?php }?>
<!--                                                <i class="fa fa-user "></i>&nbsp; -->
                                                
                                                <i class="fa fa-chevron-down "></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-user">
                                                        <li><a  style="font-family:inherit; font-weight: bold;"  href="<?php echo $this->webroot;?>users/view/<?php echo $currentUser['id'];
                                    ?>">
                                    <?php  
                                                        $imgId=AuthComponent::user('id');
                                                        $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';
                                                    
                                                        if(file_exists($check)){?>
                                                                <img  class="img-circle" width="20" height="20" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                                                    <?php }?> User Profile </a></li>
                                                        <li style="margin:0px 0px 0px 6px;"><a style="font-family:inherit; font-weight: bold;" href="<?php echo $this->webroot;?>users/cp"><i class="fa fa-gear"></i> Change Password </a></li>

                                                        <li class="divider"></li>
                                                        <li><?php echo $this->Html->link ( '<i class="fa fa-sign-out"></i> Logout', array ('controller' => 'users', 'action' => 'logout' ),array('escape'=>false, 'style'=>'font-family:inherit; font-weight: bold;') );?></li>
                                                </ul>
                                        </li>
                                </ul>
                                <!-- END SETTING SECTION -->
                        </div>

                    </div>
                    
                    
			<?php 
			//echo $this->Html->link($this->Html->image('is_logo.png'),array(''),array('escape'=>false,'class'=>'navbar-brand')) 
			//echo $this->Html->link($this->Html->image('logo.png'),array(''),array('escape'=>false,'class'=>'navbar-brand')) ?> 
		</header>
		<!-- END LOGO SECTION -->
		
	</nav>
</div>
<!-- Designed By Arun Kumar -->