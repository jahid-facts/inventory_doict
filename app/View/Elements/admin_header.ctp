<!-- Designed By Arun Kumar -->
<style> 
    .img-span{
        background: #FFF;
        border: 2px solid #CCC;
        padding: 2px;
        height: 40px;
        border-radius: 50%;
        margin-top: 2px;
    }
    .logo_sec{
            width:300px;
            float:left

    }
    .logo{
            margin:2px 0px 2px 10px;
    }

    .hd{

    }

    .hd h3{
        margin:5px 0px;
        font-family: inherit;
        font-weight: bold;
        font-size: 23px;
    }

    .logout_sec{
            background:red;
    }


    @media screen and (min-width: 768px) and (max-width: 900px){
            .hd h3{
                font-family: inherit;
                font-weight: bold;
                font-size: 18px;
            }
    }
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
        
        .hd h3{
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
        .for-xs {
            padding-left: 7px;
        }
        h4{
            font-size:14px;
            font-family: inherit;
            font-weight: bold;
        }
               
        .hd h3{
            color:#0088cc;
            font-family: inherit;
            font-weight: bold;
            font-size: 24px;
            border-top: 1px solid;
            border-bottom: 1px solid;
        }
        
        .navbar-top-links .dropdown-user {
            right: 10;
        }
        
        .navbar-top-links .dropdown-menu li a {
            font-size: 12px;
          }
          
          .cu{
              font-size: 12px;
          }
          .navbar-top-links li a {
            padding: 2px 5px; 
            text-align:right;
          }

    }
        
</style>
<div id="top">
    <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-bottom: 0px; border:1px solid #683091; box-shadow:0px 2px 2px #310650;">
        <!--
        <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-info btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
            <i class="fa fa-align-justify"></i>
        </a>
        -->
        <!-- LOGO SECTION -->
                <header style="background:#683091;">
                    
                    <div class="row">                        
                        <div class="col-sm-4 for-xs" >
                            <a href="http://www.digitalworld.org.bd">
                            <img class="logo" src="<?php echo $this->Html->webroot;?>img/logo/digitalbd_logo.png" height="45px"/>
                            </a>
                            
                            <a href="http://www.ictd.gov.bd">
                            <img class="logo" src="<?php echo $this->Html->webroot;?>img/logo/ict_logo.png" height="45px"/>
                            </a>
                            
                            <a href="http://www.doict.gov.bd">
                            <img class="logo" src="<?php echo $this->Html->webroot;?>img/logo/doict_logo.png" height="45px"/>
                            </a> 
                            <!-- Collapse Menu Start-->
                            <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-info btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
                                <i class="fa fa-align-justify"></i>
                            </a>
                            
                            <!-- Collapse Menu End-->
                        </div>
                        <div class="col-sm-8">
                            <div class="row" style="margin-top: 3px;">
                                <div class="col-sm-6 hd text-center">
                                    <h3 style="color:#fff; padding:5px 0px; text-shadow:1px 1px 2px #333;">  ষ্টোর ব্যবস্থাপনা এবং ই- চাহিদা</h3> 
                                </div> 
                                <div class="col-sm-2 col-xs-4"> 
                                    <?php if($currentUser['role_id'] ==3){?> 
                                        <div id="cd-cart-trigger">
                                            <a class="cd-img-replace" href="#0"></a>
                                            <button class="btn-info btoo" id="icount" >0</button>
                                        </div>
                                    <?php }?>
                                    <div style="clear: both;"></div>
                                </div>
                                 
                                
                                <div class="col-sm-4 col-xs-8">
                                   
                                    <!-- SETTING SECTION -->
                                        <ul class="nav navbar-top-links navbar-right"  style="text-align:right; background:none;">
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"  style="color:#fff;" >
                                                    <?php  
                                                        $imgId=AuthComponent::user('id');
                                                        $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';
                                                    
                                                    if(file_exists($check)){?>
                                                    <img  class="img-circle" style="width:40px; height:40px; border:2px solid #8dc641; margin:0px;" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                                                    <?php }else{?>
                                                        <img class="img-circle" style="width:40px; height:40px; border:2px solid #8dc641; margin:0px;" src="<?php echo $this->webroot?>images/dummy.jpg"/>
                                                    <?php }?>&nbsp;&nbsp;
                                                
                                                        <span class="cu"><?php echo h($currentUser['name']); ?></span>&nbsp;&nbsp;
                                                                                                                            
                                                        <i class="fa fa-chevron-down " style="background: #143444; border: 2px solid #9babe4; border-radius: 50%;"></i> &nbsp;&nbsp;
                                                    </a>
                                               
                                                <ul class="dropdown-menu dropdown-user">
                                                    <li><a  style="font-family:inherit; font-weight: bold;"  href="<?php echo $this->webroot;?>users/view/<?php echo $currentUser['id'];?>">
                                                    <?php  
                                                        $imgId=AuthComponent::user('id');
                                                        $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';
                                                    
                                                    if(file_exists($check)){?>
                                                        <img  class="img-circle" style="width:20px; height:20px; border:2px solid #8dc641; margin-left:-5px;" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                                                    <?php }?> My Profile </a></li>
                                                    <li><a style="font-family:inherit; font-weight: bold;" href="<?php echo $this->webroot;?>users/cp"><i class="fa fa-gear"></i> Change Password </a></li>

                                                    <li><?php echo $this->Html->link ( '<i class="fa fa-sign-out"></i> Logout', array ('controller' => 'users', 'action' => 'logout' ),array('escape'=>false, 'style'=>'font-family:inherit; font-weight: bold;') );?></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- END SETTING SECTION -->
                                </div>
                            </div>
                        </div>

                    </div> 
                    
                    
            <?php 
            //echo $this->Html->link($this->Html->image('is_logo.png'),array(''),array('escape'=>false,'class'=>'navbar-brand')) 
            //echo $this->Html->link($this->Html->image('logo.png'),array(''),array('escape'=>false,'class'=>'navbar-brand')) ?> 
        </header>
        <!-- END LOGO SECTION -->
        
    </nav>
