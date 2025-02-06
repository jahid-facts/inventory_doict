<div class="deliverydetails form">
<?php echo $this->Form->create('Deliverydetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Deliverydetail'); ?></legend>
	<?php
		echo $this->Form->input('quantity');
		echo $this->Form->input('price');
		echo $this->Form->input('measure_id');
		echo $this->Form->input('deliveries_id');
		echo $this->Form->input('voucher');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Deliverydetails'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deliveries'), array('controller' => 'deliveries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deliveries'), array('controller' => 'deliveries', 'action' => 'add')); ?> </li>
	</ul>
</div>
