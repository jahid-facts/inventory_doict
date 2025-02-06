<div class="deliveries form">
<?php echo $this->Form->create('Delivery',array('type'=>'file','class'=>'form-horizontal'));
      echo $this->Form->input('id');
?>
    <fieldset>			
        <div class="container" style="margin-top:50px;">	
            <legend><?php echo __('Add Delivery'); ?></legend>
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>User</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input('user_id',array('label'=>false,'div'=>false,'type'=>'select','class'=>'form-control'));?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>Product</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input('product_id',array('label'=>false,'div'=>false,'type'=>'select','class'=>'form-control'));?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>Order</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('orderid',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>
                       
            <div class="form-group">
                <div class="col-md-2">
                    <label>Requisitionno</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('requisitionno',array('class'=>'form-control','label'=>false));?>
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



<!--<div class="deliveries form">
<?php echo $this->Form->create('Delivery'); ?>
	<fieldset>
		<legend><?php echo __('Edit Delivery'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('orderid');
		echo $this->Form->input('requisitionno');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Delivery.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Delivery.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Deliveries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