</div>
<div style="clear: both;"></div>
<!-- Designed By Arun Kumar -->
        <script>



            var path = '<?php echo $this->webroot; ?>';
            //Cart add remove functions
            function addCart(product_id, quantity,measure_id,stock) {

                

                $('#pi'+product_id).css("background-color", "#99ca3b","border-color", "#99ca3b",);

                // $('.btn-primary').css("background-color", "#99ca3b");
                //var r = confirm("Are you sure order this item "+quantity);
                //if (r == true) {
                $.ajax({
                    url: path + 'products/orders',
                    type: 'post',
                    data: {product_id:product_id,quantity:quantity,measure_id:measure_id,stock:stock},
                    success: function (data) {
                        $("html, body").animate({scrollTop: 0}, "slow");
                        $('.show-cart').html(data);

                        var totalcount = $('#totalcount').html();
                        $('#icount').html(totalcount);

                    }
                });
                //}
            }


            function removeCartItem(id, user_id) {
                var r = confirm("Are you sure ? You want to remove this item.");


               

                if (r == true) {
                    //var p_price = parseFloat(document.getElementById('p_price['+id+']').value);
                    //var p_unit = parseFloat(document.getElementById('p_amount['+id+']').value);
                    //document.getElementById('total_p_price['+id+']').value = (p_price * p_unit).toFixed(2);
                    //document.getElementById('gptotal_price').value = parseFloat(document.getElementById('gptotal_price').value)-(p_price * p_unit).toFixed(2);
                    $.ajax({
                        type: 'POST',
                        url: path + 'products/cart',
                        data: {removeProduct:id,user_id: user_id},
                        success: function (data) {
                            $("#rmid" + id).remove();
                            var totalcount = $('#icount').html();
                            var currentcount = totalcount - 1;
                            $("#icount").html(currentcount);

                            var ck=0;
                            $(".qnt").each(function (){
                                 ck=1;
                            });
                            if(ck==0){
                                 $(".hdb").hide();
                            }

                        }
                    });
                }
                /*location.reload();*/
            }

            function goOrder() {
               location.href = '<?php echo $this->webroot ?>pages/proceedorder';
            }
            

    function codeVerify(code,id){ 
        $.ajax({
            type: 'POST',
            url: path +'products/scode',
            data: {code:code},
            success: function(data){

               
                var res = data.split("/"); 

                 $('#pedi'+id).val(res[2]);
                 $('#product_name'+id).html(res[0]);
                 $('#pid'+id).html(res[1]);
                  $('#measure_id'+id).val(res[3]);
                   $('#measure_name'+id).val(res[4]);

                            
            }
        });
    }


     function checkpurpose(vl,i){  
            if(vl==5){
                $("#purpose"+i).show();
            }else{
                $("#purpose"+i).hide();
            }
        }
</script>

<script>
function validValue(id,tval,sval){

    if(sval<tval){
        alert("Please give requisitions quantity less than or equal to "+ sval);

        $('#quantity'+id).val('1');
    }
}

</script>