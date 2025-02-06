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
	<h2><?php echo __('Divisions'); ?></h2>
	<table id="tblExport" cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
	<tr>
			
			<th><?php echo $this->Paginator->sort('name','Division Name'); ?></th>
			<th><?php echo $this->Paginator->sort('id','Division Value'); ?></th>
			<!--<th class="actions"><?php echo __('Actions'); ?></th>-->
	</tr>
	<?php foreach ($divisions as $division): ?>
	<tr>
		
		<td><?php echo h($division['Division']['name']); ?>&nbsp;</td>
		<td><?php echo h($division['Division']['id']); ?>&nbsp;</td>
		<!--<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $division['Division']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $division['Division']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $division['Division']['id']), array(), __('Are you sure you want to delete # %s?', $division['Division']['id'])); ?>
		</td>-->
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
		<li><?php echo $this->Html->link(__('New Division'), array('action' => 'add')); ?></li>
	</ul>
</div>-->
</div>