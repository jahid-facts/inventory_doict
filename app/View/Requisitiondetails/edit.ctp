<div class="requisitiondetails form">
<?php echo $this->Form->create('Requisitiondetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Requisitiondetail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('requisition_id');
		echo $this->Form->input('price');
		echo $this->Form->input('measure_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Requisitiondetail.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Requisitiondetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Requisitiondetails'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Requisitions'), array('controller' => 'requisitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requisition'), array('controller' => 'requisitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
