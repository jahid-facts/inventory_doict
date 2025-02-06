<script>
  
    function remove_file(id) {
        $('#total' + id).remove();
    }

 </script>
<?php

$stocks=$this->request->data['Requisitiondetail'];

$data=$this->request->data;
?>

<?php echo $this->Form->create('Requisition',array('class'=>'form-horizontal')); ?>
 
<div class="payments form">

 <?php echo $this->Form->input('id');?>
    
	<fieldset>
					
	<div class="container" style="margin-top:50px;">	
	<legend><?php echo __('Requisition Edit'); ?></legend>

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered my-padding-0">
                        <tr>
                            <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name of Requisitioner:</td>
                            <td><?php echo $this->Html->link($data['User']['name'], array('controller' => 'users', 'action' => 'view', $data['Requisition']['user_id'])); ?></td>
                        </tr>
                        <tr>
                            <td>Designation :</td>
                            <td><?php echo h($designations[$data['User']['designation_id']]); ?></td>
                        </tr>
                        <tr>
                            <td>Department :</td>
                            <td><?php echo h($departments[$data['User']['department_id']]); ?></td>
                        </tr>
                        <tr>
                            <td>Phone :</td>
                            <td><?php echo h($data['User']['mobile']); ?></td>
                        </tr>
                        <tr>
                            <td>Email :</td>
                            <td><?php echo h($data['User']['email']); ?></td>
                        </tr>
                        <tr>
                            <td>Delivery location :</td>
                            <td><?php echo h($data['Requisition']['location']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
	<table class="table table-striped table-bordered table-hover cntr ">
		<thead>
		<tr>
			<th>Product name</th>
			<th>Quantity</th>
			<th>Unit</th>
			<th>Purpose</th> 
		</tr>
		</thead>										 
		<tbody>
		<?php 

$i=0;
		foreach ($stocks as $stock) {
//			echo "<pre>";
//			print_r($stock);
//			echo "</pre>";
		?><?php echo $this->Form->input("Requisitiondetail.$i.id");?>
                    
		<tr>
			<td>
				<?php echo $this->Form->input("Requisitiondetail.$i.product_id",array('class'=>'form-horizontal','label'=>false,'id'=>'Requisitiondetail','type'=>'hidden','default'=>$products[$stock['product_id']])); ?>

				<?php echo $products[$stock['product_id']];?>
			</td>
			<td>
				<?php echo $this->Form->input("Requisitiondetail.$i.quantity",array('class'=>'form-horizontal','label'=>false,'value'=>$stock['quantity'])); ?>
				<?php //echo $stock['quantity'];?>
			</td>
			<td>
				<?php echo $this->Form->input("Requisitiondetail.$i.measure_id",array('class'=>'form-horizontal','label'=>false,'type'=>'hidden','value'=>$stock['measure_id'])); ?>
                            <?php echo $measures[$stock['measure_id']];?>
			</td>
			<td>
				<?php echo $this->Form->input("Requisitiondetail.$i.purpose",array('class'=>'form-control','type'=>'hidden','label'=>false));?>
                           <?php echo $stock['purpose'];?>
			</td>
	    </tr>
	<?php $i++; } 
	
	//$userlist = $Usersslist->find('list',array('conditions'=>array('Profiles.user_id'=>$user_id),array('fields'=>array('cell'))));
	
	?>
    </tbody>
	</table>

	 <?php //echo $this->Form->input('status',array('class'=>'form-control','style'=>'width:100px;','label'=>false,'type'=>'select','options'=>array('2'=>'Approved','3'=>'Reject')));?>
	 	  	 	 	 
	<div class="form-group">
		<div class="col-md-2">
			 <label></label>
			 
		 </div>	
		 <div class="col-md-4">
		<button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Approve</button>
		 
		 </div>
	    </div>
	</div>
	</fieldset>
</div>