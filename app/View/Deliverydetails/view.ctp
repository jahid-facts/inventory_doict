<div class="deliverydetails view">
<h2><?php echo __('Deliverydetail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($deliverydetail['Deliverydetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($deliverydetail['Deliverydetail']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($deliverydetail['Deliverydetail']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measure'); ?></dt>
		<dd>
			<?php echo $this->Html->link($deliverydetail['Measure']['name'], array('controller' => 'measures', 'action' => 'view', $deliverydetail['Measure']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deliveries'); ?></dt>
		<dd>
			<?php echo $this->Html->link($deliverydetail['Deliveries']['id'], array('controller' => 'deliveries', 'action' => 'view', $deliverydetail['Deliveries']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Voucher'); ?></dt>
		<dd>
			<?php echo h($deliverydetail['Deliverydetail']['voucher']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Deliverydetail'), array('action' => 'edit', $deliverydetail['Deliverydetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Deliverydetail'), array('action' => 'delete', $deliverydetail['Deliverydetail']['id']), array(), __('Are you sure you want to delete # %s?', $deliverydetail['Deliverydetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Deliverydetails'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deliverydetail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deliveries'), array('controller' => 'deliveries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deliveries'), array('controller' => 'deliveries', 'action' => 'add')); ?> </li>
	</ul>
</div>
