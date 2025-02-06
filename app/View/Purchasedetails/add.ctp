<div class="purchasedetails form">
<?php echo $this->Form->create('Purchasedetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Purchasedetail'); ?></legend>
	<?php
                echo $this->Form->input('product_id');
		echo $this->Form->input('purchase_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('price');
		echo $this->Form->input('measure_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Purchasedetails'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Purchases'), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase'), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
