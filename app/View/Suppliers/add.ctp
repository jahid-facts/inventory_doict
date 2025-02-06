
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
            <h3><?php echo __('Add Supplier'); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Form->create('Supplier',array('class'=>'form-horizontal')); ?>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Name</label> 
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false));?> 
                </div>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Tel / Mobile No.</label> 
                    <?php echo $this->Form->input('mobile',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>E-mail</label> 
                    <?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Contact Person</label> 
                    <?php echo $this->Form->input('contactperson',array('class'=>'form-control','label'=>false));?>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group" > 
                    <label>Address</label> 
                    <?php echo $this->Form->input('address',array('type'=>'textarea','class'=>'form-control','label'=>false,'rows'=>2));?>
                </div>
            </div> 
            <div class="col-sm-12 text-center"> 
                <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>