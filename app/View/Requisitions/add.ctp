<?php 
    echo $this->Html->script('jquery-ui');
	echo $this->Html->css('jquery-ui');
?>
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
    }
    
 </script>

 <div class="append_attach_file_part" style="display: none;">
    <div id="totalVR" style="display: block;">
        <table class="table table-striped table-bordered table-hover cntr">
            <tbody >
                <tr>
                	<td>
                        <?php echo $this->Form->input('Requisitiondetail.VR.product_id',array('onChange'=>'getSubcategory(this.value,VR);','class'=>'form-horizontal','empty'=>'Select','label'=>false)); ?>
                    </td>

                    

	                    <?php echo $this->Form->input('Requisitiondetail.VR.price',array('class'=>'form-horizontal requisitiondetailPriceVR','label'=>false,'id'=>'requisitiondetailPriceVR','type'=>'hidden')); ?>
				
															
                    <td>
                        <?php echo $this->Form->input('Requisitiondetail.VR.quantity',array('class'=>'form-horizontal','type'=>'number','label'=>false)); ?>
                    </td>
                    
                    <td>
                        <?php echo $this->Form->input('Requisitiondetail.VR.measure_id',array('class'=>'form-horizontal','empty'=>'Select','label'=>false)); ?>
                    </td>
                    <td>
                    	<div class="fl pdr15" onclick="remove_file(VR)"><i class="fa fa-minus" style="cursor: pointer; color: red"></i></div>
                	</td>
                </tr>
            </tbody>
        </table>
       
    </div>
</div>
<div class="payments form">
<?php echo $this->Form->create('Requisition',array('class'=>'form-horizontal')); ?>
	<fieldset>
					
	
	<legend><?php echo __('Add Requisition'); ?></legend>
	 <div class="form-group" >
		<div class="col-md-2">
			 <label>Location</label>
		 </div>	
		 <div class="col-md-4">
		 <?php echo $this->Form->input('location',array('class'=>'form-control','label'=>false));?>
		
		 </div>
	 </div>

	<table class="table table-striped table-bordered table-hover cntr ">
													<thead>
													<tr>
														<th>Product name</th>
														<th>Quantity</th>
														<th>Measurement</th>
 									                    <th></th>
														 
													</tr>
													</thead>
													 
													<tbody>
														<tr >
															<td>
																<?php echo $this->Form->input('Requisitiondetail.0.product_id',array('onChange'=>'getSubcategory(this.value,0);','class'=>'form-horizontal','id' => 'log','empty'=>'Select','label'=>false)); ?>
															</td>
															
														
															   
															    <?php echo $this->Form->input('Requisitiondetail.0.price',array('class'=>'form-horizontal requisitiondetailPrice0','label'=>false,'id'=>'requisitiondetailPrice0','required'=>false,'type'=>'hidden')); ?>
															
															
															<td>
																<?php echo $this->Form->input('Requisitiondetail.0.quantity',array('class'=>'form-horizontal','label'=>false)); ?>
															</td>

															
															<td>
																<?php echo $this->Form->input('Requisitiondetail.0.measure_id',array('class'=>'form-horizontal','label'=>false,'empty'=>'Select')); ?>
															</td>
 															<td>
																<div class="fl pdr15" onclick="addMulti_file()"><i class="fa fa-plus" style="cursor: pointer"></i></div>
															</td>
														</tr>
													</tbody>
												</table>
												<div class="append_attach_file_here"></div>

	<div class="form-group" >
		<div class="col-md-2">
			 <label>Purpose</label>
		 </div>	
		 <div class="col-md-4">
		 <?php echo $this->Form->input('purpose',array('class'=>'form-control','type'=>'textarea','label'=>false));?>
		
		 </div>
	</div>

	 
	
		 <?php echo $this->Form->input('status',array('class'=>'form-control','label'=>false,'default'=>1,'type'=>'hidden'));?>
	

	 	  	 	  	 	 	 
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
<!-- <div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Deliveries'), array('controller' => 'deliveries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Delivery'), array('controller' => 'deliveries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requisitions'), array('controller' => 'requisitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requisition'), array('controller' => 'requisitions', 'action' => 'add')); ?> </li>
	</ul>
</div> -->
<script type="text/javascript">
	var path='<?php echo $this->webroot;?>';
	function getSubcategory(id,did){
	
	 	$.ajax({
	 		type: 'POST',
	 		url: path +'products/getprice',
	 		data: {id:id},
	 		success: function(data){

	 			$('.requisitiondetailPrice' + did).val(data);
	 			  		
	 		}
	 	});
	
	 }
 </script>