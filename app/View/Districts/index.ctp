<?php
echo $this->Html->script(array('jquery.battatech.excelexport'));
?>
<script>
$(document).ready(function () {

	//alert('ok');
	
    $("#btnExport").click(function () {
        
    	$( ".etype3" ).remove();
	   	 $( ".etype4" ).remove();
	   	 $( ".etype5" ).remove();
	   	 $( ".etype6" ).remove();
	   	 
        $("#tblExport").btechco_excelexport({
            containerid: "tblExport"
           , datatype: $datatype.Table
        });
        
        location.href="<?php echo $this->here?>";

            
    });

    
});
</script>

<div class="users index main-content-inner">
	<div class="page-content">
	<div>
	<a class="btn btn-primary"  href="<?php echo $this->webroot?>divisions/index">Divisions</a>
			<a class="btn btn-primary"  href="<?php echo $this->webroot?>districts/index">Districts</a>
			<a class="btn btn-primary"  href="<?php echo $this->webroot?>thanas/index">Thanas</a>
			<a class="btn btn-primary"  href="<?php echo $this->webroot?>designations/index/1">Designations</a>
			<button class="btn btn-primary" id="btnExport">Export Excel</button>
	</div>
	<h2><?php echo __('Districts'); ?></h2>
	<table id="tblExport" cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
			
			<th><?php echo $this->Paginator->sort('division_id','Division Name'); ?></th>
			<th><?php echo $this->Paginator->sort('division_id','Division Value'); ?></th>
			<th><?php echo $this->Paginator->sort('name','District Name'); ?></th>
			<th><?php echo $this->Paginator->sort('name','District Value'); ?></th>
			 <th><?php echo $this->Paginator->sort('namebn'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			 <?php if($current_user['role'] ==4){?>
			 <th class="actions"><?php echo __('Actions'); ?></th> 
			 <?php }?>
	</tr>
	<?php foreach ($districts as $district): ?>
	<tr>
		
		<td>
			<?php echo $this->Html->link($district['Division']['name'], array('controller' => 'divisions', 'action' => 'view', $district['Division']['id'])); ?>
		</td>
		<td><?php echo h($district['Division']['id']); ?>&nbsp;</td>
		<td><?php echo h($district['District']['name']); ?>&nbsp;</td>
		<td><?php echo h($district['District']['id']); ?>&nbsp;</td>
		 <td><?php echo h($district['District']['namebn']); ?>&nbsp;</td>
		<td><?php echo h($district['District']['status']); ?>&nbsp;</td>
		 <?php if($current_user['role'] ==4){?>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $district['District']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $district['District']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $district['District']['id']), array(), __('Are you sure you want to delete # %s?', $district['District']['id'])); ?>
		</td> 
		 <?php }?>
	</tr>
<?php endforeach; ?>
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
</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New District'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Divisions'), array('controller' => 'divisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Division'), array('controller' => 'divisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teachers'), array('controller' => 'teachers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teacher'), array('controller' => 'teachers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Thanas'), array('controller' => 'thanas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thana'), array('controller' => 'thanas', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
</div>