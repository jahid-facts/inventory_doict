<?php 
    echo $this->Html->script('jquery-ui');
	echo $this->Html->css('jquery-ui');
    echo $this->Html->css('inventory-style');
?>
<style>
    .col-sm-offset-3 {
        margin-top: 15px;
    } 
    .form-group {
      padding-right: 0px;
    }
    select .spans {
        font-weight: bold;
        color: #5d0c1f!important; 
    }
    .plr-fg {
        padding-left: 15px;
        padding-right: 15px;
    }
</style> 
<script>

var path='<?php echo $this->webroot;?>';
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
    function codeVerify(code,id){ 
        $.ajax({
            type: 'POST',
            url: path +'products/scode',
            data: {code:code},
            success: function(data){
                var res = data.split("/"); 
                $('#pid'+id).html(res[0]);
                $('#pname'+id).html(res[1]);
                $('#pedi'+id).val(res[2]);             
            }
        });
    }
</script>
 <div class="append_attach_file_part" style="display: none;">
    <div id="totalVR" style="display: block;"> 
        <table class="table table-bordered custable"> 
            <tbody>
                <tr class="th-width">
                    <td> 
                        <input name="data[Purchasedetail][VR][product_id]" type="hidden"  id="pediVR" /> 
                        <input name="data[Purchasedetail][VR][product_code]" type="text" class="w-100 form-horizontal" id="PurchasedetailVRProductId" onkeyup="codeVerify(this.value,VR);" required="required">
                           
                    </td>
                    <!-- <td> </td> -->
                     <td> <span id="pidVR"></span></td>
                     <td> <span id="pnameVR"></span></td> 
                    <td>
                        <?php 
                            echo $this->Form->input('Purchasedetail.VR.price',array('class'=>'w-100 form-horizontal purchasedetailPriceVR','label'=>false,'id'=>'p_priceVR','type'=>'text')); 
                            echo $this->Form->input('Purchasedetail.VR.district_id',array('type'=>'hidden','value'=>$currentUser['district_id']));
                        ?>
                    </td>
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.quantity',array('onkeyup'=>'calPro(this.value,VR);','class'=>'w-100 form-horizontal amount2','type'=>'number','label'=>false,'id'=>'p_unit0')); ?>
                    </td> 
                    <td>
                        <?php echo $this->Form->input('Purchasedetail.VR.measure_id',array('class'=>'w-100 form-horizontal','label'=>false)); ?>
                    </td>
                    <td id="total_p_priceVR" class="paid2">
                        0
                    </td>
                    <td id="total_p_balanceVR" class="paid3"></td>
                    <td>
                        <div class="pdr15" onclick="remove_file(VR)"><i class="fa fa-minus" style="cursor: pointer; color: red"></i></div>
                    </td>
                </tr>
            </tbody>
        </table>
       
    </div>
</div>
 
