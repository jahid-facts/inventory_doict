<div class="orders form">
<?php echo $this->Form->create('Order'); ?>
	<fieldset>
		<legend><?php echo __('Add Order'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('mobile');
		echo $this->Form->input('email');
		echo $this->Form->input('address');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Orders'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Orderdetails'), array('controller' => 'orderdetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Orderdetail'), array('controller' => 'orderdetails', 'action' => 'add')); ?> </li>
	</ul>
</div>
