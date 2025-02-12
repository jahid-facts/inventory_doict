
<?php 
    echo $this->Html->script('jquery-ui');
	echo $this->Html->css('jquery-ui');
?>
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
 <div class="payments form">

	<fieldset>
					 
		<div class="container" style="margin-top:50px;">	
			<legend><?php echo __('Requisition Form Submit'); ?></legend>
			<div class="container" style="margin-top:50px;">	
				<?php echo $this->Form->create('Requisition',array('class'=>'form-horizontal','url' => array('controller'=>'requisitions','action'=>'add'))); ?> 
				<div class="form-group" >
					<div class="col-md-2">
						 <label>Department</label>
					 </div>	
					 <div class="col-md-2">
					 <?php echo $this->Form->input('location',array('class'=>'form-control','label'=>false,'value'=>$users['Department']['name']));?>
					
					 </div>
				</div>								
		  
				<table class="table table-striped table-bordered table-hover cntr ">
					<thead>
						<tr>
							<th>Product name</th>
							<th>Quantity</th>
							<!--<th>Unit</th>-->
							<th>Purpose</th> 
						</tr>
					</thead>										 
					<tbody>
						<?php 

				$i=0;
						foreach ($stocks as $key=>$stock) {
							


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
							<td>
								<?php 

								echo $this->Form->input("Requisitiondetail.$i.product_id",array('type'=>'hidden','class'=>'form-horizontal','label'=>false,'value'=>$stock['Product']['id']));


								 ?>

								<?php echo $description;?>
								 <span style="color:green; font-weight: bold;">(<?php
								 	echo $balance;

								  ?>)</span>
								  
								  
								  
						    <?php echo $this->Form->input("Requisitiondetail.$i.valid",array('type'=>'hidden','value'=>$balance,'id'=>'ck'.$key)); ?>
							</td>
							<td>
								<?php echo $this->Form->input("Requisitiondetail.$i.quantity",array('onchange' => "checkqty(this.value,$key);",'type'=>'text','class'=>'form-horizontal','label'=>false,'id'=>'ckq'.$key)); ?>
							
							</td>
							
								<?php echo $this->Form->input("Requisitiondetail.$i.measure_id",array('value'=>$stock['Measure']['id'], 'type'=>'hidden')); ?>
							
							<td>
								<?php echo $this->Form->input("Requisitiondetail.$i.purpose",array('onchange' => "checkpurpose(this.value,$key);",'class'=>'form-horizontal','type'=>'select','options'=>$purpose,'label'=>false,'empty'=>'select purpose','required'));?>
									<?php echo $this->Form->input("Requisitiondetail.$i.purposeothers",array('class'=>'form-horizontal purpose','type'=>'text','rows'=>'2','label'=>false,'id'=>'purpose'.$key));?>										
							</td>
					    </tr>
					<?php $i++; } ?>
				    </tbody>
				</table>

		 		<?php echo $this->Form->input('status',array('class'=>'form-control','label'=>false,'default'=>1,'type'=>'hidden'));?>

		 	  	 	 	 
				<div class="form-group">
					<div class="col-sm-9">
						 <label></label>
						 
					</div>	
					<div class="col-sm-3">
					 
					<?php 
								echo $this->Form->button ( 'SUBMIT', array ('class'=>'btn btn-default btn','onclick' => "confirmation();",'style'=>'background-color:#428BCA;color:white;display: none;','type'=>'button') );
							
							?>
					 
					</div>
			    </div>
		    
		    </div>
		</div>
	</fieldset>
</div>

<script>
	$(document).ready( function($){
		$(".purpose").hide();
	});
	function checkqty(vl,i){  
			var qty=$("#ck"+i).val();
	        if(Number(vl)>Number(qty)){
		        alert('Please input less than items stock');
		        $(".btn").hide();
	    	}else{
	    		$(".btn").show();
	    	}
	}
	function checkpurpose(vl,i){  
        if(vl==5){
        	$("#purpose"+i).show();
    	}else{
    		$("#purpose"+i).hide();
    	}
	}

	function confirmation(){
	 
		var cond = confirm("Are you sure that you have submitted your items");
		if(cond == true){
			$('#RequisitionRequsitionForm').submit();
		}else{
		}
	}
</script>