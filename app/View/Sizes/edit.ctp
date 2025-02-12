
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
            <h3><?php echo __('Add Size'); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Form->create('Size',array('type'=>'file','class'=>'form-horizontal'));
				 echo $this->Form->input('id');
			?>
            <div class="col-sm-6 col-sm-offset-3">
	            <div class="col-sm-9 col-xs-8">
	                <div class="form-group" > 
	                    <label>Size</label> 
	                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false));?>
	                </div>
	            </div> 
	            <div class="col-sm-2 col-xs-4 text-center">
	            	<label>&nbsp;</label> 
	                <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
	            </div>
	        </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>