<div class="purchasedetails view">
<h2><?php echo __('Purchasedetail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($purchasedetail['Purchasedetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Purchase'); ?></dt>
		<dd>
			<?php echo $this->Html->link($purchasedetail['Purchase']['id'], array('controller' => 'purchases', 'action' => 'view', $purchasedetail['Purchase']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($purchasedetail['Purchasedetail']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($purchasedetail['Purchasedetail']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measure'); ?></dt>
		<dd>
			<?php echo $this->Html->link($purchasedetail['Measure']['name'], array('controller' => 'measures', 'action' => 'view', $purchasedetail['Measure']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Purchasedetail'), array('action' => 'edit', $purchasedetail['Purchasedetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Purchasedetail'), array('action' => 'delete', $purchasedetail['Purchasedetail']['id']), array(), __('Are you sure you want to delete # %s?', $purchasedetail['Purchasedetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchasedetails'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchasedetail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases'), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase'), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
