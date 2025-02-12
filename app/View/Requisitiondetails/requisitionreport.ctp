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
<div class="user index">
	<h2><?php echo __('Requisitions'); ?></h2>
	<?php
		echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
	?>
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				
				<td class="col-md-3"></td>
				<td class="col-md-2">
				    <?php echo $this->Form->input ('user_id', array ('type'=>'select','options'=>$users,'class' => 'form-control','label'=>false,'empty'=>'Name' ) );?>
				</td>
				<td class="col-md-3">
				    <?php echo $this->Form->input ('product_id', array ('type'=>'select','options'=>$products,'class' => 'form-control','label'=>false,'empty'=>'Choose product name' ) );?>
				</td>
				<td class="col-md-3"><?php
				echo $this->Form->input ( 'frommonth', array ('type'=>'text','id'=>'FromMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'From') );
				?></td>
				<td class="col-md-3"><?php
				echo $this->Form->input ( 'tomonth', array ('type'=>'text','id'=>'ToMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'To') );
				?></td>
				<td class="col-md-1"><?php
				echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') );
				?></td>
				
			</tr>
		
		</table>
		<br />
	<?php
	echo $this->Form->end ();
	?>
<div class="table-responsive">
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
			<tr>
				<th><?php echo 'Sl.'; ?></th>
				<th><?php echo $this->Paginator->sort('Requisition By'); ?></th>
				<th><?php echo $this->Paginator->sort('Product Name'); ?></th>
				<th><?php echo $this->Paginator->sort('created'); ?></th>
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
					<?php echo h($requisition['Productname']['name']); ?> 
				</td>
				  
				<td>
					<?php echo h($requisition['Requisitionname']['created']); ?> 
				</td>

	        </tr>
		<?php $i++;endforeach; ?>
		</table>
	</div>
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
</div>
