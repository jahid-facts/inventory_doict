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


<div class="departments index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Department List'); ?> 
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Department'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>
            </h3>
        </div>
        <div class="panel-body"> 
            <div class="col-sm-6 col-sm-offset-3">
                <?php echo $this->Session->flash(); ?>
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                        <th><?php echo $this->Paginator->sort('id','SL'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('status'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>

                    <?php
               		 $i=1;
                     foreach ($departments as $department): 
                     ?>

                    <tr>
                        <td><?php echo $i; ?>&nbsp;</td>
                        <td><?php echo h($department['Department']['name']); ?>&nbsp;</td>
                        <td><?php echo h($status[$department['Department']['status']]); ?>&nbsp;</td>
                        <td class="actions" style="text-align: center;"> 
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $department['Department']['id']),array('escape' =>false)); ?> 
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


