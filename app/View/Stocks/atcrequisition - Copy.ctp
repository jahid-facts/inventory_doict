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
<script>
    function codeVerify(code,id){
        $.ajax({
            type: 'POST',
            url: path +'products/scode',
            data: {code:code},
            success: function(data){
                var res = data.split("/");
                 $('#pid'+id).html(res[1]);
                 $('#pedi'+id).val(res[2]);
                 $('#product_name'+id).val(res[0]);
                  $('#measure_id'+id).val(res[3]);
                   $('#measure_name'+id).val(res[4]);
                            
            }
        });
    }
</script>

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
            <div class="table-responsive">
                <div id="message" style="font-size:20px;color:red;"></div>
            <?php echo $this->Form->create('Stock',array('class'=>'form-horizontal','url' => array('controller'=>'stocks','action'=>'stockrequisition'))); ?>
               <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                        <th>SL.No.</th>
                        <th> Product</th>
                        <th>Stock</th>                        
                    <?php if($currentUser['role_id']==3) {?>
                        <th>Action</th>
                    <?php }?>
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
			
		
			
			$sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity FROM products 
			AS pt LEFT JOIN
			( 
				SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
				FROM stocks GROUP BY stocks.product_id 
			) 
			AS s ON pt.id = s.product_id LEFT JOIN 
			( 
				SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
				FROM purchasedetails GROUP BY purchasedetails.product_id 
			)
			 AS p ON pt.id = p.product_id LEFT JOIN 
			( 
				SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
				FROM deliverydetails GROUP BY deliverydetails.product_id 
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
                                echo $description;
                                
                                //echo $this->Html->link($stock['Category']['name'].'->'.$stock['Product']['name'].$description, array('controller' => 'products', 'action' => 'view', $stock['Product']['id'])); ?>
                        </td>
                        <td><?php echo $balance.' '.$stock['Measure']['name']; ?>&nbsp;</td>
                        <?php 
                       
                    //if($balance>0){

                        ?>
                        
                        <?php if($currentUser['role_id']==3){?>
                        <td>
                           <input type="checkbox" onClick="checkboxes();" name="data[Stock][<?php echo $key;?>][code]"  id="[]" class="checkbox1" value="<?php echo $stock['Product']['id'];?>" /> 
                            <li class="add-cart-button btn-group"  onclick="addCart('<?php echo $stock['Product']['id'] ?>', '<?php echo $stock['Product']['name'] ?>');">
                                                                
                                <button class="btn btn-primary" type="button">
                                    <i class=" glyphicon glyphicon-shopping-cart"></i> Add to cart
                                </button> 
                            </li>
                        </td>
                        <?php }?>
                    <?php //} ?>
                    </tr>
                        <?php endforeach; ?>
                </table>
                            <?php echo $this->Form->end(); ?><br>
                            <?php 
                                echo $this->Form->button ( 'NEXT', array ('class'=>'btn btn-info auth','onclick' => "confirmation();", 'type' => 'button', 'label' => false, 'div' => false,'style'=>'float:right;' ) );
                             ?>
            </div>
          
        </div>
    </div>
</div>


<script type="text/javascript">




	function checkboxes(){   
	 var inputElems = document.getElementsByTagName("input"),
	  count = 0;
		
	  for (var i=0; i<inputElems.length; i++) { 

		  
	     if (inputElems[i].type == "checkbox" && inputElems[i].checked == true){
	    	 count++;
		        if(count>5){
		    		$(".auth").hide(); 
		    	}else{
		    		$(".auth").show(); 
		    	}
		        if(count>5){
                    alert("*** অনুগ্রহ করে সর্বাধিক ৫ টি পদ নির্বাচন করুন ***");  
                    $("#message").html('অনুগ্রহ করে সর্বাধিক ৫ টি পদ নির্বাচন করুন'); 
                }else{
                    $('#stockcount').html(count);
                     $("#message").html('');
                }

	  	}else{


            if(count>5){
                 $("#message").html('Pelase select at list 5 items at a time'); 
            }else{
                $('#stockcount').html(count);
                $("#message").html(''); 
            }

	  		
	  	}


		       
	  
		  	
		}	
	}
	
	function confirmation(){
		 var name = $.trim($('#log').val());

		    // Check if empty of not
		    if (name  =='-1') {
		        alert('Please Select Head');
		        return false;
		    }
		
		var cond = confirm("Are you sure that you have selected");
		if(cond == true){
			$('#ReportAtcrequisitionForm').submit();
		}else{
		}
	}

</script>




<style type="text/css">
    .ad-span a{
        border: 1px solid;
        margin-top: -5px;
        float: right;
        color: #FFF!important;
    }
    .more-tbl {
        width: 100%!important;
        text-align: center;
        margin-bottom: 0px!important;
    }
    .more-tbl > thead > tr > th, .table-bordered > tbody > tr > td {
        text-align: center!important;
        vertical-align: middle;
    }
    .more-tbl > tbody > tr > td:nth-child(1){
        width: 25%!important;
    }
    .more-tbl > tbody > tr > td:nth-child(2){
        width: 25%!important;
    }
    .more-tbl > tbody > tr > td:nth-child(3){
        width: 15%!important;
    }
    .more-tbl > tbody > tr > td:nth-child(4){
        width: 15%!important;
    }
    .more-tbl > tbody > tr > td:nth-child(5){
        width: 20%!important;
    } 

    .tbl-td > tbody > tr > td {
        font-weight: bold;
        font-size: 15px;
    }
    .h-date {
        text-align: right;
        width: 100%;
    }
    .m-btm {
        margin-bottom: 10px;
    }
    .p-lft {
        padding-left: 0px!important;
    }
    .p-rgt {
        padding-right: 0px!important;
    }
    .tb-pretun {
        width: 100%;
    }
    .tb-pretun > tbody > tr > td:nth-child(1){
        width: 48%;
        text-align: right;
    }
    .tb-pretun > tbody > tr > td:nth-child(2){
        width: 60%;
        text-align: left!important;
    }
    .tb-pretuns {
        width: 100%;
    }
    .tb-pretuns > tbody > tr > td:nth-child(1){
        width: 30%;
        text-align: right;
    }
    .tb-pretuns > tbody > tr > td:nth-child(2){
        width: 70%;
        text-align: left!important;
    }
    .xsb {
        padding: 2px 10px;
    }
    .form-control {
        text-align: center!important;
    }
</style>
<script>


    /* add multiple attach file  */
    var i=1;
    function addMulti_file(){
        appPrt = $(".append_attach_file_part").html().replace(/VR/g, i);
        $(".append_attach_file_here").append(appPrt);
        i++;
    }
    
    function remove_file(id) {
        $('#total' + id).remove();

        gtotal_price2=0.0;
        $(".paid2").each ( function() {

            gtotal_price2 += parseFloat ( $(this).html().replace(/\s/g,'').replace(',','.'));
        });
        $("#gptotal_price").html(gtotal_price2.toFixed(2));
    }


    function checkpurpose(vl,i){  
        if(vl==5){
            $("#purpose"+i).show();
        }else{
            $("#purpose"+i).hide();
        }
    }

</script>

<div class="append_attach_file_part" style="display: none;">
    <div id="totalVR" style="display: block;"> 
        <table class="table table-bordered more-tbl"> 
            <tbody> 
                <tr> 
                     <td>
                    <input name="data[Requisitiondetail][VR][product_id]" type="hidden"  id="pediVR" />


                    <input name="data[Requisitiondetail][VR][measure_id]" type="hidden"  id="measure_idVR" />

                     <input name="data[Requisitiondetail][VR][product_code]" class="form-control" type="text" onkeyup="codeVerify(this.value,VR);" id="product_codeVR" required="required" placeholder="Code" />


                     </td>
                       <td> <span id="pidVR"></span></td>

                    <td> <input name="data[Requisitiondetail][VR][product_name]" class="form-control" type="text" onkeyup="codeVerify(this.value,VR);" placeholder="Name" id="product_nameVR" required="required" /></td>
                    <td><input type="text" name="data[Requisitiondetail][VR][quantity]" id="quantityVR" class="form-control" placeholder="Quantity"></td>
                    <td><input type="text" name="data[Requisitiondetail][VR][measure_name]" id="measure_nameVR"  class="form-control" placeholder="Unit"></td>

                    <td><?php echo $this->Form->input("Requisitiondetail.VR.purpose",array('onchange' => "checkpurpose(this.value,VR);",'class'=>'form-horizontal','type'=>'select','options'=>$purpose,'label'=>false,'empty'=>'select purpose','required'));?>
                                    <?php echo $this->Form->input("Requisitiondetail.VR.purposeothers",array('class'=>'form-horizontal purpose','type'=>'text','rows'=>'2','label'=>false,'id'=>'purposeVR','style'=>'display:none'));?> 
                            </td>

                    <td style="padding-bottom: 0px!important;">
                        <div class="pdr15" onclick="addMulti_file()">
                            <button class="btn btn-primary xsb" type="button">
                                <i class=" glyphicon glyphicon-shopping-cart" style="cursor: pointer"></i> Add to cart
                            </button> 
                        </div>
                        <div class="pdr15" onclick="remove_file(VR)" style="margin-top: 2px;">
                            <i class="fa fa-minus-square" style="cursor: pointer; color: red"></i>
                        </div>
                    </td> 
                </tr>
            </tbody>
        </table>        
    </div>
</div>

<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('New Requisition'); ?> 
                <span class="ad-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-mail-reply"></span> Back'), array('controller' => 'stocks','action' => 'dashboardrequisitioner'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?> 
                </span>
            </h3>
        </div>
        <div class="panel-body">  
            <div class="col-sm-10 col-sm-offset-1">
                 
                <div style="clear: both; height: 5px;"></div>

                <?php echo $this->Form->create('Requisition',array('class'=>'form-horizontal','url' => array('controller'=>'requisitions','action'=>'add'))); ?> 
                <table class="table table-bordered more-tbl">
                    <thead>
                        <tr> 
                            <th colspan="6">Product</th> 
                            <th rowspan="2">More</th>
                        </tr>
                        <tr> 
                         
                            <th>Code</th>
                            <th>Stock</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit</th> 
                            <th>Purpose</th> 
                        </tr>
                    </thead>
                    <tbody>  
                        <tr> 
                            <td>
                            <input name="data[Requisitiondetail][0][product_id]" type="hidden"  id="pedi0" />
                            <input name="data[Requisitiondetail][0][measure_id]" type="hidden"  id="measure_id0" />


                             <input name="data[Requisitiondetail][0][product_code]" class="form-control" type="text" onkeyup="codeVerify(this.value,0);" id="product_code0" required="required" placeholder="Code" />


                             </td>

                              <td> <span id="pid0"></span></td>
                            <td> <input name="data[Requisitiondetail][0][product_name]" class="form-control" type="text" onkeyup="codeVerify(this.value,0);" placeholder="Name" id="product_name0" required="required" /></td>
                            <td><input type="text" name="data[Requisitiondetail][0][quantity]" id="quantity0" class="form-control" placeholder="Quantity"></td>
                            <td><input type="text" name="data[Requisitiondetail][0][measure_name]" id="measure_name0"  class="form-control" placeholder="Unit"></td>

                            <td><?php echo $this->Form->input("Requisitiondetail.0.purpose",array('onchange' => "checkpurpose(this.value,0);",'class'=>'form-horizontal','type'=>'select','options'=>$purpose,'label'=>false,'empty'=>'select purpose','required'));?>
                                    <?php echo $this->Form->input("Requisitiondetail.0.purposeothers",array('class'=>'form-horizontal purpose','type'=>'text','rows'=>'2','label'=>false,'id'=>'purpose0','style'=>'display:none'));?> 
                            </td>
                            
                            <td>
                                <div class="pdr15" onclick="addMulti_file()">
                                    <button class="btn btn-primary xsb" type="button">
                                        <i class=" glyphicon glyphicon-shopping-cart" style="cursor: pointer"></i> Add to cart
                                    </button> 
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="append_attach_file_here"></div>
                <div style="clear: both; height: 20px;"></div> 
                <div class="col-sm-12 p-rgt p-lft text-center">  
                    <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Submit</button>
                </div>
                <div style="clear: both; height: 3px;"></div>
                  <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
</div>