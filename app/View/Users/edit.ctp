
<style>
    .lgd{
        color: #0088cc; 
        font-family: inherit; 
        font-weight: bold;
    }
    .pr {
    	padding-right: 20px;
    	margin-bottom: 10px;
    }
    .pl {
    	padding-left: 20px;
    	margin-bottom: 10px;
    }
    #UserRoleId option[disabled] {
      display: none;
    }
    
</style> 

<script type="text/javascript">
    function getRole(sel) {  
        if (sel==1) {
            $('#UserSerial').val(2);
        }else if(sel==2){
            $('#UserSerial').val(4);
        }else if(sel==3){
            $('#UserSerial').val(3);
        }else if(sel==4){
            $('#UserSerial').val(1);
        } 
    }
</script>
<?php
	$defaultval = $this->request->data['Role']['id']; 
	$val=2;
	if ($defaultval==1) {
        $val=2;
    }else if($defaultval==2){
        $val=4;
    }else if($defaultval==3){
        $val=3;
    }else if($defaultval==4){
        $val=1;
    } 
?>

<div class="payments form">
	<?php echo $this->Form->create('User',array('type'=>'file','class'=>'form-horizontal')); 
		  echo $this->Form->input('id'); 
	?> 
	<div class="panel panel-primary" style="margin-top: 20px;">
        <div class="panel-heading">
          <h3 class="panel-title"><a title="Back" href="<?php echo $this->webroot?>users/index/1">Users</a><?php echo '/Edit';?></h3> 
        </div>
        <div class="panel-body"> 
            <div class="col-sm-10 col-sm-offset-1">  
				<div class="col-sm-6 pr">
					<label>Full Name</label> 
				 	<?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false,'autocomplete'=>'off'));?> 
				</div> 
				<div class="col-sm-6 pl"> 
					<label>User Name</label> 
					<?php echo $this->Form->input('username',array('class'=>'form-control','label'=>false,'autocomplete'=>'off'));?> 
				</div>  
				<div class="col-sm-6 pr"> 
	                <label>Department</label> 
	                <?php echo $this->Form->input('department_id',array('class'=>'form-control','empty'=>'Select','label'=>false));?> 
	            </div>

	            <div class="col-sm-6 pl"> 
	                <label>Designation</label> 
	                <?php echo $this->Form->input('designation_id',array('class'=>'form-control','empty'=>'Select','label'=>false));?> 
	            </div>
				<!-- <div class="col-sm-6 pl"> 
					<label>Password</label> 
					<?php echo $this->Form->input('password',array('class'=>'form-control','label'=>false));?> 
				</div> -->
				<div class="col-sm-6 pr"> 
					<label>Email</label>  
					<?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false,'autocomplete'=>'off'));?> 
				</div>
				<div class="col-sm-6 pl"> 
					<label>Mobile</label> 
					<?php echo $this->Form->input('mobile',array('class'=>'form-control','label'=>false,'autocomplete'=>'off'));?> 
				</div> 
				<div class="col-sm-6 pr admin"> 
					<label>Role</label> 
					<div id="volunter"></div>
					<?php  
						if($currentUser['role_id'] == 1){
							if ($currentUser['role_id']==$this->request->data['User']['role_id']) {
								echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' =>'disabled', 'onchange'=>'getRole(this.value)'));
							}elseif ($this->request->data['User']['role_id']==4) {
								echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' =>'disabled', 'onchange'=>'getRole(this.value)'));
							}else{
								echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' => array(1,4,5), 'onchange'=>'getRole(this.value)'));
							} 
						}elseif($currentUser['role_id'] == 4){
							if ($currentUser['role_id']==$this->request->data['User']['role_id']) {
								echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' =>'disabled', 'onchange'=>'getRole(this.value)'));
							}else{
								echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' => array(4,5), 'onchange'=>'getRole(this.value)'));
							} 
						}elseif($currentUser['role_id'] == 5){ 
							echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' => array(1,2,3,5), 'onchange'=>'getRole(this.value)'));
						} 
					?> 
				</div> 
				<div class="col-sm-6 pl"> 
					<label>Status</label>  
					<div id="volunter"></div>
					<?php echo $this->Form->input('status',array('class'=>'form-control','label'=>false,'options'=>array('1'=>'Active','2'=>'Inactive'),'type'=>'select'));?> 
				</div> 
				<?php 
					echo $this->Form->input('division_id',array('type'=>'hidden','class'=>'form-control','label'=>false, 'value'=>$currentUser['division_id']));
                    echo $this->Form->input('district_id',array('type'=>'hidden','class'=>'form-control','label'=>false, 'value'=>$currentUser['district_id']));
					echo $this->Form->input('serial',array('type'=>'hidden','class'=>'form-control','label'=>false, 'value'=>$val,));
				?>
				<div class="col-sm-6 pr"> 
			        <label>Photo</label>  
			        <?php echo $this->Form->input('image',array('type'=>'file','label'=>false));?> 
			    </div>	  	 	  	 	 	 
				<div class="col-sm-12 text-center"> 
					<button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Update</button>  
				</div> 
				<?php echo $this->Form->end(); ?>
			</div> 
		</div> 
	</div>
</div>