<?php
    echo $this->Html->css(array('jquery-ui.min'));
    echo $this->Html->script(array('jq.ui.min'));
?>
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
<style type="text/css">
    .glyphicon-trash {
        color: red!important;
    }
</style>

<div class="logs index">
    <div style="clear: both; height: 20px;"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title" > <?php echo __('Foot Print'); ?></h1>               
        </div>
        <div class="panel-body">      
            <?php echo $this->Form->create('Log'); ?>
            <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                <tr>  
                    <td>
                        <?php echo $this->Form->input ('user_id', array ('class' => 'form-control' ,'label' => false,'required'=>false,'placeholder'=>'User','empty'=>'Select' ) );?> 
                    </td>
                    <td>
                        <?php echo $this->Form->input ('ip', array ('class' => 'form-control','label' => false,'required'=>false,'placeholder'=>'Ip' ) );?> 
                    </td>
                    <td>
                        <?php echo $this->Form->input ('frommonth', array ('class' => 'form-control','id'=>'datepicker', 'label' => false,'required'=>false,'placeholder'=>'From' ) );?> 
                    </td>
                    <td>
                        <?php echo $this->Form->input ('tomonth', array ('class' => 'form-control','id'=>'datepicker1', 'label' => false,'required'=>false,'placeholder'=>'To' ) );?> 
                    </td>
                    
                    <td>
                        <?php echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') ); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->button('Delete', array('class' => 'btn btn-danger', 'name' => 'btndelete', 'title' => 'keep only last 1000 entries', 'onclick' => 'return confirm(\'Please confirm again\')')); ?>
                    </td>
                </tr> 
            </table>
            <?php echo $this->Form->end (); ?>
            <div style="clear: both;"></div>  

            
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th><?php echo $this->Paginator->sort('user_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('ip'); ?></th>
                        <th><?php echo $this->Paginator->sort('port'); ?></th>
                        <th><?php echo $this->Paginator->sort('controller'); ?></th>
                        <th><?php echo $this->Paginator->sort('action'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; foreach ($logs as $log): ?>
                        <tr>
                            <td><?php echo ++ $i; ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($log['User']['username'], array('controller' => 'users', 'action' => 'view', $log['User']['id'])); ?>
                            </td>
                            <td><?php echo h($log['Log']['ip']); ?>&nbsp;</td>
                            <td><?php echo h($log['Log']['port']); ?>&nbsp;</td>
                            <td><?php echo h($log['Log']['controller']); ?>&nbsp;</td>
                            <td><?php echo h($log['Log']['action']); ?>&nbsp;</td>
                            <td><?php echo h($log['Log']['created']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash" title="Delete"></i>'), array('action' => 'delete', $log['Log']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $log['Log']['id']), 'escape' => false)); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div style="clear: both; height: 10px;"> </div>
            <div class="col-sm-12" style="text-align: center;">
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
            <div class="clearfix"></div> 
        </div>
    </div>
</div>
