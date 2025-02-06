

<br><br>
<style>
	.my-heading{
		font-size:20px;
		text-align:center;
		font-weight:bold;
	}


	.my-space-1{
		height:15px;
	}

</style>

<div class="col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading my-heading">Product</div>
				<div class="panel-body">
					<div class="my-space-1"></div>

					<div class="row">
						<div class="col-sm-12">
							<table class="table table-bordered my-padding-0">

								<tr>
									<td>Category :</td>
									<td>
										<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
									</td>
								</tr>
								<tr>
									<td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Productcode :</td>
									<td>
										<?php echo h($product['Product']['productcode']); ?>
									</td>
								</tr>
								<tr>
									<td>Name :</td>
									<td>
										<?php echo h($product['Product']['name']); ?>
									</td>
								</tr>
								<tr>
									<td>Price :</td>
									<td>
										<?php echo h($product['Product']['price']); ?>
									</td>
								</tr>
								<tr>
									<td>Limitation :</td>
									<td>
										<?php echo h($product['Product']['limitation']); ?>
									</td>
								</tr>
								<tr>
									<td>Description :</td>
									<td>
										<?php echo h($product['Product']['description']); ?>
									</td>
								</tr>
								<tr>
									<td>Status :</td>
									<td>
										<?php echo h($status[$product['Product']['status']]); ?>
									</td>
								</tr>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</div><!--/.main-->

















<!--<div class="products view">-->
<!--<h2>--><?php //echo __('Product'); ?><!--</h2>-->
<!--	<dl>-->
<!--		<dt>--><?php //echo __('Id'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($product['Product']['id']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Category'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Productcode'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($product['Product']['productcode']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Name'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($product['Product']['name']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Price'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($product['Product']['price']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Limitation'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($product['Product']['limitation']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Description'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($product['Product']['description']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--		<dt>--><?php //echo __('Status'); ?><!--</dt>-->
<!--		<dd>-->
<!--			--><?php //echo h($product['Product']['status']); ?>
<!--			&nbsp;-->
<!--		</dd>-->
<!--	</dl>-->
<!--</div>-->
<!--<!--<div class="actions">-->
<!--	<h3>--><?php //echo __('Actions'); ?><!--</h3>-->
<!--	<ul>-->
<!--		<li>--><?php //echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), array(), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Products'), array('action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Product'), array('action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Deliveries'), array('controller' => 'deliveries', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Delivery'), array('controller' => 'deliveries', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Purchases'), array('controller' => 'purchases', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Purchase'), array('controller' => 'purchases', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Requisitions'), array('controller' => 'requisitions', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Requisition'), array('controller' => 'requisitions', 'action' => 'add')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('List Stocks'), array('controller' => 'stocks', 'action' => 'index')); ?><!-- </li>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Stock'), array('controller' => 'stocks', 'action' => 'add')); ?><!-- </li>-->
<!--	</ul>-->
<!--</div>-->-->
<!--<div class="related">-->
<!--	<h3>--><?php //echo __('Related Deliveries'); ?><!--</h3>-->
<!--	--><?php //if (!empty($product['Delivery'])): ?>
<!--	<table cellpadding = "0" cellspacing = "0">-->
<!--	<tr>-->
<!--		<th>--><?php //echo __('Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('User Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Product Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Orderid'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Requisitionno'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Created'); ?><!--</th>-->
<!--		<th class="actions">--><?php //echo __('Actions'); ?><!--</th>-->
<!--	</tr>-->
<!--	--><?php //foreach ($product['Delivery'] as $delivery): ?>
<!--		<tr>-->
<!--			<td>--><?php //echo $delivery['id']; ?><!--</td>-->
<!--			<td>--><?php //echo $delivery['user_id']; ?><!--</td>-->
<!--			<td>--><?php //echo $delivery['product_id']; ?><!--</td>-->
<!--			<td>--><?php //echo $delivery['orderid']; ?><!--</td>-->
<!--			<td>--><?php //echo $delivery['requisitionno']; ?><!--</td>-->
<!--			<td>--><?php //echo $delivery['created']; ?><!--</td>-->
<!--			<td class="actions">-->
<!--				--><?php //echo $this->Html->link(__('View'), array('controller' => 'deliveries', 'action' => 'view', $delivery['id'])); ?>
<!--				--><?php //echo $this->Html->link(__('Edit'), array('controller' => 'deliveries', 'action' => 'edit', $delivery['id'])); ?>
<!--				--><?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'deliveries', 'action' => 'delete', $delivery['id']), array(), __('Are you sure you want to delete # %s?', $delivery['id'])); ?>
<!--			</td>-->
<!--		</tr>-->
<!--	--><?php //endforeach; ?>
<!--	</table>-->
<?php //endif; ?>
<!---->
<!--	<div class="actions">-->
<!--		<ul>-->
<!--			<li>--><?php //echo $this->Html->link(__('New Delivery'), array('controller' => 'deliveries', 'action' => 'add')); ?><!-- </li>-->
<!--		</ul>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="related">-->
<!--	<h3>--><?php //echo __('Related Purchases'); ?><!--</h3>-->
<!--	--><?php //if (!empty($product['Purchase'])): ?>
<!--	<table cellpadding = "0" cellspacing = "0">-->
<!--	<tr>-->
<!--		<th>--><?php //echo __('Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Invoice'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Supplier Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Product Id'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Created'); ?><!--</th>-->
<!--		<th>--><?php //echo __('Modified'); ?><!--</th>-->
<!--		<th class="actions">--><?php //echo __('Actions'); ?><!--</th>-->
<!--	</tr>-->
<!--	--><?php //foreach ($product['Purchase'] as $purchase): ?>
<!--		<tr>-->
<!--			<td>--><?php //echo $purchase['id']; ?><!--</td>-->
<!--			<td>--><?php //echo $purchase['invoice']; ?><!--</td>-->
<!--			<td>--><?php //echo $purchase['supplier_id']; ?><!--</td>-->
<!--			<td>--><?php //echo $purchase['product_id']; ?><!--</td>-->
<!--			<td>--><?php //echo $purchase['created']; ?><!--</td>-->
<!--			<td>--><?php //echo $purchase['modified']; ?><!--</td>-->
<!--			<td class="actions">-->
<!--				--><?php //echo $this->Html->link(__('View'), array('controller' => 'purchases', 'action' => 'view', $purchase['id'])); ?>
<!--				--><?php //echo $this->Html->link(__('Edit'), array('controller' => 'purchases', 'action' => 'edit', $purchase['id'])); ?>
<!--				--><?php //echo $this->Form->postLink(__('Delete'), array('controller' => 'purchases', 'action' => 'delete', $purchase['id']), array(), __('Are you sure you want to delete # %s?', $purchase['id'])); ?>
<!--			</td>-->
<!--		</tr>-->
<!--	--><?php //endforeach; ?>
<!--	</table>-->
<?php //endif; ?>
<!---->
<!--	<div class="actions">-->
<!--		<ul>-->
<!--			<li>--><?php //echo $this->Html->link(__('New Purchase'), array('controller' => 'purchases', 'action' => 'add')); ?><!-- </li>-->
<!--		</ul>-->
<!--	</div>-->
<!--</div>-->
<!---->
<!---->
