<div class="purchasedetails index">
	<h2><?php echo __('Purchasedetails'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>                        
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('purchase_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('quantity'); ?></th>
			<th><?php echo $this->Paginator->sort('measure_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($purchasedetails as $purchasedetail): ?>
	<tr>
                <td><?php echo h($purchasedetail['Purchasedetail']['id']); ?>&nbsp;</td>
		<td>
                    <?php echo $this->Html->link($purchasedetail['Product']['name'], array('controller' => 'products', 'action' => 'view', $purchasedetail['Product']['id'])); ?>
		</td>
		
		<td>
                    <?php echo $this->Html->link($purchasedetail['Purchase']['id'], array('controller' => 'purchases', 'action' => 'view', $purchasedetail['Purchase']['id'])); ?>
		</td>
                <td><?php echo h($purchasedetail['Purchasedetail']['price']); ?>&nbsp;</td>
		<td><?php echo h($purchasedetail['Purchasedetail']['quantity']); ?>&nbsp;</td>		
		<td>
			<?php echo $this->Html->link($purchasedetail['Measure']['name'], array('controller' => 'measures', 'action' => 'view', $purchasedetail['Measure']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $purchasedetail['Purchasedetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $purchasedetail['Purchasedetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $purchasedetail['Purchasedetail']['id']), array(), __('Are you sure you want to delete # %s?', $purchasedetail['Purchasedetail']['id'])); ?>
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

	<div class="col-md-6">
		<ul class="pagination" style="float: right;">
			<li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous disabled'));?></li>
			<li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
			<li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next disabled'));?></li>
		</ul>
	</div>

</div>
<!--<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Purchasedetail'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Purchases'), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase'), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Measures'), array('controller' => 'measures', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Measure'), array('controller' => 'measures', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
