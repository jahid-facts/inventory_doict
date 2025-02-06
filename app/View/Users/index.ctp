<style>
    .usernotactive a {
        background-color: #35aa47!important;
        color: #000!important;
    }
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
       text-align: center!important;
    }
    .thla td { 
       text-align: center!important;
       vertical-align: middle!important;
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

<?php if($currentUser['role_id'] ==1 || $currentUser['role_id']==4) {?>
<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php if ($status=='1') {
                        echo __('Active Users');
                    }else{
                        echo __('Inactive Users');
                    }
                ?> 
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add User'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>
            </h3>
        </div>
        <div class="panel-body"> 
            <?php echo $this->Session->flash(); ?>     
            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover bc thla" id="dataTables-example">
                    <tr>
<!--                        <th><?php echo $this->Paginator->sort('id','SL'); ?></th>-->
                        
                        <th>SL.</th>                        
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('User Name'); ?></th>
                         <th><?php echo $this->Paginator->sort('photo'); ?></th>
                        <th><?php echo $this->Paginator->sort('department'); ?></th>
                        <th><?php echo $this->Paginator->sort('designation'); ?></th>
                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                        <th><?php echo $this->Paginator->sort('mobile'); ?></th>
                        <th><?php echo $this->Paginator->sort('role_id'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>

                        <?php
                            $i=$this->Paginator->counter(array('format' => __('{:start}')));
                            foreach ($users as $user): 
                        ?>
                    <tr>
                        <td><?php echo $i; ?>&nbsp;</td>
                        <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                        <td><?php 
                            $imgId=$user['User']['id'];

                        $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';


                        if(file_exists($check)){?>
                            <img width="50" height="50" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                        <?php }else{?>
                            <img style="margin: 0px 10px;" width="50" height="50" src="<?php echo $this->webroot?>images/dummy.jpg"/>
                        <?php }?>
                             </td>
                        <td><?php echo h($user['Department']['name']); ?>&nbsp;</td>
                        <td><?php echo h($user['Designation']['name']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                        <td><?php echo h($user['User']['mobile']); ?>&nbsp;</td>
                        <td><?php echo $role_id[$user['User']['role_id']]; ?>&nbsp;</td>

                        <td class="actions" style="text-align: center;">
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil" title="Edit user"></i>'), array('action' => 'edit', $user['User']['id']),array('escape' =>false)); ?>&nbsp;&nbsp;&nbsp;
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open" title="View user"></i>'), array('action' => 'view', $user['User']['id']),array('escape' =>false)); ?><br>
                            <?php if($currentUser['role_id'] == 4){?>
                                <?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash" title="Delete user"></i>'), array('action' => 'delete', $user['User']['id']), array('escape' =>false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php $i++; endforeach; ?>
                </table>
            </div>
            <div style="clear: both;height: 15px;"></div>
            <div class="col-sm-12" style="text-align: center;"> 
                <p>
                    <?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?>	
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
        
 <?php }?>

