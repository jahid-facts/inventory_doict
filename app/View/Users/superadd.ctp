
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
    #UserUsername {
        text-transform: lowercase;
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
    function getDistrictId(id,User){
        var path='<?php echo $this->webroot;?>'; 
        var modelname='User';
        $.ajax({
            type: 'POST',
            url: path+'districts/districtlist',
            data: {division_id:id,model:modelname}, 
            success: function (data) { 
              $("#UserDistrictId").remove();
              $("#district").html(data);
            }
        });
    }
    function getSubvName(id){  
        var name=$("#UserDistrictId option:selected").text();
        $("#UserUsername").val(name);
    }
</script>

<div class="payments form">
    <?php echo $this->Form->create('User',array('type'=>'file','class'=>'form-horizontal'));?> 
    <div class="panel panel-primary" style="margin-top: 20px;">
        <div class="panel-heading">
          <h3 class="panel-title"><a title="Back" href="<?php echo $this->webroot?>users/superusers">Super Admin</a><?php echo '/Add';?></h3>
        </div>
        <div class="panel-body"> 
            <div class="col-sm-10 col-sm-offset-1">  
                <div class="col-sm-6 pr"> 
                    <label>Division</label>   
                    <?php echo $this->Form->input('division_id',array('onChange'=>'getDistrictId(this.value);','label'=>false,'div'=>false,'class'=>'form-control border-input','empty'=>'Select Division','required'=>true));?> 
                </div>
                <div class="col-sm-6 pl"> 
                    <label>District</label> 
                    <?php echo $this->Form->input('district_id',array('type'=>'select','label'=>false,'div'=>false,'class'=>'form-control border-input district_option','empty'=>'Select District','required'=>true));?> 
                    <div id="district"></div>
                </div> 
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
                    <select name="data[User][department_id]" class="form-control" required>
                        <option value="">Select Department</option>
                        <option value="ICT Division" selected>ICT Division</option>  
                    </select> 
                </div>

                <div class="col-sm-6 pl"> 
                    <label>Designation</label> 
                    <select name="data[User][designation_id]" class="form-control" required>
                        <option value="">Select Designation</option>
                        <option value="Programmer" selected>Programmer</option> 
                        <option value="Assistant Programmer">Assistant Programmer</option> 
                    </select>  
                </div> 
                <div class="col-sm-6 pr"> 
                    <label>Email</label>  
                    <?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false,'autocomplete'=>'off'));?> 
                </div>
                <div class="col-sm-6 pl"> 
                    <label>Mobile</label> 
                    <?php echo $this->Form->input('mobile',array('class'=>'form-control','label'=>false,'autocomplete'=>'off'));?> 
                </div> 
                <div class="col-sm-6 pr"> 
                    <label>Role</label> 
                    <div id="volunter"></div>
                    <?php  
                        if($currentUser['role_id'] == 5){ 
                            echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' => array(1,2,3,5), 'onchange'=>'getRole(this.value)'));
                        } 
                    ?>
                </div> 
                <div class="col-sm-6 pl"> 
                    <label>Status</label>  
                    <div id="volunter"></div>
                    <?php echo $this->Form->input('status',array('class'=>'form-control','label'=>false,'options'=>array('1'=>'Active','2'=>'Inactive'),'type'=>'select'));?>
                </div> 
                <?php echo $this->Form->input('serial',array('type'=>'hidden','class'=>'form-control','label'=>false, 'default'=>1));?>  
                <div class="col-sm-6 pr"> 
                    <label>Password</label> 
                    <?php echo $this->Form->input('password',array('class'=>'form-control','label'=>false,'autocomplete'=>'off'));?>
                </div> 
                <div class="col-sm-6 pl">  
                    <label>Photo</label>  
                    <?php echo $this->Form->input('image',array('type'=>'file','label'=>false));?>  
                </div>  
                <div style="clear: both;height: 15px;"></div>                    
                <div class="col-sm-12 text-center"> 
                    <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Submit</button>  
                </div> 
                <?php echo $this->Form->end(); ?>
            </div> 
        </div> 
    </div>
</div>