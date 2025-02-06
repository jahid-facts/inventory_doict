
<div class="logs form">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo __('Add Log'); ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <?php echo __('Add Log'); ?>                </div>
                <div class="panel-body">
                    <?php echo $this->Form->create('Log'); ?>
                    	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('ip');
		echo $this->Form->input('port');
		echo $this->Form->input('controller');
		echo $this->Form->input('action');
	?>
	<?php echo $this->Form->end(__('Submit')); ?>
                </div>
            </div>
        </div>
    </div>
 </div>