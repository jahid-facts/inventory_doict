
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
</style> 

<div class="col-sm-6 col-sm-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><?php echo __('Edit Setting'); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Form->create('Setting',array('type'=>'file','class'=>'form-horizontal')); 
            	  echo $this->Form->input('id');
            ?>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Company Name</label> 
                    <?php echo $this->Form->input('companyname',array('type'=>'text','class'=>'form-control','label'=>false));?> 
                </div>
            </div>
            <div class="col-sm-2"> </div>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Email</label> 
                    <?php echo $this->Form->input('email',array('type'=>'text','class'=>'form-control','label'=>false));?>
                </div>
            </div>
            <div class="col-sm-12">
            	<div class="form-group" > 
                    <label>Meta Description</label> 
                    <?php echo $this->Form->input('metadescription',array('type'=>'text','class'=>'form-control','label'=>false));?> 
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>