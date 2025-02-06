
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo __('Log'); ?></h1>
    </div>
</div>

<div class="log view">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <?php echo __('Log'); ?>                </div>
                <div class="panel-body"> 
    
	<div class='row-fluid'>
		<div class='span3'><?php echo __('Id'); ?></div>
		<div class='span9'>
			<?php echo h($log['Log']['id']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('User'); ?></div>
		<div class='span9'>
			<?php echo $this->Html->link($log['User']['name'], array('controller' => 'users', 'action' => 'view', $log['User']['id'])); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Ip'); ?></div>
		<div class='span9'>
			<?php echo h($log['Log']['ip']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Port'); ?></div>
		<div class='span9'>
			<?php echo h($log['Log']['port']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Controller'); ?></div>
		<div class='span9'>
			<?php echo h($log['Log']['controller']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Action'); ?></div>
		<div class='span9'>
			<?php echo h($log['Log']['action']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Created'); ?></div>
		<div class='span9'>
			<?php echo h($log['Log']['created']); ?>
			&nbsp;
		</div>
	</div>              </div>
            </div>
        </div>
    </div>
</div>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
		<li><?php echo $this->Html->link(__('Edit Log'), array('action' => 'edit', $log['Log']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Log'), array('action' => 'delete', $log['Log']['id']), array(), __('Are you sure you want to delete # %s?', $log['Log']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Logs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Log'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
    </ul>
</div>
