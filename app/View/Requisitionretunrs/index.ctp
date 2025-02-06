<div class="requisitionretunrs index">
	<h2><?php echo __('Requisitionretunrs'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('measure_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rnumber'); ?></th>
			<th><?php echo $this->Paginator->sort('ddate'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($requisitionretunrs as $requisitionretunr): ?>
	<tr>
		<td><?php echo h($requisitionretunr['Requisitionretunr']['id']); ?>&nbsp;</td>
		<td><?php echo h($requisitionretunr['Requisitionretunr']['quantity']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($requisitionretunr['Product']['name'], array('controller' => 'products', 'action' => 'view', $requisitionretunr['Product']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($requisitionretunr['Measure']['name'], array('controller' => 'measures', 'action' => 'view', $requisitionretunr['Measure']['id'])); ?>
		</td>
		<td><?php echo h($requisitionretunr['Requisitionretunr']['rnumber']); ?>&nbsp;</td>
		<td><?php echo h($requisitionretunr['Requisitionretunr']['ddate']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $requisitionretunr['Requisitionretunr']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $requisitionretunr['Requisitionretunr']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $requisitionretunr['Requisitionretunr']['id']), array(), __('Are you sure you want to delete # %s?', $requisitionretunr['Requisitionretunr']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Requisitionretunr'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>
