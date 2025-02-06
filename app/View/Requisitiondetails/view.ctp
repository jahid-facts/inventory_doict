<div class="requisitiondetails view">
<h2><?php echo __('Requisitiondetail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($requisitiondetail['Requisitiondetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($requisitiondetail['Requisitiondetail']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Requisition'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requisitiondetail['Requisition']['id'], array('controller' => 'requisitions', 'action' => 'view', $requisitiondetail['Requisition']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($requisitiondetail['Requisitiondetail']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measure'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requisitiondetail['Measure']['name'], array('controller' => 'measures', 'action' => 'view', $requisitiondetail['Measure']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Requisitiondetail'), array('action' => 'edit', $requisitiondetail['Requisitiondetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Requisitiondetail'), array('action' => 'delete', $requisitiondetail['Requisitiondetail']['id']), array(), __('Are you sure you want to delete # %s?', $requisitiondetail['Requisitiondetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Requisitiondetails'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requisitiondetail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requisitions'), array('controller' => 'requisitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requisition'), array('controller' => 'requisitions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
