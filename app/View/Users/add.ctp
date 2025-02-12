
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

    var path='<?php echo $this->webroot;?>';
    function getDepart(){ 
        var id = document.getElementById('name').value;  
        $.ajax({    
            type: 'POST',
            url: path +'departments/getdepartment',
            data: {id:id},
            success: function(data){ 
                var defaultSelected = true;
                var nowSelected = true;
                $('.department').append(new Option(id, data, defaultSelected, nowSelected));
            }
        });
    }

    function getDesig(){ 
        var id = document.getElementById('DesignationName').value;  
        $.ajax({    
            type: 'POST',
            url: path +'designations/getdesignation',
            data: {id:id},
            success: function(data){  
                var defaultSelected = true;
                var nowSelected = true;
                $('.designation').append(new Option(id, data, defaultSelected, nowSelected));
            }
        });
    }

</script>

<div class="payments form">
    <?php echo $this->Form->create('User',array('type'=>'file','class'=>'form-horizontal'));?> 
    <div class="panel panel-primary" style="margin-top: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title"><a title="Back" href="<?php echo $this->webroot?>users/index/1">Users</a><?php echo '/Add';?></h3> 
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
                    <select name="data[User][department_id]" id="modalDept" class="form-control department">
                        <option value="">Select Department</option>
                        <option value="adddep">Add New Department</option>                   
                        <?php foreach ($departments as $key=>$department){?>
                        <option value="<?php echo $key;?>"><?php echo $department;?></option>
                        <?php }?> 
                    </select>
                </div>

                <div class="col-sm-6 pl"> 
                    <label>Designation</label> 
                    <select name="data[User][designation_id]" id="modalDesigs" class="form-control designation">
                        <option value="">Select Designation</option>
                        <option value="adddesig">Add New Designation</option>                   
                        <?php foreach ($designations as $key=>$designation){?>
                        <option value="<?php echo $key;?>"><?php echo $designation;?></option>
                        <?php }?>    
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
                        if($currentUser['role_id'] == 1){
                            echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' => array(1,4,5), 'onchange'=>'getRole(this.value)'));
                        }elseif($currentUser['role_id'] == 4){
                            echo $this->Form->input('role_id',array('class'=>'form-control','label'=>false,'options'=>$role_id,'type'=>'select', 'disabled' => array(4,5), 'onchange'=>'getRole(this.value)'));
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
                    echo $this->Form->input('division_id',array('type'=>'hidden','value'=>$currentUser['division_id']));
                    echo $this->Form->input('district_id',array('type'=>'hidden','value'=>$currentUser['district_id']));
                    echo $this->Form->input('serial',array('type'=>'hidden','default'=>2));
                ?>  
                <div class="col-sm-6 pr"> 
                    <label>Password</label> 
                    <?php echo $this->Form->input('password',array('class'=>'form-control','label'=>false,'autocomplete'=>'off'));?>
                </div> 
                <div class="col-sm-6 pl">  
                    <label>Photo</label>  
                    <?php echo $this->Form->input('image',array('class'=>'form-control','type'=>'file','label'=>false));?>  
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

<!-- Modal Color -->
<div class="modal fade modal-primary" id="modalDep" tabindex="-1" role_id="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Department</h4>
            </div>
            <div class="modal-body">
                 <?php echo $this->Form->input('name',array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control'));
                        ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="getDepart()" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Size -->
<div class="modal fade modal-primary" id="modalDesig" tabindex="-1" role_id="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Designation</h4>
            </div>
            <div class="modal-body">
                 <?php echo $this->Form->input('Designation.name',array('type'=>'text','label'=>false,'div'=>false,'class'=>'form-control'));
                        ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="getDesig()" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
    $("#modalDept").on("change", function () {        
        $modal = $('#modalDep'); 
            if($(this).val() === 'adddep'){
            $modal.modal('show');
        }
    });
    $("#modalDesigs").on("change", function () {        
        $modal = $('#modalDesig');
        if($(this).val() === 'adddesig'){
            $modal.modal('show');
        }
    });
</script>