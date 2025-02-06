<style>
     .btn.btn-rounded {
        background: #0a99d4 none repeat scroll 0 0;
        border-radius: 12px;
        border-width: 2px;
        color: #fff;
        font-weight: 600;
        padding: 2px 10px;
        float: right;
        margin-bottom: 10px;
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
</style>

<div class="purchases index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Purchases List'); ?> </h3>
        </div>
        <div class="panel-body">
            <div class="row">
          <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Product'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
            </div>
   
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla">
            <tr>
                <th><?php echo 'Sl.'; ?></th>
                <th><?php echo $this->Paginator->sort('invoice no'); ?></th>
                <th><?php echo $this->Paginator->sort('supplier_id','Supplier Name'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
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
		<td>
		 <?php echo $this->Html->link($purchase['Purchase']['invoice'], array('controller' => 'purchases', 'action' => 'view', $purchase['Purchase']['id'])); ?>
		
		&nbsp;</td>
		<td>
                    <?php echo $this->Html->link($purchase['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchase['Supplier']['id'])); ?>
		</td>
		<td><?php echo h($purchase['Purchase']['created']); ?>&nbsp;</td>
		<td><?php echo h($purchase['Purchase']['modified']); ?>&nbsp;</td>
                <td class="actions" style="text-align: center;">
                                     
                    <?php echo $this->Html->link(__('<i class="fa fa-eye" title="View Product"></i>'), array('action' => 'view', $purchase['Purchase']['id']),array('escape' =>false)); ?>&nbsp;&nbsp;&nbsp;
                    
                    <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil" title="Edit Product"></i>'), array('action' => 'edit', $purchase['Purchase']['id']),array('escape' =>false)); ?>&nbsp;&nbsp;&nbsp;
                    <?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash" title="Delete Product"></i>'), array('action' => 'delete', $purchase['Purchase']['id']) ,array('escape' =>false),array(), __('Are you sure you want to delete # %s?', $purchase['Purchase']['id'])); ?>
                </td>

            </tr>
            <?php $i++; endforeach; ?>
        </table>
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

