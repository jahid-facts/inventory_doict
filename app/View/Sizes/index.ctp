

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


<div class="sizes index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Size List'); ?> 
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Size'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>
            </h3>
        </div>
        <div class="panel-body"> 
            <div class="col-sm-4 col-sm-offset-4">
                <?php echo $this->Session->flash(); ?> 
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                        <th style="width: 15%;"><?php echo $this->Paginator->sort('id','SL'); ?></th>
                        <th style="width: 60%;"><?php echo $this->Paginator->sort('name'); ?></th>
                        <th style="width: 25%;" class="actions" style="text-align: center;"><?php echo __('Actions'); ?></th>
                    </tr>

                    <?php
                    $i=$this->Paginator->counter(array('format' => __('{:start}')));
                    foreach ($sizes as $size):
                            ?>

                    <tr>
                        <td><?php echo h($size['Size']['id']); ?>&nbsp;</td>
                        <td><?php echo h($size['Size']['name']); ?>&nbsp;</td>
                        <td class="actions " style="text-align: center;"> 
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $size['Size']['id']),array('escape' =>false)); ?>
                        </td> 
                    </tr>
                    <?php $i++; endforeach; ?>
                </table>
            </div> 
            <div style="clear: both; height: 10px;"> </div>
            <div class="col-sm-12 text-center">
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
        </div>
    </div>
</div>






















<!--<div class="sizes index">-->
<!--	<h2>--><?php //echo __('Sizes'); ?><!--</h2>-->
<!--	<table cellpadding="0" cellspacing="0">-->
<!--	<thead>-->
<!--	<tr>-->
<!--			<th>--><?php //echo $this->Paginator->sort('id'); ?><!--</th>-->
<!--			<th>--><?php //echo $this->Paginator->sort('name'); ?><!--</th>-->
<!--			<th class="actions">--><?php //echo __('Actions'); ?><!--</th>-->
<!--	</tr>-->
<!--	</thead>-->
<!--	<tbody>-->
<!--	--><?php //foreach ($sizes as $size): ?>
<!--	<tr>-->
<!--		<td>--><?php //echo h($size['Size']['id']); ?><!--&nbsp;</td>-->
<!--		<td>--><?php //echo h($size['Size']['name']); ?><!--&nbsp;</td>-->
<!--		<td class="actions">-->
<!--			--><?php //echo $this->Html->link(__('View'), array('action' => 'view', $size['Size']['id'])); ?>
<!--			--><?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $size['Size']['id'])); ?>
<!--			--><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $size['Size']['id']), array(), __('Are you sure you want to delete # %s?', $size['Size']['id'])); ?>
<!--		</td>-->
<!--	</tr>-->
<?php //endforeach; ?>
<!--	</tbody>-->
<!--	</table>-->
<!--	<p>-->
<!--	--><?php
//	echo $this->Paginator->counter(array(
//	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
//	));
//	?><!--	</p>-->
<!--	<div class="paging">-->
<!--	--><?php
//		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
//		echo $this->Paginator->numbers(array('separator' => ''));
//		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
//	?>
<!--	</div>-->
<!--</div>-->
<!--<div class="actions">-->
<!--	<h3>--><?php //echo __('Actions'); ?><!--</h3>-->
<!--	<ul>-->
<!--		<li>--><?php //echo $this->Html->link(__('New Size'), array('action' => 'add')); ?><!--</li>-->
<!--	</ul>-->
<!--</div>-->
