<?php 
    echo $this->Html->script('jquery-ui');
	echo $this->Html->css('jquery-ui');
?>
<style>
    .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    width: 100px;
}
.lgd{
        color: #0088cc; 
        font-family: inherit; 
        font-weight: bold;
    }
    .thla th{
        text-align: left;
        background-color: #0088cc;
        color: #fff;
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

 </script>
 <script>
$(function() {

	$("#datepicker").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
        changeYear: true,
        yearRange:"-100:+50"
	});


});
</script>
 <div class="append_attach_file_part" style="display: none;">
    <div id="totalVR" style="display: block;">
        <table class="table table-striped table-bordered table-hover cntr">
            <tbody >
                <tr>
                    <td>
                    
                     <select name="data[Purchasedetail][VR][product_id]" class="form-horizontal" id="PurchasedetailVRProductId" required="required">
							<option value="">Select</option>
							
							<?php foreach ($products as $product){
								
							$description=$product['Category']['name'].'->'.$product['SubCategory']['name'].'->'.$product['Product']['name'];
						    if(!empty($product['Brand']['name'])){
						    	$description.='->'.$product['Brand']['name'];
						    }
							if(!empty($product['Color']['name'])){
						    	$description.='->'.$product['Color']['name'];
						    }
						    if(!empty($stock['Size']['name'])){
						    	$description.='->'.$product['Size']['name'];
						    }
							
							?>
							<option value="<?php echo $product['Product']['id'];?>"><?php echo $description;?></option>
							<?php }?>
							
							
						</select>
                        <?php //echo $this->Form->input('Purchasedetail.VR.product_id',array('class'=>'form-horizontal','empty'=>'Select','label'=>false)); ?>
                    </td>
                    
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.price',array('class'=>'form-horizontal purchasedetailPriceVR','label'=>false,'id'=>'p_priceVR','type'=>'text')); ?>
                   </td>
                    
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.quantity',array('onkeyup'=>'calPro(this.value,VR);','class'=>'form-horizontal amount2','type'=>'number','label'=>false,'id'=>'p_unit0')); ?>
                    </td>
                    
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.measure_id',array('class'=>'form-horizontal','label'=>false)); ?>
                    </td>
                        
                     <td id="total_p_priceVR" class="paid2">
                            0
                     </td>
                    
                    <td>
                    	<div class="fl pdr15" onclick="remove_file(VR)"><i class="fa fa-minus" style="cursor: pointer; color: red"></i></div>
                	</td>
                </tr>
            </tbody>
        </table>
       
    </div>
</div>
 
