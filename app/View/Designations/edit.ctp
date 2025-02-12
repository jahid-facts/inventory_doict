
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
            <h3><?php echo __('Edit Designation'); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $this->Form->create('Designation',array('type'=>'file','class'=>'form-horizontal'));
                  echo $this->Form->input('id');
                  echo $this->Form->input('district_id',array('type'=>'hidden','value'=>$currentUser['district_id']));
            ?>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Designation</label> 
                    <?php echo $this->Form->input('name',array('type'=>'text','class'=>'form-control','label'=>false));?>
                </div>
            </div>
            <div class="col-sm-2">
            </div>
            <div class="col-sm-5">
                <div class="form-group" > 
                    <label>Status</label> 
                    <?php echo $this->Form->input('status',array('type'=>'select','options'=>$status,'label'=>false,'div'=>false,'class'=>'form-control','required'=>true));
                        ?>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Save</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>