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
        text-align: left;
    }
</style>
<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Requisitions Rejected'); ?> </h3>
        </div>
        <div class="panel-body">
            <?php
                    echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
            ?>
            <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                            <td class="col-md-3">
                                <?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'select name'));?>

                            </td>
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
	
            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                        <tr>
                                <th><?php echo 'Sl.'; ?></th>
                                <th><?php echo $this->Paginator->sort('Requisitioner'); ?></th>
                                <th>Dept. / Location</th>
                                <th><?php echo $this->Paginator->sort('Date & Time'); ?></th>



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
                                        <?php echo $this->Html->link($requisition['User']['name'], array('controller' => 'users', 'action' => 'view', $requisition['User']['id'])); ?>
                                </td>

                <td>
                        <?php echo $requisition['Requisition']['location']; ?>

                                </td>
                                 <td>
                        <?php echo $requisition['Requisition']['created']; ?>

                                </td>


                                <td class="actions" style="text-align: center;">
<!-- 					<?php echo $this->Html->link(__($this->Html->image('view.png',array('title' =>'Edit'))), array('                        action' => 'view', $requisition['Requisition']['id']),array('escape' =>false)); ?> -->




                                        <?php if($currentUser['role_id'] ==2){?>
                                        <?php echo $this->Html->link(__('<span class="fa fa-location-arrow"></span> Prepared delivery order'),array('action' => 'delivery', $requisition['Requisition']['id']),array('class'=>'btn btn-info btn-sm','escape' =>false)); ?>

                                                     
                                        <?php }?>
                                        <?php if($currentUser['role_id'] !=2){?>
                                        <?php echo $this->Html->link(__('<i class="fa fa-eye" title="View Requisition"></i>'), array('action' => 'view', $requisition['Requisition']['id']),array('escape' =>false)); ?>
                                        <?php }?>
                                    <?php if($currentUser['role_id'] ==1 || $currentUser['role_id'] ==4){?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash" title="Delete Requisition"></i>'), array('action' => 'delete', $requisition['Requisition']['id']) ,array('escape' =>false),array(), __('Are you sure you want to delete # %s?', $requisition['Requisition']['id'])); ?>
                                        <?php }?>
                                </td>

                </tr>
                <?php $i++;endforeach; ?>
                </table>
            </div><br><br>
        
                <p>
                <?php
                echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                ));
                ?>	</p>

            <div class="col-md-6">
                <ul class="pagination" style="float: right;">
                        <li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous btn btn-rnd'));?></li>
                        <li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
                        <li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next btn btn-rnd'));?></li>
                </ul>
            </div>

        </div>
    </div>
</div>
