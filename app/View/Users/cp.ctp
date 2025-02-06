
<div class="payments form">
<?php echo $this->Form->create('User', array('class'=>'form-horizontal','role_id'=>'form','url' => array('controller' => 'users', 'action' => 'cp')));?> 
    <div class="panel panel-primary" style="margin-top: 30px;">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Change Password'); ?> </h3>
        </div>
        <div class="panel-body"> 
            <div class="col-sm-8 col-sm-offset-2">  
                <div class="col-sm-6"  style="padding-right: 20px"> 
                    <label>Old Password</label>  
                    <?php echo $this->Form->input('old_password',array('label'=>false,'div'=>false,'class'=>'form-control'));?> 
                </div>

                <div class="col-sm-6" style="padding-left: 20px;"> 
                    <label>New Password</label>  
                    <?php echo $this->Form->input('password',array('label'=>false,'div'=>false,'class'=>'form-control','value'=>'123456','title'=>'Default New Password 123456'));?> 
                </div> 
                <div style="clear: both; height: 15px;"></div>
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;" onclick="return confirm('Are you sure you want to Change Password?')">Update Password</button>
                     
                </div> 
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div> 
</div>
