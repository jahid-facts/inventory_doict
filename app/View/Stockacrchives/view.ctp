<div class="stockacrchives view">
<h2><?php echo __('Stockacrchive'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stockacrchive['Stockacrchive']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($stockacrchive['Product']['name'], array('controller' => 'products', 'action' => 'view', $stockacrchive['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('StockIn'); ?></dt>
		<dd>
			<?php echo h($stockacrchive['Stockacrchive']['stockIn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('StockOut'); ?></dt>
		<dd>
			<?php echo h($stockacrchive['Stockacrchive']['stockOut']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Balance'); ?></dt>
		<dd>
			<?php echo h($stockacrchive['Stockacrchive']['balance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sdate'); ?></dt>
		<dd>
			<?php echo h($stockacrchive['Stockacrchive']['sdate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stockacrchive'), array('action' => 'edit', $stockacrchive['Stockacrchive']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Stockacrchive'), array('action' => 'delete', $stockacrchive['Stockacrchive']['id']), array(), __('Are you sure you want to delete # %s?', $stockacrchive['Stockacrchive']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stockacrchives'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stockacrchive'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
