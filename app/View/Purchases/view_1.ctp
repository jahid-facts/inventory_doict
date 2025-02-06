<div class="purchases view">
<h2><?php echo __('Purchase'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['invoice']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Supplier'); ?></dt>
		<dd>
			<?php echo $this->Html->link($purchase['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchase['Supplier']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($purchase['Product']['name'], array('controller' => 'products', 'action' => 'view', $purchase['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($purchase['Purchase']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Purchase'), array('action' => 'edit', $purchase['Purchase']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Purchase'), array('action' => 'delete', $purchase['Purchase']['id']), array(), __('Are you sure you want to delete # %s?', $purchase['Purchase']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchasedetails'), array('controller' => 'purchasedetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchasedetail'), array('controller' => 'purchasedetails', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Purchasedetails'); ?></h3>
	<?php if (!empty($purchase['Purchasedetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Purchase Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Measure Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($purchase['Purchasedetail'] as $purchasedetail): ?>
		<tr>
			<td><?php echo $purchasedetail['id']; ?></td>
			<td><?php echo $purchasedetail['purchase_id']; ?></td>
			<td><?php echo $purchasedetail['quantity']; ?></td>
			<td><?php echo $purchasedetail['price']; ?></td>
			<td><?php echo $purchasedetail['measure_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'purchasedetails', 'action' => 'view', $purchasedetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'purchasedetails', 'action' => 'edit', $purchasedetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'purchasedetails', 'action' => 'delete', $purchasedetail['id']), array(), __('Are you sure you want to delete # %s?', $purchasedetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Purchasedetail'), array('controller' => 'purchasedetails', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
