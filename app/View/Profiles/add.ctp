
<div class="profiles form">
<?php echo $this->Form->create('Profile',array('type'=>'file','class'=>'form-horizontal')); ?>
    <fieldset>			
        <div class="container" style="margin-top:50px;">	
            <legend><?php echo __('Add Profile'); ?></legend>
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>User</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input('user_id',array('label'=>false,'div'=>false,'type'=>'select','class'=>'form-control'));?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>Designation</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input('designation_id',array('label'=>false,'div'=>false,'type'=>'select','class'=>'form-control'));?>
                </div>
            </div>            
            
            <div class="form-group">
                <div class="col-md-2">
                    <label>Department</label>
                </div>	
                <div class="col-md-4">
                  <?php echo $this->Form->input('department_id',array('label'=>false,'div'=>false,'type'=>'select','class'=>'form-control'));?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2">
                    <label>Phone</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('phone',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>
            
            <div class="form-group" >
                <div class="col-md-2">
                    <label>Email</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control','label'=>false));?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2">
                    <label>Location</label>
                </div>	
                <div class="col-md-4">
                    <?php echo $this->Form->input('location',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2">
                    <label></label>
                 </div>	
                <div class="col-md-4">
                    <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
                </div>
            </div>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>

<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Designations'), array('controller' => 'designations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Designation'), array('controller' => 'designations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>-->












<!--<div class="profiles form">
<?php echo $this->Form->create('Profile'); ?>
	<fieldset>
		<legend><?php echo __('Add Profile'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('designation_id');
		echo $this->Form->input('department_id');
		echo $this->Form->input('phone');
		echo $this->Form->input('email');
		echo $this->Form->input('location');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Designations'), array('controller' => 'designations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Designation'), array('controller' => 'designations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Departments'), array('controller' => 'departments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Department'), array('controller' => 'departments', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
