<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>

<script type="text/javascript">
  $(function() {

    $( "#datepicker").datepicker(
      {
          dateFormat:'yy-mm-dd',
          changeMonth:true,
          changeYear:true,
          yearRange:"-10:+5",

      }
    );
  });
 


 
  $(function() {

    $( "#datepicker1").datepicker(
      {
          dateFormat:'yy-mm-dd',
          changeMonth:true,
          changeYear:true,
          yearRange:"-10:+5",

      }
    );
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
         .thla th{
        text-align: left;
    }
</style>
<div class="deliveries index">
    <div style="height:20px;"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Deliveries'); ?> </h3>
        </div>
            <?php echo $this->Session->flash(); ?>
        <div class="panel-body">           
                <?php
                        echo $this->Form->create ('Report', array ('name' => 'form') );
                ?>
                <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                        <tr>						

                            <td>

                                                   <?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'select requisitioner name'));?>

                                                </td>

                                                <td>

                                                        <?php echo $this->Form->input ('frommonth', array ('class' => 'form-control','id'=>'datepicker', 'label' => false,'required'=>false,'placeholder'=>'From' ) );?> 

                                                </td>
                                                <td>

                                                        <?php echo $this->Form->input ('tomonth', array ('class' => 'form-control','id'=>'datepicker1', 'label' => false,'required'=>false,'placeholder'=>'To' ) );?> 

                                                </td>
                                                <td>
                                                        <?php
                            echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') );
                            ?>
                                                </td>
                        </tr>
                </table>
                <?php
                        echo $this->Form->end ();
                ?>
            
            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                        <th><?php echo $this->Paginator->sort('id'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivery By'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivery to'); ?></th>
                        <th><?php echo $this->Paginator->sort('Delivery No'); ?></th>
                         <th><?php echo $this->Paginator->sort('Requisition No'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>

                    </tr>

                        <?php
                            $i=$this->Paginator->counter(array('format' => __('{:start}')));
                            foreach ($deliveries as $delivery): 

                         ?>

                        <tr>
                            <td><?php echo h($delivery['Delivery']['id']); ?>&nbsp;</td>
                            <td>
                                    <?php echo $this->Html->link($delivery['User']['name'], array('controller' => 'users', 'action' => 'view', $delivery['User']['id'])); ?>
                            </td>
                            <td>
                                    <?php echo $this->Html->link($users[$delivery['Requisition']['user_id']], array('controller' => 'requisitions', 'action' => 'view', $delivery['Requisition']['id'])); ?>
                            </td>
                            <td>
                           	 	DO <?php echo substr($delivery['Delivery']['created'],0,4)."-".substr($delivery['Delivery']['orderid'],1,6) ;?>
                            	
                            </td>
                            <td>
                            RQ <?php echo substr($delivery['Requisition']['created'],0,4)."-".substr($delivery['Requisition']['requisitionno'],1,6) ;?>
                            
                            </td>
                            <td><?php echo h($delivery['Delivery']['created']); ?>&nbsp;</td>

                        </tr>
                    <?php $i++; endforeach; ?>
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