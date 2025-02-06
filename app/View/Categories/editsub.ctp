
<style>
    .col-sm-offset-2 {
        margin-top: 15px;
    }
    .panel-heading {
        background: #337AB7!important;
        border-color: #337AB7!important;
    }
    .panel-heading h3 {
        margin: 2px auto;
        text-align: center;
        color: #FFF;
    }
    .form-control-feedback {
        margin-top: 25px;
        width: auto;
    }
    .glyphicon-ok {
        color: #3C763D;
    }
    .glyphicon-remove {
        color: #A94442;
    }
    .message {
        margin: 1px 0px 5px;
        background: #f2f3f7;
        padding: 4px;
        color: #A94442;
        text-align: center;
        font-size: 16px;
    }
</style> 
<script>
var path='<?php echo $this->webroot;?>';
function codeVerify(value){
    var cat_id=$('#CategoryParentId').val();
    $.ajax({
        type: 'POST',
        url: path +'categories/scode',
        data: {id:value,title:'sCode',cat_id:cat_id},
        success: function(data){
             $('#message').html('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
           if(data==1){
                $('#message').html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
           }
                        
        }
    });
}

</script>
<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><?php echo __('Edit Sub-Category'); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Form->create('Category',array('type'=>'file','class'=>'form-horizontal'));
                  echo $this->Form->input('id');


                  echo $this->Form->input('cscode',array('type'=>'hidden','value'=>$this->request->data['Category']['sCode']));

                  echo $this->Form->input('cparent_id',array('type'=>'hidden','value'=>$this->request->data['Category']['parent_id']));
            ?>

            <div class="col-sm-3">
                <div class="form-group" > 
                    <label>Main Category Name</label> 
                    <?php echo $this->Form->input('parent_id',array('label'=>false,'div'=>false,'type'=>'select','options'=>$parentCategories,'class'=>'form-control','empty'=>array('-1'=>'-- Select Category --')));?> 
                </div>
            </div>
            <div class="col-sm-1">
            </div>

            <div class="col-sm-3">
                <div class="form-group has-feedback" > 
                    <label>Sub-Category Code</label> 
                    <?php echo $this->Form->input('sCode',array('type'=>'text','class'=>'form-control','label'=>false,'onkeyup'=>'codeVerify(this.value);'));?> 
                    <span id="message"></span>
                </div>
            </div>
            <div class="col-sm-1">
            </div>
            <div class="col-sm-4">
                <div class="form-group" > 
                    <label>Sub-Category Name</label> 
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false));?>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

