
<style>
    .lgd{
        color: #0088cc; 
        font-family: inherit; 
        font-weight: bold;
        margin-left:192px;
        border-bottom: 1px solid e1e1e1;
        width:650px;
    }
</style>

<div class="sizes form">
    <?php echo $this->Form->create('Size',array('type'=>'file','class'=>'form-horizontal')); ?>
    <fieldset>
                <div class="row">
        <div class="container" style="margin-top:50px;">
            <legend class="lgd"><?php echo __('Add Size'); ?></legend>
                   
                    <div class="col-md-2">
        </div>

   
            <div class="form-group" >
                <div class="col-md-2">
                    <label>Name</label>
                </div>
                <div class="col-md-4">
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false));?>
                </div>
            </div>
            <div class="col-md-2">
        </div>

    
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
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>