<div class="col-sm-12">
<?php echo $this->Form->create('Purchase',array('type'=>'file','class'=>'form-horizontal')); ?>
   		
        <div class="panel panel-primary" style="margin-top:20px;">	
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Purchase Product'); ?></h3> 
            </div>
            <div class="panel-body">
            
                <div class="col-sm-4">
                    <div class="form-group plr-fg">
                        <label>Purchase Date</label>
                        <?php echo $this->Form->input ('created', array ('type'=>'text','id'=>'datepicker','class'=>'form-input-text form-control','label'=>false,'required'=>'required','autocomplete'=>'off'));?> 
                    </div>
                </div>

                <div class="col-sm-4">    
                    <div class="form-group plr-fg"> 
                        <label>Invoice No.</label>  
                        <?php echo $this->Form->input('invoice',array('label'=>false,'div'=>false,'class'=>'form-control','autocomplete'=>'off'));?> 
                    </div>
                </div>

                <div class="col-sm-4">   
                    <div class="form-group plr-fg"> 
                        <label>Supplier Name</label>  
                        <select name="data[Purchase][supplier_id]" class="form-control" onchange="checkpurpose(this.value);" id="PurchaseSupplierId">
                            <option value="">Select Name</option>
                            <?php foreach($suppliers as $key=>$supplier){?>
                                <option value="<?php echo $key;?>"><?php echo $supplier;?></option>
                            <?php }?>
                        
                            <option value="0" class="spans">Add new supplier</option>
                        </select>                          
                    </div>
                </div> 

                <div style="clear: both;">
                    <div class="col-sm-4">
                        <div class="form-group plr-fg">
                            <?php echo $this->Form->input("Purchase.supplier_other_id",array('class'=>'form-control purpose','type'=>'text','label'=>false,'id'=>'purpose','placeholder'=>'Supplier Name'));?> 
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group plr-fg">
                            <?php echo $this->Form->input("Purchase.mobile",array('class'=>'form-control purpose','type'=>'text','label'=>false,'id'=>'suppliermobile','placeholder'=>'Supplier Phone'));?>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group plr-fg">
                            <?php echo $this->Form->input("Purchase.email",array('class'=>'form-control purpose','type'=>'text','label'=>false,'id'=>'supplieremail','placeholder'=>'Supplier E-mail'));?> 
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group plr-fg">
                            <?php 
                                echo $this->Form->input("Purchase.address",array('class'=>'form-control purpose','type'=>'textarea','label'=>false,'id'=>'supplieraddress','placeholder'=>'Supplier Address','rows'=>1));
                                echo $this->Form->input('district_id',array('type'=>'hidden','value'=>$currentUser['district_id'])); 
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                  <!-- add more -->
                    <div class="table-responsive">
                        <table class="table table-bordered custable">
                            <thead>
                                <tr>
                                    <th colspan="3">Product</th>
                                    <th colspan="4">Purchase New Product</th>
                                    <th rowspan="2">Total Product</th>
                                    <th rowspan="2">More</th>
                                </tr>
                                <tr>
                                    <th>Code</th> 
                                    <th>Name</th>
                                    <!-- <th>Barcode</th> -->
                                    <th>Balance</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Total Price</th>    
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="th-width">
                                    <td>
                                    
                                        <input name="data[Purchasedetail][0][product_id]" type="hidden"  id="pedi0" />


                                         <input name="data[Purchasedetail][0][product_code]" class="w-100 form-horizontal" type="text" onkeyup="codeVerify(this.value,0);" id="Purchasedetail0ProductId" required="required" />
                                           
                                    </td>
                            
                                    <td> <span id="pid0"></span></td>
                                    <td> <span id="pname0"></span></td> 
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.price',array('class'=>'w-100 form-horizontal purchasedetailPrice0','label'=>false,'id'=>'p_price0','required'=>false,'type'=>'text')); ?> 
                                    </td>
                                    <td>
                                        <?php echo $this->Form->input('Purchasedetail.0.quantity',array('onkeyup'=>'calPro(this.value,0);','class'=>'w-100 form-horizontal amount2','label'=>false,'id'=>'p_unit0')); ?>
                                    </td> 
                                    <td>
                                        <?php 
                                            echo $this->Form->input('Purchasedetail.0.measure_id',array('class'=>'w-100 form-horizontal','label'=>false)); 
                                            echo $this->Form->input('Purchasedetail.0.district_id',array('type'=>'hidden','value'=>$currentUser['district_id']));
                                        ?> 
                                    </td>
                                    <td id="total_p_price0" class="paid2">
                                        0
                                    </td>
                                    <td id="total_p_balance0" class="paid3"></td>
                                    <td>
                                        <div class="pdr15" onclick="addMulti_file()"><i class="fa fa-plus" style="cursor: pointer"></i></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
                        <div class="append_attach_file_here"></div>
                        <table class="table table-bordered custable">
                            <tbody>
                                <tr>
                                 
                                    <td colspan="6" width="71.2%">Grand Total Price</td>

                                    <td id="gptotal_price" colspan="3" style="text-align: left!important;">0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                         
                </div>  
                <div style="clear: both; height: 15px;"></div>
                <div class="col-sm-12 text-center">
                    <?php echo $this -> Html -> link('&nbsp;&nbsp;Back&nbsp;&nbsp;', array('controller' => 'purchases', 'action' => 'purchasereport'),array('class'=>'btn btn-warning','escape'=>false)); ?>
                    <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">&nbsp;&nbsp;Save&nbsp;&nbsp;</button>
                </div> 
            
        </div> 
        <?php echo $this->Form->end(); ?>
</div>
 



<script type="text/javascript">
	$(document).ready( function($){
		$(".purpose").hide();
	});
	function checkpurpose(vl){  
	    if(Number(vl)>0 || vl==''){
	    	
	    	$(".purpose").hide();
		}else{
			$(".purpose").show();
		}
	}

	function calPro(bb,b){

		
		var p_price = parseFloat(document.getElementById('p_price'+b).value);
		var p_unit = parseFloat(bb);

        var balance=parseFloat(document.getElementById('pname'+b).innerHTML);

		document.getElementById('total_p_price'+b).innerHTML = (p_price * p_unit).toFixed(2);

        document.getElementById('total_p_balance'+b).innerHTML = (balance + p_unit);

        

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