<!-- Designed By Arun Kumar -->
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

<div class="deliveries index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Product Return'); ?> </h3>
        </div>
    
     
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2 table-responsive" style="margin-top:30px;">
                <?php echo $this->Form->create ('Report', array ('name' => 'form') ); ?>
                <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                    <tr>						

                        <td> 
                            <?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'Select Name'));?>
                        </td>
                                                                          
                         <td>

                           <?php echo $this->Form->input('requisitionNo',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>false,'placeholder'=>'Requisition / Delivery No'));?>

                        </td> 
                        <td> 
                            <?php echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info', 'style'=>'font-family:inherit; font-weight:bold;') ); ?>
                        </td>
                    </tr>
                </table>
                <?php echo $this->Form->end (); ?>
            
                <div style="clear: both;"></div> 

                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr> 
                        <th><?php echo $this->Paginator->sort('Delivered Date'); ?></th> 
                        <th><?php echo $this->Paginator->sort('Requisitioner Name'); ?></th>
                        <th><?php echo $this->Paginator->sort('Requisition No'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivery No'); ?></th>  
                        <th class="actions" style="text-align: center;"><?php echo __('Actions'); ?></th>
                    </tr>

                        <?php
                           $i=$this->Paginator->counter(array('format' => __('{:start}')));
                            foreach ($deliveries as $delivery):    
                         ?>

                    <tr>
                        <td><?php echo date("d-m-Y",strtotime($delivery['Delivery']['created'])); ?></td> 
                        <td>
                            <?php echo $allusers[$delivery['Requisition']['user_id']]; ?>
                        </td>
                        <td><?php echo $delivery['Requisition']['requisitionno'] ;?></td>
                        <td><?php echo $delivery['Delivery']['orderid'];?></td>                         
                        <td class="actions" style="text-align: center;">  
                            <?php echo $this->Html->link(__('<i class="fa fa-reply-all"></i>'), array('action' => 'proreturn', $delivery['Delivery']['id']),array('escape' =>false,'title'=>'Requisition Product Return')); ?>
                        </td>

                    </tr>
                    <?php $i++; endforeach; ?>
                </table>
            </div>
            <div style="clear: both; height: 15px;"></div>
            <div class="col-sm-12" style="text-align: center;">
                <p> <?php echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                )); ?> </p>
                <ul class="pagination">
                    <li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous btn btn-rnd'));?></li>
                    <li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
                    <li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next btn btn-rnd'));?></li>
                </ul>
            </div>
        </div> 
    </div> 
</div>    
 


<!-- Designed By Arun Kumar -->

