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
        margin-bottom: 10px;
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
        text-align: center;
    }
</style>
<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">  
                <?php 
                    if($currentUser['role_id'] == 3 ){
                        echo "Requisitions List";
                    }else{
                      echo "Requisitions Approved List";  
                    } 
                ?>
            </h3>
        </div>
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2"> 
                <?php
                        echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
                ?>
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <?php if($currentUser['role_id'] == 1 || $currentUser['role_id'] == 2 || $currentUser['role_id'] == 4){?>
                            <td class="col-md-3" style="padding-left: 0px;">
                                <?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'select Name'));?>

                            </td>
                        <?php } ?> 
                        <td class="col-md-3"><?php
                        echo $this->Form->input ( 'frommonth', array ('type'=>'text','id'=>'FromMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'From') );
                        ?></td>
                        <td class="col-md-3"><?php
                        echo $this->Form->input ( 'tomonth', array ('type'=>'text','id'=>'ToMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'To') );
                        ?></td>
                        <td class="col-md-1"><?php
                        echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info', 'style'=>'font-family:inherit; font-weight:bold;') );
                        ?></td>

                    </tr>

                </table>
    		    <br />
                        <?php
                        echo $this->Form->end ();
                        ?>

    	       <h4 class="btn-warning" style="text-align: center;"><?php echo $this->Session->flash(); ?></h4>

                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                        <tr>
                                <th><?php echo 'SL.'; ?></th>
                                <th><?php echo $this->Paginator->sort('Date'); ?></th>
                                <th><?php echo $this->Paginator->sort('Requisitioner Name'); ?></th>
                                <th> Requisition No.</th>
                                <th>Dept. / Location</th> 
                                <th class="actions"><?php echo __('Actions'); ?></th>


                        </tr>

                        <?php 
                        $i=$this->Paginator->counter(array('format' => __('{:start}')));
                        foreach ($requisitions as $requisition):
                            //echo p($requisition);


                         ?>
                        <tr>
                            <td><?php echo $i; ?>&nbsp;</td>
                            <td>
                                <?php echo $requisition['Requisition']['created']; ?>

                            </td>
                            <td>
                                <?php echo $requisition['User']['name']; ?>
                            </td>

                            <td> 
                                <?php echo $requisition['Requisition']['requisitionno'];?> 
                            </td>
                            <td>
                                <?php echo $requisition['Requisition']['location']; ?> 
                            </td>
                             
                            <td class="actions">  
                                <?php if($currentUser['role_id'] ==2){?>
                                <?php echo $this->Html->link(__('<span class="fa fa-location-arrow"></span> Delivery'),array('action' => 'delivery', $requisition['Requisition']['id'],'rsubmit'),array('class'=>'btn btn-info btn-sm','escape' =>false)); ?>     
                                <?php }?>
                                <?php if($currentUser['role_id'] !=2){?>
                                <?php echo $this->Html->link(__('<i class="fa fa-eye" title="View Requisition"></i>'), array('action' => 'viewr', $requisition['Requisition']['id'],'rsubmit'),array('escape' =>false)); ?>
                                <?php }?>
                                <?php if($currentUser['role_id'] ==1){?>
                                <?php //echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash"></i>'), array('action' => 'delete', $requisition['Requisition']['id']) ,array('escape' =>false),array(), __('Are you sure you want to delete # %s?', $requisition['Requisition']['id'])); ?>
                                    <?php }?>
                            </td>

                        </tr>
                    <?php $i++;endforeach; ?>
                    </table>
                </div>
                <div style="clear: both; height: 15px;"></div>
                <div class="col-sm-12" style="text-align: center;">
                    <p>
                    <?php
                    echo $this->Paginator->counter(array(
                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                    ));
                    ?>	</p>

                
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
