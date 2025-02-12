<script type="text/javascript">
    var path='<?php echo $this->webroot;?>';

   $(document).ready(function(){
    $(".subcategory_option").html("<option value='0'>Select Subcategory</option>"); 
    $(".product_option").html("<option value='0'>Select Product</option>"); 
  });
  function getSubcategory(category_id){

    $.ajax({
       type: 'POST',
       dataType: 'json',
       url: path+'categories/getsubcategory',
       data: {category_id:category_id}, 
       success: function(data) {

         $(".subcategory_option").empty();
         $(".subcategory_option").html("<option value='0'>Select Subcategory</option>"); 
         $.each(data, function(index, value) {
           
             $(".subcategory_option").append("<option value='"+index+"'>"+value+"</option>"); 
            }); 
         }       
    }); 
  }
   function getProduct(pid){

    $.ajax({
       type: 'POST',
       dataType: 'json',
       url: path+'products/getproduct',
       data: {pid:pid}, 
       success: function(data) {

         $(".product_option").empty();

         $.each(data, function(index, value) {
           
             $(".product_option").append("<option value='"+index+"'>"+value+"</option>"); 
            }); 
         }       
    }); 
  }
</script>
<style>
    .btn.btn-rounded {
        background: #0a99d4 none repeat scroll 0 0;
        border-radius: 12px;
        border-width: 2px;
        color: #fff;
        font-weight: 600;
        padding: 2px 10px;
        float: right;
        margin-bottom: 10px;
    }
    .panel-title{
            font-family: inherit;
            font-size: 16px; 
            font-weight: bold;
        }
    .thla th {
           color: #0088cc;
           text-align: left;
       }
    #message { text-align: center; vertical-align: middle; }
       
</style>



<!-- @ author : Md. Innitum Nayem Shawon ; my chart box , Start here-->
<style>

    .my_cart_full_box::-webkit-scrollbar {
    width: 0.5em;
    }
     
    .my_cart_full_box::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    }
     
    .my_cart_full_box::-webkit-scrollbar-thumb {
      background-color: #912fd9;
      outline: 1px solid slategrey;
    }


    .my_cart_box{
        width:auto; height:auto;
        position: fixed;
        right:0px; top:170px;
        z-index: 999;
    }

    .my_cart_short_box{
        width:100px; height:100px;
        float: right;
        border:2px solid #683091;
        background: rgb(141,198,65);
        opacity: 0.2;
        transition:.5s all;
    }
    .my_cart_short_box:hover{
        opacity: 1;
    }

    .my_cart_full_box{
        width:300px; height:300px;
        overflow: auto;
        float: right;
        display:none;
        border:2px solid #683091;
        background: rgb(141,198,65);
    }
    .my_cart_head{
        margin:0px; padding: 5px 10px; height: 40px;
        background: #683091; color:#fff;
        position: fixed;
        width:100%;
    }
    .my_cart_box_details{
        padding:20px;
        margin-top: 30px;
        color:#fff;
    }

    
</style>



