<div class="divisions view">
<h2><?php echo __('Division'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($division['Division']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($division['Division']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Division'), array('action' => 'edit', $division['Division']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Division'), array('action' => 'delete', $division['Division']['id']), array(), __('Are you sure you want to delete # %s?', $division['Division']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Divisions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Division'), array('action' => 'add')); ?> </li>
	</ul>
</div>
