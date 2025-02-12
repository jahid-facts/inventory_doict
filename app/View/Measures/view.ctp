<div class="measures view">
<h2><?php echo __('Measure'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($measure['Measure']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($measure['Measure']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Measure'), array('action' => 'edit', $measure['Measure']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Measure'), array('action' => 'delete', $measure['Measure']['id']), array(), __('Are you sure you want to delete # %s?', $measure['Measure']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deliverydetails'), array('controller' => 'deliverydetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deliverydetail'), array('controller' => 'deliverydetails', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchasedetails'), array('controller' => 'purchasedetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchasedetail'), array('controller' => 'purchasedetails', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requisitiondetails'), array('controller' => 'requisitiondetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requisitiondetail'), array('controller' => 'requisitiondetails', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stock'), array('controller' => 'stocks', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
<div class="related">
	<h3><?php echo __('Related Deliverydetails'); ?></h3>
	<?php if (!empty($measure['Deliverydetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Measure Id'); ?></th>
		<th><?php echo __('Deliveries Id'); ?></th>
		<th><?php echo __('Voucher'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($measure['Deliverydetail'] as $deliverydetail): ?>
		<tr>
			<td><?php echo $deliverydetail['id']; ?></td>
			<td><?php echo $deliverydetail['quantity']; ?></td>
			<td><?php echo $deliverydetail['price']; ?></td>
			<td><?php echo $deliverydetail['measure_id']; ?></td>
			<td><?php echo $deliverydetail['deliveries_id']; ?></td>
			<td><?php echo $deliverydetail['voucher']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'deliverydetails', 'action' => 'view', $deliverydetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'deliverydetails', 'action' => 'edit', $deliverydetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'deliverydetails', 'action' => 'delete', $deliverydetail['id']), array(), __('Are you sure you want to delete # %s?', $deliverydetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Deliverydetail'), array('controller' => 'deliverydetails', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Purchasedetails'); ?></h3>
	<?php if (!empty($measure['Purchasedetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Purchase Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Measure Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($measure['Purchasedetail'] as $purchasedetail): ?>
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
<div class="related">
	<h3><?php echo __('Related Requisitiondetails'); ?></h3>
	<?php if (!empty($measure['Requisitiondetail'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Requisition Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Measure Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($measure['Requisitiondetail'] as $requisitiondetail): ?>
		<tr>
			<td><?php echo $requisitiondetail['id']; ?></td>
			<td><?php echo $requisitiondetail['quantity']; ?></td>
			<td><?php echo $requisitiondetail['requisition_id']; ?></td>
			<td><?php echo $requisitiondetail['price']; ?></td>
			<td><?php echo $requisitiondetail['measure_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'requisitiondetails', 'action' => 'view', $requisitiondetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'requisitiondetails', 'action' => 'edit', $requisitiondetail['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'requisitiondetails', 'action' => 'delete', $requisitiondetail['id']), array(), __('Are you sure you want to delete # %s?', $requisitiondetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Requisitiondetail'), array('controller' => 'requisitiondetails', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Stocks'); ?></h3>
	<?php if (!empty($measure['Stock'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Quantity'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Measure Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($measure['Stock'] as $stock): ?>
		<tr>
			<td><?php echo $stock['id']; ?></td>
			<td><?php echo $stock['product_id']; ?></td>
			<td><?php echo $stock['quantity']; ?></td>
			<td><?php echo $stock['price']; ?></td>
			<td><?php echo $stock['measure_id']; ?></td>
			<td><?php echo $stock['status']; ?></td>
			<td><?php echo $stock['created']; ?></td>
			<td><?php echo $stock['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'stocks', 'action' => 'view', $stock['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'stocks', 'action' => 'edit', $stock['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'stocks', 'action' => 'delete', $stock['id']), array(), __('Are you sure you want to delete # %s?', $stock['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Stock'), array('controller' => 'stocks', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
