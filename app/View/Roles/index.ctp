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
    .glyphicon-trash {
        color: red!important;
    }
</style>

<div class="role_ids index">
    <div style="clear: both; height: 20px;"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title" > 
                <?php echo __('Authorized Role'); ?>
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add New'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>
            </h1>               
        </div>
        <div class="panel-body">
            <div class="col-sm-10 col-sm-offset-1 table-responsive">
                <?php echo $this->Session->flash(); ?>   
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th><?php echo "SL"; ?></th>
                            <th><?php echo $this->Paginator->sort('Title'); ?></th>
                            <th><?php echo $this->Paginator->sort('description'); ?></th>
                            <th><?php echo $this->Paginator->sort('status'); ?></th> 
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($role_ids as $role_id): ?>
                        <tr>
                            <td><?php echo h($role_id['Role']['serialby']); ?>&nbsp;</td>
                            <td><?php echo h($role_id['Role']['title']); ?>&nbsp;</td>
                            <td><?php echo h($role_id['Role']['description']); ?>&nbsp;</td>
                            <td><?php echo h($status[$role_id['Role']['status']]); ?>&nbsp;</td>
                            <td class="actions"> 
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil" title="Edit"></i>'), array('action' => 'edit', $role_id['Role']['id']), array('escape' => false)); ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php //echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash" title="Delete"></i>'), array('action' => 'delete', $role_id['Role']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $role_id['Role']['id']), 'escape' => false)); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>
