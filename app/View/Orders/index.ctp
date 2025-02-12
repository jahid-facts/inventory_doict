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
</script>


<script type="text/javascript">
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
        <section class="content-header">
        	<ol class="breadcrumb">
            <li><?php echo $this->Html->link('Dashboard',array('controller'=>'users','action'=>'dashboard'));?></li>
            <li><a href="#">Orders</a></li>
            <li class="active">Orders List</li>
          </ol>
          <h1>
            <small></small>
          </h1>
          
        </section>

  
   
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Orders List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="row">
						<?php echo $this->Form->create('Report',array('url'=>array('controller'=>'orders','action'=>'index'))); ?>
							<div class="col-md-3 input" style="margin-bottom:15px;">
								<?php echo $this->Form->input('mobile',array('div'=>false,'label'=>false,'placeholder'=>'Mobile','class'=>'form-control'));?>
							</div>
							<div class="col-md-3 input" style="margin-bottom:15px;">
								<?php echo $this->Form->input('created',array('id'=>'datepicker','div'=>false,'label'=>false,'placeholder'=>'Date','class'=>'form-control'));?>
							</div>
							
							<div class="col-md-4">
								<?php echo $this->Form->input('Find',array('type'=>'submit','div'=>false,'label'=>false,'class'=>'btn btn-info btn--highlight'));?>
							</div>
						
						<?php echo $this->Form->end();?>
					</div>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('type'); ?></th>
							<th><?php echo $this->Paginator->sort('name'); ?></th>
							<th><?php echo $this->Paginator->sort('mobile'); ?></th>
							<th><?php echo $this->Paginator->sort('email'); ?></th>
							<th><?php echo $this->Paginator->sort('address'); ?></th>
							<th><?php echo $this->Paginator->sort('status'); ?></th>
							<th><?php echo $this->Paginator->sort('created'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order): ?>
						<tr>
							<td><?php echo h($order['Order']['id']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['type']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['name']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['mobile']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['email']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['address']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['status']); ?>&nbsp;</td>
							<td><?php echo h($order['Order']['created']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('View'), array('action' => 'view', $order['Order']['id'])); ?>
								<?php echo $this->Html->link(__('<i style="color: green" class="fa fa-edit"></i>'), array('action' => 'edit',  $order['Order']['id']),array('escape' =>false,'title'=>'Edit')); ?>
							<?php echo $this->Form->postLink(__('<i style="color: red" class="fa fa-trash-o"></i>'), array('action' => 'delete',  $order['Order']['id']),array('escape' =>false), __('Are you sure you want to delete # %s?',$order['Order']['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
                  
                     
                    </tbody>
                   
                  </table>
                  <p>
					<?php
					echo $this->Paginator->counter(array(
						'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
					));
					?>	</p>
					<div class="paging">
					<?php
						echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
						echo $this->Paginator->numbers(array('separator' => ''));
						echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
					?>
					</div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              
            </div><!-- /.col -->
          
          </div><!-- /.row -->
        </section><!-- /.content -->

