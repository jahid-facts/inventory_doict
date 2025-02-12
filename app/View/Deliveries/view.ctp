<div class="deliveries view">
<h2><?php echo __('Delivery'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($delivery['Delivery']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($delivery['User']['name'], array('controller' => 'users', 'action' => 'view', $delivery['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($delivery['Product']['name'], array('controller' => 'products', 'action' => 'view', $delivery['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orderid'); ?></dt>
		<dd>
			<?php echo h($delivery['Delivery']['orderid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Requisitionno'); ?></dt>
		<dd>
			<?php echo h($delivery['Delivery']['requisitionno']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($delivery['Delivery']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Delivery'), array('action' => 'edit', $delivery['Delivery']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Delivery'), array('action' => 'delete', $delivery['Delivery']['id']), array(), __('Are you sure you want to delete # %s?', $delivery['Delivery']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Deliveries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Delivery'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
