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
          <h3 class="panel-title"> <?php echo __('Delivered'); ?> </h3>
        </div>
    
     <?php echo $this->Session->flash(); ?>
        <div class="panel-body">
            <div style="margin-top:30px;">
           <?php
                   echo $this->Form->create ('Report', array ('name' => 'form') );
           ?>
                <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                        <tr>                        

                            <td>

                                    <?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'select requisitioner name'));?>

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
                                                        <!--<button type="submit" class="btn btn-default">Search</button>-->
                                                        <?php
                            echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info', 'style'=>'font-family:inherit; font-weight:bold;') );
                            ?>
                                                </td>
                        </tr>
                </table>
           <?php
                   echo $this->Form->end ();
           ?>
            </div>

    
            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                        <th><?php echo $this->Paginator->sort('S/N.'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivered By'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivered to'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivery No'); ?></th>
                        <th><?php echo $this->Paginator->sort('Requisition No'); ?></th>
                        <th><?php echo $this->Paginator->sort('Date & Time'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>

                        <?php
                            $i=1;
                            foreach ($deliveries as $delivery):                   
                                
                         ?>

                    <tr>
                        <td><?php echo $i;?>&nbsp;</td>
                        <td>
                                <?php echo $this->Html->link($delivery['User']['name'], array('controller' => 'users', 'action' => 'view', $delivery['User']['id'])); ?>
                        </td>
                        <td>
                                <?php echo $this->Html->link($allusers[$delivery['Requisition']['user_id']], array('controller' => 'requisitions', 'action' => 'view', $delivery['Requisition']['id'])); ?>
                        </td>
                        <td>DO <?php echo substr($delivery['Delivery']['created'],0,4)."-".substr($delivery['Delivery']['orderid'],1,6) ;?> &nbsp;</td>
                        <td>RQ <?php echo substr($delivery['Requisition']['created'],0,4)."-".substr($delivery['Requisition']['requisitionno'],1,6) ;?> &nbsp;</td>
                        <td><?php echo h($delivery['Delivery']['created']); ?>&nbsp;</td>
                        <td class="actions">

                                <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), array('action' => 'deliveryview', $delivery['Delivery']['id']),array('escape' =>false)); ?>

                        </td>

                    </tr>
                    <?php $i++; endforeach; ?>
                </table>
            </div><br><br>
        
                <p>
                <?php
                echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                ));
                ?>  </p>

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