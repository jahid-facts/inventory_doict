<div class="requisitionreturns form">
<?php echo $this->Form->create('Requisitionreturn'); ?>
	<fieldset>
		<legend><?php echo __('Edit Requisitionreturn'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('product_id');
		echo $this->Form->input('measure_id');
		echo $this->Form->input('rnumber');
		echo $this->Form->input('ddate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Requisitionreturn.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Requisitionreturn.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Requisitionreturns'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>
