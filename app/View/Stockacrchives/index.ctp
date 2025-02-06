<div class="stockacrchives index">
	<h2><?php echo __('Stockacrchives'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('stockIn'); ?></th>
			<th><?php echo $this->Paginator->sort('stockOut'); ?></th>
			<th><?php echo $this->Paginator->sort('balance'); ?></th>
			<th><?php echo $this->Paginator->sort('sdate'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($stockacrchives as $stockacrchive): ?>
	<tr>
		<td><?php echo h($stockacrchive['Stockacrchive']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($stockacrchive['Product']['name'], array('controller' => 'products', 'action' => 'view', $stockacrchive['Product']['id'])); ?>
		</td>
		<td><?php echo h($stockacrchive['Stockacrchive']['stockIn']); ?>&nbsp;</td>
		<td><?php echo h($stockacrchive['Stockacrchive']['stockOut']); ?>&nbsp;</td>
		<td><?php echo h($stockacrchive['Stockacrchive']['balance']); ?>&nbsp;</td>
		<td><?php echo h($stockacrchive['Stockacrchive']['sdate']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $stockacrchive['Stockacrchive']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $stockacrchive['Stockacrchive']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $stockacrchive['Stockacrchive']['id']), array(), __('Are you sure you want to delete # %s?', $stockacrchive['Stockacrchive']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Stockacrchive'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
