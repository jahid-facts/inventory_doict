<style>
     .btn.btn-rounded {
        background: #0a99d4 none repeat scroll 0 0;
        border-radius: 12px;
        border-width: 2px;
        color: #fff;
        font-weight: 600;
        padding: 2px 10px;
        float: right;
        margin-top: -5px;
    }
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
    .thla th {
            color: #0088cc;
            text-align: left;
        }
    .add-span a {
        float: right;
    }
    .message {
        margin: 5px 0px;
        background: #f2f3f7;
        padding: 4px;
        color: #2d6f2d;
        text-align: center;
        font-size: 20px;
    }
</style>

<div class="categories index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Sub-Category List'); ?> 
                <span class="add-span">
                  <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Sub-Category'), array('action' => 'addsub'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
        
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Main Category'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false,'style'=>'margin-right: 15px;')); ?>
                </span>
            </h3>
        </div>
        <div class="panel-body">  
    		<div class="row"> 
    			<div class="col-sm-8 col-sm-offset-2">
                    <?php echo $this->Session->flash(); ?>
    				<div class="table-responsived">
                        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                                <tr>
                                <th style="width: 6%;">SL.</th>
                                    <th><?php echo $this->Paginator->sort('name','Main Category Code'); ?></th>
                                    <th><?php echo $this->Paginator->sort('name','Main Category Name'); ?></th>
                                    <th><?php echo $this->Paginator->sort('Sub-Category Code'); ?></th>
                                    <th><?php echo $this->Paginator->sort('parent_id','Sub-Category Name'); ?></th>
                                    <th class="actions" style="text-align: center;"><?php echo __('Actions'); ?></th>
                                </tr>

                                <?php
                                 $i=1;
                                 foreach ($categories as $category):
                                    $onlySub=$category['ParentCategory']['parent_id'];
                                     if($onlySub==-1){
                                         
                                    
                                 ?>

                                <tr>
                                    <td style="width: 6%;"><?php echo $i; ?>&nbsp;</td>
                                    <td><?php echo h($category['ParentCategory']['cCode']); ?>&nbsp;</td>
                                    <td><?php echo h($category['ParentCategory']['name']); ?>&nbsp;</td>
                                    <td><?php echo h($category['Category']['sCode']); ?>&nbsp;</td>
                                    <td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
                                    <td class="actions" style="text-align: center;"> 
                                        <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil" title="Edit Sub-Category"></i>'), array('action' => 'editsub', $category['Category']['id']),array('style'=>'margin-right: 10px;','escape' =>false)); ?> 
                                    </td>
                                </tr>

                            <?php  $i++; }  endforeach; ?>
                        </table>
                    </div>
    			</div> 
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









































<!--<div class="categories index">
	<h2><?php echo __('Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sl'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($category['ParentCategory']['name'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?>
		</td>
		<td><?php echo h($category['Category']['sl']); ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $category['Category']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $category['Category']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $category['Category']['id']), array(), __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>-->
