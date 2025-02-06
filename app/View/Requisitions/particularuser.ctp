<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>
<script>
$(function() {

    $("#FromMonth,#ToMonth").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange:"-100:+50"
    });


});
</script>
<style>
    .btn.btn-rounded {
        background: #0a99d4 none repeat scroll 0 0;
        border-radius: 12px;
        border-width: 2px;
        color: #fff;
        font-weight: 600;
        padding: 2px 10px;
        float: right;
        margin-top: -5px;
    }
    .btn.btn-rnd {
        background: #0a99d4 none repeat scroll 0 0;
        color: #fff;
        font-weight: 600;
    }
    .btn.btn-rnd:hover,.btn.btn-rnd:focus{
        color: #0a99d4;
    }
    .panel-title{
        font-family: inherit;
        font-size: 16px; 
        font-weight: bold;
    }
    .thla th {
        color: #0088cc;
        text-align: center!important;
    }
    .my-space-1{
        height:15px;
    }

    .img-circle {
        border-radius: 50%;
    }
    .my-padding-0 > tbody > tr > td:nth-child(1){
        text-align: right;
    }
    .my-padding-0 > tbody > tr > td:nth-child(2){
        text-align: left;
    }
    .add-span a {
        float: right;
    }
</style>
<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">  
                <?php if ($usersview['User']['district_id']==100) {
                        echo "<a href='".$this->webroot."users/individual/district/".$usersview['User']['district_id']."'>ICT Division (Central)</a> / Requisition";
                    }else{ 
                        echo "<a href='".$this->webroot."users/individual/district/".$usersview['User']['district_id']."'>".$usersview['District']['name']."</a> / Requisition";
                    } 
                ?>
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-reply"></span> Back'), array('controller'=>'users','action' => 'individual','district',$usersview['User']['district_id']),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>  
            </h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-5"> 
                <div class="panel panel-danger">
                    <div class="panel-body">
                        <div class="text-center">
                        <?php 
                            $imgId=$usersview['User']['id']; 
                            $check = WWW_ROOT."img/upload/user/" . $imgId.'.png'; 
                            if(file_exists($check)){?>
                            <img  class="img-circle" width="100" height="100" style="margin:0px auto;" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                        <?php }else{?>
                            <img class="img-circle" width="100" height="100" style="margin:0px auto;" src="<?php echo $this->webroot?>images/dummy.jpg"/>
                        <?php }?><br><br>
                        </div> 
                        <table class="table table-bordered my-padding-0">
                            <tr>
                                <td class="col-lg-4 col-md-4 col-sm-5 col-xs-5">Name :</td>
                                <td>
                                    <?php echo h($usersview['User']['name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Department :</td>
                                <td>
                                    <?php echo h($usersview['Department']['name']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email :</td>
                                <td>
                                    <?php echo h($usersview['User']['email']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Mobile :</td>
                                <td>
                                    <?php echo h($usersview['User']['mobile']); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Role :</td>
                                <td>
                                    <?php echo h($role_id[$usersview['User']['role_id']]); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <?php 
                    echo $this->Form->create ( 'Report', array ('name' => 'form' ) );  
                ?>
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr> 
                        <td class="col-md-3"><?php
                        echo $this->Form->input ( 'frommonth', array ('type'=>'text','id'=>'FromMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'From','autocomplete'=>'off') );
                        ?></td>
                        <td class="col-md-3"><?php
                        echo $this->Form->input ( 'tomonth', array ('type'=>'text','id'=>'ToMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'To','autocomplete'=>'off') );
                        ?></td>
                        <td class="col-md-2"><?php
                        echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info', 'style'=>'font-family:inherit; font-weight:bold;') );
                        ?></td>
                    </tr>

                </table>
                <br />

                <?php echo $this->Form->end (); ?> 

                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo 'SL.'; ?></th>
                                <th><?php echo $this->Paginator->sort('Requisition Date'); ?></th> 
                                <th class="actions"><?php echo __('Actions'); ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                                $i=$this->Paginator->counter(array('format' => __('{:start}')));
                                foreach ($requisitions as $requisition):  
                             ?>
                            <tr>
                                <td><?php echo $i; ?>&nbsp;</td>
                                <td><?php echo date("d-m-Y",strtotime($requisition['Requisition']['created'])); ?></td> 
                                <td class="actions" style="text-align: center;">   
                                    <?php echo $this->Html->link(__('<i class="fa fa-eye" title="View Requisition"></i>'), array('controller'=>'deliveries','action' => 'centralview', $requisition['Delivery'][0]['id'], $requisition['Requisition']['user_id'],$requisition['Requisition']['district_id']),array('escape' =>false)); ?> 
                                </td>

                            </tr>
                            <?php $i++;endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div style="clear: both; height: 15px;"></div>
                <div class="col-sm-12" style="text-align: center;">
                    <p> <?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?> </p> 
                    <ul class="pagination">
                            <li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous btn btn-rnd'));?></li>
                            <li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
                            <li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next btn btn-rnd'));?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