<div class="purchases form">
<?php echo $this->Form->create('Purchase',array('type'=>'file','class'=>'form-horizontal')); ?>
    <fieldset>			
        <div class="container" style="margin-top:50px;">	
            <legend class="lgd"><?php echo __('Add Product'); ?></legend>

            <div class="form-group">
                <div class="col-md-2">
                    <label>Purchase Date</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input ('created', array ('type'=>'text','id'=>'datepicker','class'=>'form-input-text form-control','label'=>false) );?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>Invoice No</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input('invoice',array('label'=>false,'div'=>false,'class'=>'form-control'));?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>Supplier Name</label>
                </div>	
                <div class="col-md-4">
                
                <select name="data[Purchase][supplier_id]" class="form-control" onchange="checkpurpose(this.value);" id="PurchaseSupplierId" required="required">
					<option value="">select</option>
					<?php foreach($suppliers as $key=>$supplier){?>
						<option value="<?php echo $key;?>"><?php echo $supplier;?></option>
					<?php }?>
				
					<option value="0">Others</option>
				</select>
				<br/>
				<?php echo $this->Form->input("Purchase.supplier_other_id",array('class'=>'form-control purpose','type'=>'text','label'=>false,'id'=>'purpose'));?>	
                  <?php //echo $this->Form->input('supplier_id',array('label'=>false,'div'=>false,'type'=>'select','class'=>'form-control'));?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-10">
                  <!-- add more -->
                    <div class="table-responsive">
                    
                        <table class="table table-striped table-bordered table-hover cntr thla">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                     <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Total Price</th>

                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr >
                                    <td>
                                    
                                    <select name="data[Purchasedetail][0][product_id]" class="form-horizontal" id="Purchasedetail0ProductId" required="required">
										<option value="">Select</option>
										
										<?php foreach ($products as $product){
											
										$description=$product['Category']['name'].'->'.$product['SubCategory']['name'].'->'.$product['Product']['name'];
									    if(!empty($product['Brand']['name'])){
									    	$description.='->'.$product['Brand']['name'];
									    }
										if(!empty($product['Color']['name'])){
									    	$description.='->'.$product['Color']['name'];
									    }
									    if(!empty($stock['Size']['name'])){
									    	$description.='->'.$product['Size']['name'];
									    }
										
										?>
										<option value="<?php echo $product['Product']['id'];?>"><?php echo $description;?></option>
										<?php }?>
										
										
									</select>
                                        <?php
									//'onChange'=>'getSubcategory(this.value,0);',
                                        
                                        //echo $this->Form->input('Purchasedetail.0.product_id',array('class'=>'form-horizontal','empty'=>'Select','label'=>false)); ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.price',array('class'=>'form-horizontal purchasedetailPrice0','label'=>false,'id'=>'p_price0','required'=>false,'type'=>'text')); ?>
                                    
                         </td>
	
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.quantity',array('onkeyup'=>'calPro(this.value,0);','class'=>'form-horizontal amount2','label'=>false,'id'=>'p_unit0')); ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.measure_id',array('class'=>'form-horizontal','label'=>false)); ?>
                                        
                                        
                                    </td>
                                    
                                    <td id="total_p_price0" class="paid2">
                                        0
                                    </td>
                                    
                                    <td>
                                        <div class="fl pdr15" onclick="addMulti_file()"><i class="fa fa-plus" style="cursor: pointer"></i></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="append_attach_file_here"></div>
                         <table class="table table-striped table-bordered table-hover cntr ">
                            <thead>
                                <tr>
                                 
                                    <th>Grand Total Price</th>

                                    <th id="gptotal_price">0</th>
                                </tr>
                            </thead>
                            </table>
                </div>
                                                         <!-- add more End -->
               </div>
                    </div>
            
                    <div class="form-group">
                        <div class="col-md-2">
                            <label></label>
                        </div>	
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
                        </div>
                    </div>
            
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>



<script type="text/javascript">
	$(document).ready( function($){
		$(".purpose").hide();
	});
	function checkpurpose(vl){  
	    if(Number(vl)>0 || vl==''){
	    	
	    	$("#purpose").hide();
		}else{
			$("#purpose").show();
		}
	}

	function calPro(bb,b){

		
		var p_price = parseFloat(document.getElementById('p_price'+b).value);
		var p_unit = parseFloat(bb);

		document.getElementById('total_p_price'+b).innerHTML = (p_price * p_unit).toFixed(2);

		gtotal_price2=0.0;
		$(".paid2").each ( function() {

			gtotal_price2 += parseFloat ( $(this).html().replace(/\s/g,'').replace(',','.'));
		});
		$("#gptotal_price").html(gtotal_price2.toFixed(2));
		//document.getElementById('gptotal_price').value = parseFloat(document.getElementById('gptotal_price').value)+(p_price * p_unit);

	}


	$(document).ready ( function () {
			$(".amount2").keyup(function(event) {
				gtotal_price2=0.0;
				$(".paid2").each ( function() {

					gtotal_price2 += parseFloat ( $(this).html().replace(/\s/g,'').replace(',','.'));
				});
				$("#gptotal_price").html(gtotal_price2.toFixed(2));
			});


	});


	var path='<?php echo $this->webroot;?>';
	function getSubcategory(id,did){
	
	 	$.ajax({
	 		type: 'POST',
	 		url: path +'products/getprice',
	 		data: {id:id},
	 		success: function(data){

	 			$('.purchasedetailPrice' + did).val(data);
	 			  		
	 		}
	 	});
	
	 }
 </script>

