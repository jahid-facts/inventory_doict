
<br><br>
<style>
    .panel-default > .panel-heading{
        font-size:20px;
        text-align:center;
        font-family: inherit;
        font-weight: bold;
        color: #0088cc;
    }

    .my-space-1{
        height:15px;
    }

    .img-circle {
        border-radius: 50%;
    } 
    .message {
        margin: 5px 0px;
        background: #f2f3f7;
        padding: 4px;
        color: #2d6f2d;
        text-align: center;
        font-size: 20px;
    }
    .my-padding-0 > tbody > tr > td:nth-child(1){
        text-align: right;
    }
    .my-padding-0 > tbody > tr > td:nth-child(2){
        text-align: left;
    }
  
</style>

<div class="col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2">
	<?php echo $this->Session->flash(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading my-heading">User Profile</div>
                    <div class="panel-body">
                        <div class="my-space-1"></div>

                        <?php 
                            $imgId=$user['User']['id'];
                            
                        $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';
                        
                    
                        if(file_exists($check)){?>
                            <img  class="img-circle" width="100" height="100" style="margin:0px 0px 0px 283px;" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                        <?php }else{?>
                            <img class="img-circle" width="100" height="100" style="margin:0px 0px 0px 283px;" src="<?php echo $this->webroot?>images/dummy.jpg"/>
                        <?php }?><br><br>

                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered my-padding-0">
                                    <tr>
                                        <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name :</td>
                                        <td>
                                            <?php echo h($user['User']['name']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Username :</td>
                                        <td>
                                            <?php echo h($user['User']['username']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email :</td>
                                        <td>
                                            <?php echo h($user['User']['email']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile :</td>
                                        <td>
                                            <?php echo h($user['User']['mobile']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role :</td>
                                        <td>
                                            <?php echo h($role_id[$user['User']['role_id']]); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div><!--/.main-->






















<!--<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deliveries'), array('controller' => 'deliveries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Delivery'), array('controller' => 'deliveries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requisitions'), array('controller' => 'requisitions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requisition'), array('controller' => 'requisitions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Deliveries'); ?></h3>
	<?php if (!empty($user['Delivery'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Orderid'); ?></th>
		<th><?php echo __('Requisitionno'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Delivery'] as $delivery): ?>
		<tr>
			<td><?php echo $delivery['id']; ?></td>
			<td><?php echo $delivery['user_id']; ?></td>
			<td><?php echo $delivery['product_id']; ?></td>
			<td><?php echo $delivery['orderid']; ?></td>
			<td><?php echo $delivery['requisitionno']; ?></td>
			<td><?php echo $delivery['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'deliveries', 'action' => 'view', $delivery['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'deliveries', 'action' => 'edit', $delivery['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'deliveries', 'action' => 'delete', $delivery['id']), array(), __('Are you sure you want to delete # %s?', $delivery['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Delivery'), array('controller' => 'deliveries', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Profiles'); ?></h3>
	<?php if (!empty($user['Profile'])): ?>
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
	<?php foreach ($user['Profile'] as $profile): ?>
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
<div class="related">
	<h3><?php echo __('Related Requisitions'); ?></h3>
	<?php if (!empty($user['Requisition'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Requisition'] as $requisition): ?>
		<tr>
			<td><?php echo $requisition['id']; ?></td>
			<td><?php echo $requisition['user_id']; ?></td>
			<td><?php echo $requisition['product_id']; ?></td>
			<td><?php echo $requisition['status']; ?></td>
			<td><?php echo $requisition['created']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'requisitions', 'action' => 'view', $requisition['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'requisitions', 'action' => 'edit', $requisition['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'requisitions', 'action' => 'delete', $requisition['id']), array(), __('Are you sure you want to delete # %s?', $requisition['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Requisition'), array('controller' => 'requisitions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>-->
