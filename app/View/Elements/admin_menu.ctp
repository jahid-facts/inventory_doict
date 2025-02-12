<!-- Designed By Arun Kumar --> 
<style>
  .mn{
      margin-top:0px;  
      font-family: inherit; 
	    position:fixed !important; 
  }
	ul ul{
		margin: 0px !important;
		background: #25612e;
		border:0px !important;
	}
	
	ul ul li{
		border-bottom:1px solid #8dc641 !important;
	}
	
	ul ul li:last-child{
		border-bottom:0px !important;
	} 
  .fa-adjust {
    color: #c12e2e;
  }
  .disName {
    width: 100%;
    font-size: 18px;
    font-weight: 600;
    padding: 7px 10px;
    background-color: #edba1b;
    text-align: center;
    background-color: #edba1b;
    color: #21242a;
    box-shadow: inset 0px 0px 5px 0px black;
  }
	 @media screen and (max-width: 767px){
		.mn{
      margin-top: 75px;
			position:relative !important;
		}
	 }

</style>

<div id="left" class="mn">
  <div class=disName>
    <?php  
      if($currentUser['role_id'] ==5 || $currentUser['district_id']==100){
        echo "ICT Division";
      }else{
        echo $currentUser['District']['namebn'];
      }
    ?>
  </div> 

    <ul id="menu" class="collapse" style="background:none;"> 
        <!--Admin Start-->
        <?php if($currentUser['role_id'] ==1){?>
        <li><?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> ড্যাশবোর্ড', array('controller' => 'requisitions', 'action' => 'dashboard'),array('escape'=>false));?></li> 
        <li class="panel">
          <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-user">
            <i class="fa fa-users"> </i> ব্যবহারকারীদের লিস্ট<span class="pull-right"><i class="fa fa-angle-left"></i></span>
              &nbsp; <span class="label label-default"></span>&nbsp;
          </a>
          <ul class="collapse" id="component-user">
              <li><?php echo $this -> Html -> link('<i class="fa fa-star"></i> সক্রিয় ব্যবহারকারী', array('controller' => 'users', 'action' => 'index','1'),array('escape'=>false));?></li> 
              <li><?php echo $this -> Html -> link('<i class="fa fa-star-half-o"></i> নিষ্ক্রিয় ব্যবহারকারী', array('controller' => 'users', 'action' => 'index','2'),array('escape'=>false));?></li>
          </ul>
        </li>  
        <li class="panel">
          <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav2">
            <i class="fa fa-stack-overflow"> </i> স্টক রিপোর্ট<span class="pull-right"><i class="fa fa-angle-left"></i></span>
              &nbsp; <span class="label label-default"></span>&nbsp;
          </a>
          <ul class="collapse" id="component-nav2">
                <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> ওপেনিং স্টক লিস্ট', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li> 
                <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> পণ্যের স্টক লিস্ট', array('controller' => 'stocks', 'action' => 'stock'),array('escape'=>false));?></li>
                <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> তারিখ অনুসারে পণ্য স্টক', array('controller' => 'stocks', 'action' => 'stockreport'),array('escape'=>false));?></li>                     
          </ul>
        </li>
        <li class="panel">
              <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav3">
                      <i class="fa fa-bitbucket"> </i> পণ্যদ্রব্য <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                      &nbsp; <span class="label label-default"></span>&nbsp;
              </a>
              <ul class="collapse" id="component-nav3">
                <li><?php echo $this -> Html -> link('<i class="fa fa-product-hunt"></i> পণ্যের বিবরণ লিস্ট', array('controller' => 'products', 'action' => 'index'),array('escape'=>false));?></li> 
                <li><?php echo $this -> Html -> link('<i class="fa fa-shopping-cart"></i> পণ্যদ্রব্য ক্রয়', array('controller' => 'purchases', 'action' => 'add'),array('escape'=>false));?></li>
               
                <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> পণ্যদ্রব্য ক্রয় লিস্ট', array('controller' => 'purchases', 'action' => 'purchasereport'),array('escape'=>false));?></li>                        
              </ul>
        </li>
        <li class="panel">
          <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav1">
                  <i class="fa fa-rub"> </i> ই- চাহিদা<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                  &nbsp; <span class="label label-default"></span>&nbsp;
          </a>
          <ul class="collapse" id="component-nav1">
              <li class=""><?php echo $this -> Html -> link('<i class="fa fa-book"></i> প্রাপ্ত  চাহিদা', array('controller' => 'requisitions', 'action' => 'index'),array('escape'=>false));?></li>
              <li><?php echo $this -> Html -> link('<i class="fa fa-smile-o"></i> অনুমোদিত চাহিদা', array('controller' => 'requisitions', 'action' => 'requisitionapprove'),array('escape'=>false));?></li> 
              <!-- <li><?php echo $this -> Html -> link('<i class="fa fa-recycle"></i> প্রত্যাখ্যাত চাহিদা', array('controller' => 'requisitions', 'action' => 'requisitionreject'),array('escape'=>false));?></li>  -->
              <li><?php echo $this -> Html -> link('<i class="fa fa-modx"></i> ডেলিভারি চাহিদা', array('controller' => 'deliveries', 'action' => 'index'),array('escape'=>false));?></li> 
          </ul>
        </li>  
        <li><?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> পণ্যদ্রব্যের ট্রি-ডায়াগ্রাম', array('controller' => 'categories', 'action' => 'producttree'),array('escape'=>false));?></li>
        
        <!--Admin End--> 
        
        <!--Storekeeper Start-->
        <?php }elseif($currentUser['role_id'] ==2) {?>
        <li><?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> Dashboard', array('controller' => 'requisitions', 'action' => 'dashboardstorekeeper'),array('escape'=>false));?></li>
        <li class="panel">
          <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav1">
                  <i class="fa fa-cogs"> </i> Master Entry<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                  &nbsp; <span class="label label-default"></span>&nbsp;
          </a>
          <ul class="collapse" id="component-nav1"> 
              <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Designations List', array('controller' => 'designations', 'action' => 'index'),array('escape'=>false));?></li>
              <li><?php echo $this -> Html -> link('<i class="fa fa-puzzle-piece"></i> Departments List', array('controller' => 'departments', 'action' => 'index'),array('escape'=>false));?></li>
              <li>
                  <a href="#" data-parent="#me" data-toggle="collapse" class="accordion-toggle" data-target="#category">
                      <i class="fa fa-cogs"> </i> Category<span class="pull-right" style="padding-right: 16px;"><i class="fa fa-angle-left"></i></span>
                    &nbsp; <span class="label label-default"></span>&nbsp;
                  </a>
                  
                  <ul class="collapse" id="category">
                    <li>
                       <?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> Main Category List', array('controller' => 'categories', 'action' => 'index'),array('escape'=>false));?>
                    </li>
                     <li>
                       <?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> Sub-Category List', array('controller' => 'categories', 'action' => 'indexsub'),array('escape'=>false));?>
                    </li>
                  </ul>
               
              </li>   
              <li><?php echo $this -> Html -> link('<i class="fa fa-empire"></i> Measure List', array('controller' => 'measures', 'action' => 'index'),array('escape'=>false));?></li>
              <li><?php echo $this -> Html -> link('<i class="fa fa-users"></i> Supplier List', array('controller' => 'suppliers', 'action' => 'index'),array('escape'=>false));?></li>
              <li><?php echo $this -> Html -> link('<i class="fa fa-modx"></i> Model List', array('controller' => 'brands', 'action' => 'index'),array('escape'=>false));?></li>
              <li><?php echo $this -> Html -> link('<i class="fa fa-paint-brush"></i> Color List', array('controller' => 'colors', 'action' => 'index'),array('escape'=>false));?></li>
              <li><?php echo $this -> Html -> link('<i class="fa fa-calculator"></i> Size List', array('controller' => 'sizes', 'action' => 'index'),array('escape'=>false));?></li> 
              <li><?php echo $this -> Html -> link('<i class="fa fa-cog"></i> Settings List', array('controller' => 'settings', 'action' => 'index'),array('escape'=>false));?></li>
          </ul>
        </li>
        <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav2">
                    <i class="fa fa-stack-overflow"> </i> Stock Status<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                    &nbsp; <span class="label label-default"></span>&nbsp;
            </a>
            <ul class="collapse" id="component-nav2">
                <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> Opening Stock List', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li>
                <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Products Stock List', array('controller' => 'stocks', 'action' => 'stock'),array('escape'=>false));?></li>
                <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Date Wise Products Stock', array('controller' => 'stocks', 'action' => 'stockreport'),array('escape'=>false));?></li>                        
            </ul>
        </li> 
        <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav3">
              <i class="fa fa-bitbucket"> </i> Products <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                    &nbsp; <span class="label label-default"></span>&nbsp;
            </a>
            <ul class="collapse" id="component-nav3">
              <li><?php echo $this -> Html -> link('<i class="fa fa-product-hunt"></i> Products Detail List', array('controller' => 'products', 'action' => 'index'),array('escape'=>false));?></li> 
              <li><?php echo $this -> Html -> link('<i class="fa fa-shopping-cart"></i> Purchases Products', array('controller' => 'purchases', 'action' => 'add'),array('escape'=>false));?></li>
             
              <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Purchases Products List', array('controller' => 'purchases', 'action' => 'purchasereport'),array('escape'=>false));?></li>                        
            </ul>
        </li>
        <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav10">
              <i class="fa fa-adn"> </i> Products Adjustment <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                    &nbsp; <span class="label label-default"></span>&nbsp;
            </a>
            <ul class="collapse" id="component-nav10">
              <li><?php echo $this -> Html -> link('<i class="fa fa-amazon"></i> Adjustment', array('controller' => 'products', 'action' => 'padjustment'),array('escape'=>false));?></li> 
              <li><?php echo $this -> Html -> link('<i class="fa fa-codepen"></i> Adjustment List', array('controller' => 'damages', 'action' => 'index'),array('escape'=>false));?></li>              
            </ul>
        </li>
        
        <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav5">
                    <i class="fa fa-shirtsinbulk"></i> Requisition Product Return <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                    &nbsp; <span class="label label-default"></span>&nbsp;
            </a>
            <ul class="collapse" id="component-nav5">
              <li><?php echo $this -> Html -> link('<i class="fa fa-shopping-cart"></i> Products Return', array('controller' => 'deliveries', 'action' => 'returnrequisition'),array('escape'=>false));?></li>     
              <li class="arun"><?php echo $this -> Html -> link('<i class="fa fa-stack-exchange"></i>  Products Return List', array('controller' => 'requisitionreturns', 'action' => 'index'),array('escape'=>false));?></li>                        
            </ul>
        </li>  
        <!-- <li class="panel">
            <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav4">
                    <i class="fa fa-rub"> </i> Requisition <span class="pull-right"><i class="fa fa-angle-left"></i></span>
                    &nbsp; <span class="label label-default"></span>&nbsp;
            </a>
            <ul class="collapse" id="component-nav4">
              <li><?php //echo $this -> Html -> link('<i class="fa fa-list-alt"></i> Requisition Approved List', array('controller' => 'requisitions', 'action' => 'index'),array('escape'=>false));?></li>
    
              <li class="arun"><?php //echo $this -> Html -> link('<i class="fa fa-list"></i> Requisition Delivered', array('controller' => 'deliveries', 'action' => 'index'),array('escape'=>false));?></li>                        
            </ul>
        </li>  --> 
         <li><?php echo $this -> Html -> link('<i class="fa fa-adjust"></i> Products Re-order List', array('controller' => 'stocks', 'action' => 'reorderlist'),array('escape'=>false));?></li>
         <li><?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> পণ্যদ্রব্যের ট্রি-ডায়াগ্রাম', array('controller' => 'categories', 'action' => 'producttree'),array('escape'=>false));?></li>
        <!--Storekeeper End-->
        
        
        
        
        
        
         <!--Requisitioner Start-->
        <?php }elseif($currentUser['role_id'] ==3) {?>
        <li><?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> Dashboard', array('controller' => 'stocks', 'action' => 'dashboardrequisitioner'),array('escape'=>false));?></li>
        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-archive"></i> Products Stock', array('controller' => 'stocks', 'action' => 'availablestock'),array('escape'=>false));?></li>
        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-stack-overflow"></i> New Requisitions', array('controller' => 'stocks', 'action' => 'atcrequisition'),array('escape'=>false));?></li>
        <li class=""><?php echo $this -> Html -> link('<i class="fa fa-th-list"></i>  Requisitions List', array('controller' => 'requisitions', 'action' => 'index'),array('escape'=>false));?></li> 
        <li><?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> Product Tree Diagram', array('controller' => 'categories', 'action' => 'producttree'),array('escape'=>false));?></li>
        <!--Requisitioner End-->
        
        
        
        
        
        
        <!--Super Admin Start-->
        <?php }elseif($currentUser['role_id'] ==4) {?>
        <li>
          <?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> Dashboard', array('controller' => 'users', 'action' => 'sudashboard'),array('escape'=>false));?> 
        </li>
        <li class="panel">
          <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-user">
            <i class="fa fa-users"> </i> Users List<span class="pull-right"><i class="fa fa-angle-left"></i></span>
              &nbsp; <span class="label label-default"></span>&nbsp;
          </a>
          <ul class="collapse" id="component-user">
              <li><?php echo $this -> Html -> link('<i class="fa fa-star"></i> Active Users', array('controller' => 'users', 'action' => 'index','1'),array('escape'=>false));?></li> 
              <li><?php echo $this -> Html -> link('<i class="fa fa-star-half-o"></i> Inactive Users', array('controller' => 'users', 'action' => 'index','2'),array('escape'=>false));?></li>
          </ul>
        </li> 
         
        <li class="panel">
          <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav2">
            <i class="fa fa-stack-overflow"> </i> Stock Report<span class="pull-right"><i class="fa fa-angle-left"></i></span>
              &nbsp; <span class="label label-default"></span>&nbsp;
          </a>
          <ul class="collapse" id="component-nav2">
                <li><?php echo $this -> Html -> link('<i class="fa fa-yelp"></i> Opening Stock List', array('controller' => 'stocks', 'action' => 'index'),array('escape'=>false));?></li> 
                <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Product Stock List', array('controller' => 'stocks', 'action' => 'stock'),array('escape'=>false));?></li>
                <li><?php echo $this -> Html -> link('<i class="fa fa-dashcube"></i> Date Wise Products Stock', array('controller' => 'stocks', 'action' => 'stockreport'),array('escape'=>false));?></li>                     
          </ul>
        </li>
        <li class="panel">
          <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#component-nav1">
                  <i class="fa fa-rub"> </i> Requisitions<span class="pull-right"><i class="fa fa-angle-left"></i></span>
                  &nbsp; <span class="label label-default"></span>&nbsp;
          </a>
          <ul class="collapse" id="component-nav1">
              <li><?php echo $this -> Html -> link('<i class="fa fa-book"></i> Requisitions Received', array('controller' => 'requisitions', 'action' => 'index'),array('escape'=>false));?></li>
              <li><?php echo $this -> Html -> link('<i class="fa fa-smile-o"></i> Requisitions Approved', array('controller' => 'requisitions', 'action' => 'requisitionapprove'),array('escape'=>false));?></li> 
              <!-- <li><?php echo $this -> Html -> link('<i class="fa fa-recycle"></i> Requisitions Rejected', array('controller' => 'requisitions', 'action' => 'requisitionreject'),array('escape'=>false));?></li>  -->
              <li><?php echo $this -> Html -> link('<i class="fa fa-modx"></i> Requisitions Delivered', array('controller' => 'deliveries', 'action' => 'index'),array('escape'=>false));?></li> 
          </ul>
        </li>
        <li>
          <?php echo $this -> Html -> link('<i class="fa fa-sitemap"></i> পণ্যদ্রব্যের ট্রি-ডায়াগ্রাম', array('controller' => 'categories', 'action' => 'producttree'),array('escape'=>false));?> 
        </li>
        <?php }elseif($currentUser['role_id'] ==5) {?>
          <li>
            <?php echo $this -> Html -> link('<i class="fa fa-tachometer"></i> ড্যাশবোর্ড', array('controller' => 'users', 'action' => 'centraldashboard'),array('escape'=>false));?> 
          </li>
          <li class=""><?php echo $this -> Html -> link('<i class="fa fa-caret-square-o-right"></i> সমুদয় রিপোর্ট', array('controller' => 'users', 'action' => 'totalactivities'),array('escape'=>false));?></li>
          <li class=""><?php echo $this -> Html -> link('<i class="fa fa-users"></i> সুপার অ্যাডমিন লিস্ট', array('controller' => 'users', 'action' => 'superusers'),array('escape'=>false));?></li>
          <li class=""><?php echo $this -> Html -> link('<i class="fa fa-paw"></i> ফুট প্রিন্ট', array('controller' => 'logs', 'action' => 'index'),array('escape'=>false));?></li>
          <li class=""><?php echo $this -> Html -> link('<i class="fa fa-registered"></i> অনুমোদিত রোল ', array('controller' => 'roles', 'action' => 'index'),array('escape'=>false));?></li>
        <?php }?>
        <!--Super Admin End-->       

    </ul> 
</div>

<style> 
    .current_page{color:#FFF !important;}
    .current_page>a{color:#FFF !important;}
    .current_page>button{color:#FFF !important;}
</style>

<script type="text/javascript">
    //jQuery.noConflict();
    $(document).ready(function(){ 
       var url ='<?php echo $this->here;?>';
       $("li a").each(function(){
            if($(this).attr("href") == url){
                $(this).addClass("current_page");
                $(this).parents('li').addClass('active');
                $(this).parents('li').parents('ul').parents('li').addClass('current_page'); 
            }
       });
    });
</script>

<!-- Designed By Arun Kumar -->