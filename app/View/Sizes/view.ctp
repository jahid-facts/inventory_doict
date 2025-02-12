<div class="sizes view">
<h2><?php echo __('Size'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($size['Size']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($size['Size']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Size'), array('action' => 'edit', $size['Size']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Size'), array('action' => 'delete', $size['Size']['id']), array(), __('Are you sure you want to delete # %s?', $size['Size']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sizes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Size'), array('action' => 'add')); ?> </li>
	</ul>
</div>
