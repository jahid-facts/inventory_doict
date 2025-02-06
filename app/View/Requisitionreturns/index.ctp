<style type="text/css">
    th{
        vertical-align: middle!important;
    }
</style>
<div class="brands index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Product Return List'); ?> 
             
            </h3>
        </div>
        <div class="panel-body">  
            <div class="col-sm-8 col-sm-offset-2">
                <?php echo $this->Session->flash(); ?> 
                 
                <?php echo $this->Form->create ('Report', array ('name' => 'form') ); ?>
                <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                    <tr>                        

                        <td> 
                            <?php echo $this->Form->input('user_id',array('options'=>$requsers,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'Select Name'));?>
                        </td>
                                                                          
                         <td>

                           <?php echo $this->Form->input('returnNo',array('type'=>'text','class'=>'form-control','label'=>false,'required'=>false,'placeholder'=>'Requisition Return No'));?>

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
                       	<th rowspan="2"><?php echo $this->Paginator->sort('SL'); ?></th>
                        <th colspan="4"><?php echo $this->Paginator->sort('Product Returned'); ?></th> 
						<th rowspan="2" class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    <tr>
                        <th><?php echo $this->Paginator->sort('Date'); ?></th>
                        <th><?php echo $this->Paginator->sort('by'); ?></th>
                        <th><?php echo $this->Paginator->sort('to'); ?></th>
                        <th><?php echo $this->Paginator->sort('no'); ?></th> 
                    </tr>

                  <?php $i=$this->Paginator->counter(array('format' => __('{:start}')));
                  foreach ($returnviews as $requisitionreturn): ?>
                    <tr>
                        <td><?php echo $i; ?>&nbsp;</td>
                        <td>
                            <?php echo date("d-m-Y",strtotime($requisitionreturn['Requisitionreturn']['ddate'])); ?>&nbsp;
                        </td>
						<td>
                            <?php echo h($requisitionreturn['User']['name']); ?>&nbsp;
                        </td>
						<td>
							<?php echo $storekeeperuserindex[$requisitionreturn['Requisitionreturn']['user_id']]; ?>
						</td>
						<td>
							<?php echo h($requisitionreturn['Requisitionreturn']['rrnumber']); ?>
						</td> 
                        <td class="actions" style="text-align: center;"> 
                            <?php echo $this->Html->link(__('<i class="fa fa-eye" title="View"></i>'), array('action' => 'view', $requisitionreturn['Requisitionreturn']['rrnumber'],'reviews'),array('escape' =>false)); ?> 
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

