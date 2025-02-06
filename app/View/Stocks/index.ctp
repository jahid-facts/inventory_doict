
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
           text-align: center!important;
       }
    .ad-spand a{
        border: 1px solid;
        margin-top: -5px;
        float: right;
        color: #FFF!important;
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

<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Opening Stock List'); ?> 
                <span class="ad-spand"><?php if($currentUser['role_id'] ==1 || $currentUser['role_id'] ==4) {?>
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Opening Stock'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                    <?php }?> 
                </span>
            </h3>
        </div>
        <div class="panel-body">  
            <div class="col-sm-8 col-sm-offset-2"> 
                <?php echo $this->Session->flash(); ?>
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                        <tr>
                            <th><?php echo "Stock Date"; ?></th>
                            <th ><?php echo "Code"; ?></th>
                            <th><?php echo $this->Paginator->sort('product_id','Product Detail'); ?></th>
                            <th><?php echo $this->Paginator->sort('quantity'); ?></th>
                            <?php if($currentUser['role_id'] !=3) {?>
                            <th style="text-align: center;">Action</th>
                            <?php }?>
                        </tr>
                        <?php
                            $i=0;
                            foreach ($stocks as $stock): 
                            //echo p($stock);
                            $description=null; 

                            if(!empty($stock['Brand']['name'])){
                                $description.=' - '.$stock['Brand']['name'];
                            }
                            if(!empty($stock['Size']['name'])){
                                $description.=' - '.$stock['Size']['name'];
                            }
                            if(!empty($stock['Color']['name'])){
                                $description.=' - '.$stock['Color']['name'];
                            } 
                            $i++;

                            ?>  
                        <tr>
                            <td><?php echo h($stock['Stock']['ddate']); ?></td>
                            <td><?php echo $stock['Category']['cCode'].$stock['SubCategory']['sCode'].$stock['Product']['productcode']; ?>
                            </td>
                            <td>
                                <?php echo $this->Html->link($stock['SubCategory']['name'].' - '.$stock['Product']['name'].$description, array('controller' => 'products', 'action' => 'view', $stock['Product']['id'])); ?>
                            </td>
                            <td> <?php echo h($stock[0]['sqty']).' '.$stock['Measure']['name']; ?> </td>

                            <?php if($currentUser['role_id'] ==1 || $currentUser['role_id'] ==4 ){?>
                            <td class="actions" style="text-align: center;">
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $stock['Stock']['id']),array('escape' =>false)); ?>&nbsp;&nbsp;&nbsp;
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $stock['Stock']['id']),array('escape' =>false)); ?>
                            </td>
                            <?php }?>
                            <?php if($currentUser['role_id'] ==2 ){?>
                            <td class="actions" style="text-align: center;">
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'view', $stock['Stock']['id']),array('escape' =>false)); ?>
                            </td>
                            <?php }?>
                        </tr>
                        <?php endforeach; ?>
                    </table> 
                </div>
                <div style="clear: both; height: 15px"></div>
                <div class="col-sm-12" style="text-align: center;">
                    <p> <?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}') )); ?></p> 
                    <ul class="pagination">
                            <li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous btn btn-rnd'));?></li>
                            <li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
                            <li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next btn btn-rnd'));?></li>
                    </ul>
                </div>
                     
            </div> 
        </div>
    </div>
</div>
