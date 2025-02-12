<div class="requisitionretunrs form">
<?php echo $this->Form->create('Requisitionretunr'); ?>
	<fieldset>
		<legend><?php echo __('Add Requisitionretunr'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Requisitionretunrs'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>
