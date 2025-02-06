
<style>
    .col-sm-offset-3 {
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
</style> 

<script>
var path='<?php echo $this->webroot;?>';
function codeVerify(value){

    $.ajax({
        type: 'POST',
        url: path +'categories/code',
        data: {id:value,title:'cCode'},
        success: function(data){
             $('#message').html('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
           if(data==1){
                $('#message').html('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
           }
                        
        }
    });
}

</script>


<div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><?php echo __('Add Main Category'); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Form->create('Category',array('type'=>'file','class'=>'form-horizontal')); ?>
            <?php echo $this->Form->input('parent_id',array('type'=>'hidden','value'=>-1));?>
            <div class="col-sm-5">
                <div class="form-group has-feedback">
                    <label>Category Code</label>
                    <?php echo $this->Form->input('cCode',array('type'=>'text','class'=>'form-control','label'=>false,'onkeyup'=>'codeVerify(this.value);'));?> <br>
                    <span id="message"></span>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Category Name</label> 
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