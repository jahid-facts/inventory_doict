

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
                <div class="panel-heading my-heading">Supplier Details</div>
                <div class="panel-body">
                    <div class="my-space-1"></div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered my-padding-0">

                                <tr>
                                    <td>Name :</td>
                                    <td>
                                        <?php echo h($supplier['Supplier']['name']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Mobile :</td>
                                    <td>
                                        <?php echo h($supplier['Supplier']['mobile']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email :</td>
                                    <td>
                                        <?php echo h($supplier['Supplier']['email']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address :</td>
                                    <td>
                                        <?php echo h($supplier['Supplier']['address']); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact Person :</td>
                                    <td>
                                        <?php echo h($supplier['Supplier']['contactperson']); ?>
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


















<!--
<div class="suppliers view">
<h2><?php echo __('Supplier'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['mobile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contactperson'); ?></dt>
		<dd>
			<?php echo h($supplier['Supplier']['contactperson']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Supplier'), array('action' => 'edit', $supplier['Supplier']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Supplier'), array('action' => 'delete', $supplier['Supplier']['id']), array(), __('Are you sure you want to delete # %s?', $supplier['Supplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Suppliers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Supplier'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Purchases'), array('controller' => 'purchases', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Purchase'), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Purchases'); ?></h3>
	<?php if (!empty($supplier['Purchase'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Invoice'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($supplier['Purchase'] as $purchase): ?>
		<tr>
			<td><?php echo $purchase['id']; ?></td>
			<td><?php echo $purchase['invoice']; ?></td>
			<td><?php echo $purchase['supplier_id']; ?></td>
			<td><?php echo $purchase['product_id']; ?></td>
			<td><?php echo $purchase['created']; ?></td>
			<td><?php echo $purchase['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'purchases', 'action' => 'view', $purchase['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'purchases', 'action' => 'edit', $purchase['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'purchases', 'action' => 'delete', $purchase['id']), array(), __('Are you sure you want to delete # %s?', $purchase['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Purchase'), array('controller' => 'purchases', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>-->
