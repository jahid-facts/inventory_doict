<!-- Designed By Arun Kumar -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>
<script>
$(function() {

    $("#datepicker,#datepicker1").datepicker({
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
        text-align: center!important;
        vertical-align: middle!important;
    } 
</style>

<div class="deliveries index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Delivered'); ?> </h3>
        </div> 
        <div class="panel-body">
            <div class="col-sm-10 col-sm-offset-1" style="margin-top:15px;">
                <?php echo $this->Form->create ('Report', array ('name' => 'form') ); ?>
                <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                    <tr>	 
                        <td> 
                            <?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'Select Name'));?> 
                        </td>                                                
                         <td> 
                           <?php echo $this->Form->input('requisitionNo',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>false,'placeholder'=>'Requisition No'));?> 
                        </td> 
                        <td>
                            <?php echo $this->Form->input ('frommonth', array ('class' => 'form-control','id'=>'datepicker', 'label' => false,'required'=>false,'placeholder'=>'From' ) );?> 

                        </td>
                        <td>

                            <?php echo $this->Form->input ('tomonth', array ('class' => 'form-control','id'=>'datepicker1', 'label' => false,'required'=>false,'placeholder'=>'To' ) );?> 

                        </td>
                        <td> 
                            <?php echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info', 'style'=>'font-family:inherit; font-weight:bold;') ); ?>
                        </td>
                    </tr>
                </table>
                <?php echo $this->Form->end (); ?>
             
                <div style="clear: both;"></div>
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                        <tr>
                            <th rowspan="2"><?php echo $this->Paginator->sort('SL.'); ?></th>
                            <th rowspan="2"><?php echo $this->Paginator->sort('Requisition No'); ?></th> 
                            <th colspan="4"><?php echo $this->Paginator->sort('Delivered'); ?></th>  
                            <th class="actions" rowspan="2"><?php echo __('Actions'); ?></th>
                        </tr> 
                        <tr> 
                            <th><?php echo $this->Paginator->sort('Date'); ?></th>
                            <th><?php echo $this->Paginator->sort('By'); ?></th>
                            <th><?php echo $this->Paginator->sort('To'); ?></th>
                            <th><?php echo $this->Paginator->sort('No'); ?></th> 
                        </tr> 

                        <?php
                            $i=$this->Paginator->counter(array('format' => __('{:start}')));
                            foreach ($deliveries as $delivery):        
                        ?> 

                        <tr>
                            <td><?php echo $i;?>&nbsp;</td>
                            <td><?php echo $delivery['Requisition']['requisitionno'];?></td> 
                            <td><?php echo date("d-m-Y",strtotime($delivery['Delivery']['created'])); ?></td>
                            <td>
                                <?php echo $delivery['User']['name']; ?>
                            </td>
                            <td>
                                <?php echo $allusers[$delivery['Requisition']['user_id']]; ?>
                            </td>
                            <td> <?php echo $delivery['Delivery']['orderid'];?></td> 
                            <td class="actions">
                                <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), array('action' => 'deliveryview', $delivery['Delivery']['id'],'views'),array('escape' =>false)); ?>

                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </table>
                </div>
                <div style="clear: both; height: 15px;"></div>
                <div class="col-sm-12" style="text-align: center;">
                    <p>
                        <?php echo $this->Paginator->counter(array( 'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}') )); ?> 
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
</div>    
 


<!-- Designed By Arun Kumar -->

