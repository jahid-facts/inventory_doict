
<div class="profiles index">
    <h2><?php echo __('Profiles'); ?></h2>
    
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                <th><?php echo $this->Paginator->sort('designation_id'); ?></th>
                <th><?php echo $this->Paginator->sort('department_id'); ?></th>
                <th><?php echo $this->Paginator->sort('phone'); ?></th>
                <th><?php echo $this->Paginator->sort('email'); ?></th>
                <th><?php echo $this->Paginator->sort('location'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>

                <?php
                    $i=$this->Paginator->counter(array('format' => __('{:start}')));
                    foreach ($profiles as $profile):
                 ?>

            <tr>
                <td><?php echo h($profile['Profile']['id']); ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->link($profile['User']['name'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
		</td>
		<td>
                    <?php echo $this->Html->link($profile['Designation']['name'], array('controller' => 'designations', 'action' => 'view', $profile['Designation']['id'])); ?>
		</td>
		<td>
                    <?php echo $this->Html->link($profile['Department']['name'], array('controller' => 'departments', 'action' => 'view', $profile['Department']['id'])); ?>
		</td>
		<td><?php echo h($profile['Profile']['phone']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['email']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['location']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__($this->Html->image('view.png',array('title' =>'Edit'))), array('action' => 'view', $profile['Profile']['id']),array('escape' =>false)); ?>
                    <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $profile['Profile']['id']),array('escape' =>false)); ?>
                    <?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $profile['Profile']['id']) ,array('escape' =>false),array(), __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?>
                </td>

            </tr>
            <?php $i++; endforeach; ?>
        </table>
    </div>
    
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="col-md-6">
		<ul class="pagination" style="float: right;">
			<li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous disabled'));?></li>
			<li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
			<li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next disabled'));?></li>
		</ul>
	</div>

</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?></li>
<!--		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Designations'), array('controller' => 'designations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Designation'), array('controller' => 'designations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>-->
	</ul>
</div>
















<!--<div class="profiles index">
	<h2><?php echo __('Profiles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('designation_id'); ?></th>
			<th><?php echo $this->Paginator->sort('department_id'); ?></th>
			<th><?php echo $this->Paginator->sort('phone'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('location'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($profiles as $profile): ?>
	<tr>
		<td><?php echo h($profile['Profile']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($profile['User']['name'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($profile['Designation']['name'], array('controller' => 'designations', 'action' => 'view', $profile['Designation']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($profile['Department']['name'], array('controller' => 'departments', 'action' => 'view', $profile['Department']['id'])); ?>
		</td>
		<td><?php echo h($profile['Profile']['phone']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['email']); ?>&nbsp;</td>
		<td><?php echo h($profile['Profile']['location']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $profile['Profile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $profile['Profile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $profile['Profile']['id']), array(), __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Designations'), array('controller' => 'designations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Designation'), array('controller' => 'designations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
