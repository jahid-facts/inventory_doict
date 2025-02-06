<div class="requisitionretunrs view">
<h2><?php echo __('Requisitionretunr'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($requisitionretunr['Requisitionretunr']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($requisitionretunr['Requisitionretunr']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requisitionretunr['Product']['name'], array('controller' => 'products', 'action' => 'view', $requisitionretunr['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Measure'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requisitionretunr['Measure']['name'], array('controller' => 'measures', 'action' => 'view', $requisitionretunr['Measure']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rnumber'); ?></dt>
		<dd>
			<?php echo h($requisitionretunr['Requisitionretunr']['rnumber']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ddate'); ?></dt>
		<dd>
			<?php echo h($requisitionretunr['Requisitionretunr']['ddate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Requisitionretunr'), array('action' => 'edit', $requisitionretunr['Requisitionretunr']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Requisitionretunr'), array('action' => 'delete', $requisitionretunr['Requisitionretunr']['id']), array(), __('Are you sure you want to delete # %s?', $requisitionretunr['Requisitionretunr']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Requisitionretunrs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requisitionretunr'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>
