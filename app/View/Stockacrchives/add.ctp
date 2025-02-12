<div class="stockacrchives form">
<?php echo $this->Form->create('Stockacrchive'); ?>
	<fieldset>
		<legend><?php echo __('Add Stockacrchive'); ?></legend>
	<?php
		echo $this->Form->input('product_id');
		echo $this->Form->input('stockIn');
		echo $this->Form->input('stockOut');
		echo $this->Form->input('balance');
		echo $this->Form->input('sdate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Stockacrchives'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