<div class="user index">
    <div style="height:20px;"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> 
          <?php echo __('Stock'); ?> <span id="stockcount">0</span>/5
        </h3>

        </div>
        <div class="panel-body">
            <?php
                echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
            ?>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>


                    <td>
                        <?php echo $this->Form->input('category_id',array('onChange'=>'getSubcategory(this.value);','label'=>false,'div'=>false,'type'=>'select','options'=>$categories,'class'=>'form-control','empty'=>'Select Category'));?>
                    </td>
                    
                    <td>
                    
                        <?php
                        $getsub=array();
                        $category_id = $this->request->data['Report']['category_id'];
						$getsub = ClassRegistry::init('Category')->find(
							'list',
							array('fields'=>array('id','name'),'recursive'=>-1, 'conditions'=>array('Category.parent_id'=>$category_id))
						);
			
			
						if($getsub){
							echo $this->Form->input('subcategory',array('onChange'=>'getProduct(this.value);','type'=>'select','options'=>$getsub,'class'=>'form-control subcategory_option','label'=>false,'empty'=>'Select Subcategory'));
						}else{
							echo $this->Form->input('subcategory',array('onChange'=>'getProduct(this.value);','type'=>'select','class'=>'form-control subcategory_option','label'=>false,'empty'=>'Select Subcategory'));
						}
                        
                        
                        ?>
                    </td>

                    <td>
                    
                    <?php  
                    	$getpro=array();
                        $pcid = $this->request->data['Report']['subcategory'];
						
						$getpro =ClassRegistry::init('Product')->find(
							'list',
							array('fields'=>array('id','name'),'recursive'=>-1, 'conditions'=>array('Product.pcid'=>$pcid))
						);
						
						?>
                        <?php 
                        if($getpro){
                        	echo $this->Form->input('id',array('type'=>'select','options'=>$getpro,'class'=>'form-control product_option','empty' =>'Select Product','label'=>false,'id'=>'ReportId'));
                        }else{
                        	echo $this->Form->input('id',array('type'=>'select','class'=>'form-control product_option','empty' =>'Select Product','label'=>false,'id'=>'ReportId'));
                        }
                        

                        ?>
                    </td>

                    <td class="col-md-1">
                        <?php echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') );?>
                    </td>
                </tr>
            </table>
		<br />
                <?php
                echo $this->Form->end ();
                ?>
                
            <div class="table-responsive">
                <div id="message" style="font-size:20px;color:red;"></div>
            <?php echo $this->Form->create('Stock',array('class'=>'form-horizontal','url' => array('controller'=>'stocks','action'=>'stockrequisition'))); ?>
               <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                        <th>SL.No.</th>
                        <th> Product</th>
                        <th>Stock</th> 
                    </tr>
			
			<?php

			$i=0;

			foreach ($stocks as $key=>$stock): 
			$i++;
			//echo p($stock);
			$pid=$stock['Product']['id'];
			$description=$stock['Category']['name'].'->'.$stock['SubCategory']['name'].'->'.$stock['Product']['name'];
			
		    if(!empty($stock['Brand']['name'])){
		    	$description.='->'.$stock['Brand']['name'];
		    }
			if(!empty($stock['Color']['name'])){
		    	$description.='->'.$stock['Color']['name'];
		    }
		    if(!empty($stock['Size']['name'])){
		    	$description.='->'.$stock['Size']['name'];
		    }
			$distid = $currentUser['district_id'];
		
			
			$sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity FROM products 
			AS pt LEFT JOIN
			( 
				SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
				FROM stocks WHERE district_id=$distid GROUP BY stocks.product_id 
			) 
			AS s ON pt.id = s.product_id LEFT JOIN 
			( 
				SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
				FROM purchasedetails WHERE district_id=$distid GROUP BY purchasedetails.product_id 
			)
			 AS p ON pt.id = p.product_id LEFT JOIN 
			( 
				SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
				FROM deliverydetails WHERE district_id=$distid GROUP BY deliverydetails.product_id 
			)
			AS d ON pt.id = d.product_id 
			WHERE pt.id='".$pid."'
			GROUP BY pt.id 
			";
			
			$data = getQueryData($sql);
			
			$stockIn=$data['squantity']+$data['pquantity'];
			$stockOut=$data['dquantity'];
			
			$balance=$stockIn-$stockOut;
			
			?>
			
			
			
                    <tr>
                        <td><?php echo h($i); ?>&nbsp;</td>
                        <td>
                                <?php 
                                echo $description;  ?>
                        </td>
                        <td><?php echo $balance.' '.$stock['Measure']['name']; ?>&nbsp;</td>
                        <?php 
                       
                    //if($balance>0){

                        ?> 
                    <?php //} ?>
                    </tr>
                        <?php endforeach; ?>
                </table>
                <?php echo $this->Form->end(); ?> 
            </div>
          
        </div>
    </div>
</div> 

