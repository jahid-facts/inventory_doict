<link rel="stylesheet" href="<?php echo $this->webroot;?>css/newdis.css">
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>

<script>
    $(function() {

        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            yearRange:"-100:+50"
        });


    }); 
</script>

<div class="brands index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Adjustment List'); ?> 
                <span class="ad-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Adjustment'), array('controller' => 'products','action' => 'padjustment'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?> 
                </span>
            </h3>
        </div>
        <div class="panel-body">  
            <div class="col-sm-8 col-sm-offset-2">
                <?php echo $this->Session->flash(); ?>

                <?php echo $this->Form->create ('Report', array ('name' => 'form') ); ?>
                <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                    <tr>                        

                        <td> 
                            <?php echo $this->Form->input('dnumber',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>false,'placeholder'=>'Delivery No'));?>
                        </td>
                                                                          
                        <td>

                           <?php echo $this->Form->input('approvedrefNo',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>false,'placeholder'=>'Approved Ref. No.'));?>

                        </td> 
                        <td> 
                            <?php echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info', 'style'=>'font-family:inherit; font-weight:bold;') ); ?>
                        </td>
                    </tr>
                </table>
                <?php echo $this->Form->end (); ?>
            
                <div style="clear: both;"></div> 

                <table cellpadding="0" cellspacing="0" class="table table-bordered" id="dataTables-example">
                    <tr>
                       	<th><?php echo $this->Paginator->sort('S/N'); ?></th>
                        <th><?php echo $this->Paginator->sort('Adjustment Date'); ?></th>
						<th><?php echo $this->Paginator->sort('Adjustment by'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivery No'); ?></th>
						<th><?php echo $this->Paginator->sort('Approved ref. No'); ?></th> 
						<th class="actions" style="text-align: center;"><?php echo __('Actions'); ?></th>
                    </tr>

                   <?php  $i=$this->Paginator->counter(array('format' => __('{:start}')));
                    foreach ($damages as $damage): ?>

                    <tr>
                       	<td><?php echo $i; ?>&nbsp;</td>
                        <td>
                            <?php echo  date("d-m-Y",strtotime($damage['Damage']['ddate'])); ?>
                        </td>
						<td><?php echo $damage['Damage']['adjBye'];?>&nbsp;</td>
                        <td>
                            <?php echo h($damage['Damage']['dnumber']); ?>
                        </td> 
						<td>
							<?php echo h($damage['Damage']['rnumber']); ?>
						</td> 
                        <td class="actions" style="text-align: center;"> 
                            <?php echo $this->Html->link(__('<i class="fa fa-eye" title="View"></i>'), array('action' => 'view', $damage['Damage']['dnumber']),array('escape' =>false)); ?> 
                        </td> 
                    </tr>
                    <?php $i++; endforeach; ?>
                </table>
            </div> 
            <div style="clear: both; height: 10px;"> </div>
            <div class="col-sm-12" style="text-align:center;">
                <p>
                    <?php
                        echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}') ));
                    ?>  
                </p>
                <ul class="pagination">
                        <li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous btn btn-rnd'));?></li>
                        <li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
                        <li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next btn btn-rnd'));?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
