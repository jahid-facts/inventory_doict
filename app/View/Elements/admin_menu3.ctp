<style>
    .mn{
        margin-top:0px; 
        border-right:1px solid #428bca;
        font-family: inherit; 
    }
</style>

<div id="left" class="mn" >
    
    <ul id="menu" class="collapse">
        
        <!--Admin-->
        <?php if($currentUser['role_id'] ==1){?>
        <li><?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> Dashboard', array('controller' => 'requisitions', 'action' => 'dashboard'),array('escape'=>false));?></li>  
        
        
        
        <!--Storekeeper-->
        <?php }elseif($currentUser['role_id'] ==2) {?>
        <li><?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> Dashboard', array('controller' => 'requisitions', 'action' => 'dashboardstorekeeper'),array('escape'=>false));?></li>
        
        
        
         <!--Requisitioner-->
        <?php }elseif($currentUser['role_id'] ==3) {?>
        <li><?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> Dashboard', array('controller' => 'stocks', 'action' => 'dashboardrequisitioner'),array('escape'=>false));?></li>
        
        
        
        <!--Super Admin-->
        <?php }else{?>
        <li><?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> Dashboard', array('controller' => 'requisitions', 'action' => 'dashboard'),array('escape'=>false));?></li>
        <?php }?>
        
        
        
        
           <?php if($currentUser['role_id'] ==3){?>
         <li class=""><?php echo $this -> Html -> link('<i class="fa fa-stack-overflow"></i>  Requisition', array('controller' => 'stocks', 'action' => 'stockrequisition'),array('escape'=>false));?></li> 
          
         
         <?php }elseif($currentUser['role_id'] ==2) {?>
                 
         <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav2">
                        <i class="fa fa-cogs"> </i> Stock Status<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        &nbsp; <span class="label label-default"></span>&nbsp;
                </a>
                <ul class="collapse" id="component-nav2">
                        <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> Opening Stock', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li>
                       
                        <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Repeat Order List', array('controller' => 'designations', 'action' => 'index'),array('escape'=>false));?></li>                        
          </ul>
        </li>
        
        <li><?php echo $this -> Html -> link('<i class="fa fa-shopping-cart"></i> Product List', array('controller' => 'purchases', 'action' => 'index'),array('escape'=>false));?></li>
        
        <li><?php echo $this -> Html -> link('<i class="fa fa-product-hunt"></i> Products Category', array('controller' => 'products', 'action' => 'index'),array('escape'=>false));?></li>
        
        <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> Requisition Approval List', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li>
        
        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-list"></i>  Delivery Order List', array('controller' => 'deliveries', 'action' => 'index'),array('escape'=>false));?></li>
        
         
         <?php }elseif($currentUser['role_id'] ==1) {?>
               
               
               <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav1">
                        <i class="fa fa-cogs"> </i> Requisition<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        &nbsp; <span class="label label-default"></span>&nbsp;
                </a>
                <ul class="collapse" id="component-nav1">
                        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-book"></i> Requisition Received', array('controller' => 'requisitions', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> Requisition Approved', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li>
                       
                        <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Requisition Rejected', array('controller' => 'designations', 'action' => 'index'),array('escape'=>false));?></li>                        
          </ul>
        </li>
        
             <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav2">
                        <i class="fa fa-cogs"> </i> Stock Report<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        &nbsp; <span class="label label-default"></span>&nbsp;
                </a>
                <ul class="collapse" id="component-nav2">
                        <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> Opening Stock', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li>
                       
                        <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Repeat Order List', array('controller' => 'designations', 'action' => 'index'),array('escape'=>false));?></li>                        
          </ul>
        </li>
         <li class=""><?php echo $this -> Html -> link('<i class="fa fa-user"></i> User List', array('controller' => 'users', 'action' => 'index'),array('escape'=>false));?></li>
         <li><?php echo $this -> Html -> link('<i class="fa fa-product-hunt"></i> Products List', array('controller' => 'products', 'action' => 'index'),array('escape'=>false));?></li>
         
         
         
         
 <?php }else  {?>
          <li><?php //echo $this -> Html -> link('<i class="fa fa-shopping-cart"></i> Purchase', array('controller' => 'purchases', 'action' => 'index'),array('escape'=>false));?></li>
               <li class=""><?php echo $this -> Html -> link('<i class="fa fa-book"></i> Requisition Approval', array('controller' => 'requisitions', 'action' => 'index'),array('escape'=>false));?></li>
               <li class=""><?php //echo $this -> Html -> link('<i class="fa fa-location-arrow"></i>  Delivery', array('controller' => 'deliveries', 'action' => 'index'),array('escape'=>false));?></li>
        
             <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav2">
                        <i class="fa fa-cogs"> </i> Master Entry<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        &nbsp; <span class="label label-default"></span>&nbsp;
                </a>
                <ul class="collapse" id="component-nav2">
                	    <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> Opening Stock', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li>
                        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-user"></i> User', array('controller' => 'users', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Designations', array('controller' => 'designations', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-puzzle-piece"></i> Departments', array('controller' => 'departments', 'action' => 'index'),array('escape'=>false));?></li>
                        <li>
                            <a href="#" data-parent="#me" data-toggle="collapse" class="accordion-toggle" data-target="#category">
                                <i class="fa fa-cogs"> </i> Categories<span class="pull-right" style="padding-right: 16px;"><i class="fa fa-angle-left"></i></span>
                              &nbsp; <span class="label label-default"></span>&nbsp;
                            </a>
                            
                            <ul class="collapse" id="category">
                              <li>
                                 <?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> Categories', array('controller' => 'categories', 'action' => 'index'),array('escape'=>false));?>
                              </li>
                               <li>
                                 <?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> Sub Categories', array('controller' => 'categories', 'action' => 'indexsub'),array('escape'=>false));?>
                              </li>
                            </ul>
                         
                        </li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-shopping-cart"></i> Product List', array('controller' => 'purchases', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-product-hunt"></i> Products Category', array('controller' => 'products', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-users"></i> Suppliers', array('controller' => 'suppliers', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-modx"></i> Model', array('controller' => 'brands', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-paint-brush"></i> Colors', array('controller' => 'colors', 'action' => 'index'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-calculator"></i> Sizes', array('controller' => 'sizes', 'action' => 'index'),array('escape'=>false));?></li>
                        
                        <li><?php echo $this -> Html -> link('<i class="fa fa-cog"></i> Settings', array('controller' => 'settings', 'action' => 'index'),array('escape'=>false));?></li>
          </ul>
        </li>
        
        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-list"></i>  Delivery Order List', array('controller' => 'deliveries', 'action' => 'index'),array('escape'=>false));?></li>
         <li class="panel">
                <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav3">
                        <i class="fa fa-bar-chart"> </i> Reports <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                        &nbsp; <span class="label label-default"></span>&nbsp;
                </a>
                <ul class="collapse" id="component-nav3">
                        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-shopping-cart"></i> Purchase', array('controller' => 'purchases', 'action' => 'purchasereport'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-location-arrow"></i> Delivery', array('controller' => 'deliveries', 'action' => 'report'),array('escape'=>false));?></li>
                        <li><?php echo $this -> Html -> link('<i class="fa fa-ravelry"></i> Requisition', array('controller' => 'requisitions', 'action' => 'requisitionreport'),array('escape'=>false));?></li>
                        
                        <li><?php echo $this -> Html -> link('<i class="fa fa-stack-overflow"></i> Stock', array('controller' => 'stocks', 'action' => 'stock'),array('escape'=>false));?></li>
                        
          </ul>
        </li>
        
         <?php }?>

    </ul>
   
</div>
