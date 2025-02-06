<style type="text/css">
	.ad-span a{
        border: 1px solid;
        margin-top: -5px;
        float: right;
        color: #FFF!important;
    }
    .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td {
    	text-align: center;
    }
</style>

<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Opening Stock View'); ?> 
                <span class="ad-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-mail-reply"></span> Back'), array('action' => 'index'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?> 
                </span>
            </h3>
        </div>
        <div class="panel-body">  
            <div class="col-sm-8 col-sm-offset-2">
            	<table class="table table-bordered">
            		<tr>
            			<th><?php echo __('Stock Date'); ?></th>
            			<th><?php echo __('Product'); ?></th>
            			<th><?php echo __('Quantity'); ?></th>
            			<th><?php echo __('Price'); ?></th>
            			<th><?php echo __('Measure'); ?></th>
            			<th><?php echo __('Status'); ?></th> 
            		</tr>
            		<tr>
            			<td><?php echo h($stock['Stock']['ddate']); ?></td>
            			<td><?php echo $this->Html->link($stock['Product']['name'], array('controller' => 'products', 'action' => 'view', $stock['Product']['id'])); ?></td>
            			<td><?php echo h($stock['Stock']['quantity']); ?></td>
            			<td><?php echo h($stock['Stock']['price']); ?></td>
            			<td><?php echo $this->Html->link($stock['Measure']['name'], array('controller' => 'measures', 'action' => 'view', $stock['Measure']['id'])); ?></td>
            			<td><?php echo h($status[$stock['Stock']['status']]); ?></td>
            		</tr>
            	</table>
            </div>
        </div>
    </div>
</div>



