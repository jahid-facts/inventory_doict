<?php 
    echo $this->Html->script('jquery-ui');
	echo $this->Html->css('jquery-ui');
	
?>
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
<div class="purchases index">
    <h2><?php echo __('Purchases'); ?></h2>
    <?php
		echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
	?>
		<table width="100%" cellpadding="0" cellspacing="0">
			<tr>
				
				<td class="col-md-2"></td>
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
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
            <tr>
                <th><?php echo 'Sl.'; ?></th>
                <th><?php echo $this->Paginator->sort('invoice'); ?></th>
                <th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
                <th><?php echo $this->Paginator->sort('product'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                
            </tr>

                <?php
                    $i=$this->Paginator->counter(array('format' => __('{:start}')));
                    foreach ($purchases as $purchase):
                    /*echo "<pre>";
                    print_r($purchase);
                    echo "<pre>";*/
                 ?>

            <tr>
                <td><?php echo $i; ?>&nbsp;</td>
				<td><?php echo h($purchase['Purchasename']['invoice']); ?>&nbsp;</td>
				<td>
		            <?php echo $this->Html->link($purchase['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchase['Supplier']['id'])); ?>
				</td>
				<td><?php echo h($purchase['Productname']['name']); ?>&nbsp;</td>
				<td><?php echo h($purchase['Purchasename']['created']); ?>&nbsp;</td>
				<td><?php echo h($purchase['Purchasename']['modified']); ?>&nbsp;</td>
   
            </tr>
            <?php $i++; endforeach; ?>
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

 








<!--<div class="purchases index">
	<h2><?php echo __('Purchases'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('invoice'); ?></th>
			<th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($purchases as $purchase): ?>
	<tr>
		<td><?php echo h($purchase['Purchase']['id']); ?>&nbsp;</td>
		<td><?php echo h($purchase['Purchase']['invoice']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($purchase['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchase['Supplier']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($purchase['Product']['name'], array('controller' => 'products', 'action' => 'view', $purchase['Product']['id'])); ?>
		</td>
		<td><?php echo h($purchase['Purchase']['created']); ?>&nbsp;</td>
		<td><?php echo h($purchase['Purchase']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $purchase['Purchase']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $purchase['Purchase']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $purchase['Purchase']['id']), array(), __('Are you sure you want to delete # %s?', $purchase['Purchase']['id'])); ?>
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
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Purchase'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Suppliers'), array('controller' => 'suppliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier'), array('controller' => 'suppliers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchasedetails'), array('controller' => 'purchasedetails', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchasedetail'), array('controller' => 'purchasedetails', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
