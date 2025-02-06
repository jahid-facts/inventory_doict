<div class="designations view">
<h2><?php echo __('Designation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($designation['Designation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($designation['Designation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($designation['Designation']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Designation'), array('action' => 'edit', $designation['Designation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Designation'), array('action' => 'delete', $designation['Designation']['id']), array(), __('Are you sure you want to delete # %s?', $designation['Designation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Designations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Designation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Profiles'); ?></h3>
	<?php if (!empty($designation['Profile'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Designation Id'); ?></th>
		<th><?php echo __('Department Id'); ?></th>
		<th><?php echo __('Phone'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Location'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($designation['Profile'] as $profile): ?>
		<tr>
			<td><?php echo $profile['id']; ?></td>
			<td><?php echo $profile['user_id']; ?></td>
			<td><?php echo $profile['designation_id']; ?></td>
			<td><?php echo $profile['department_id']; ?></td>
			<td><?php echo $profile['phone']; ?></td>
			<td><?php echo $profile['email']; ?></td>
			<td><?php echo $profile['location']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'profiles', 'action' => 'view', $profile['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'profiles', 'action' => 'edit', $profile['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'profiles', 'action' => 'delete', $profile['id']), array(), __('Are you sure you want to delete # %s?', $profile['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
