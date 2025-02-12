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
    .table-bordered {
        width: 100%!important;
    }
    .table-bordered > tbody > tr > th:nth-child(1){
        width: 15%!important;
    }
    .table-bordered > tbody > tr > th:nth-child(2){
        width: 25%!important;
    }
    .table-bordered > tbody > tr > th:nth-child(3){
        width: 35%!important;
    }
    .table-bordered > tbody > tr > th:nth-child(4){
        width: 15%!important;
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
                <?php echo __('Main Category List'); ?> 
                <span class="add-span">
                  <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Sub-Category'), array('action' => 'addsub'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
        
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Main Category'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false,'style'=>'margin-right: 15px;')); ?>
                </span>
            </h3>
            
        </div>
        <div class="panel-body"> 
    		<div class="row"> 
    			<div class="col-sm-6 col-sm-offset-3">
                    <?php echo $this->Session->flash(); ?>
				    <div class="table-responsivec">
                        <table cellpadding="0" cellspacing="0" class="table table-bordered" id="dataTables-example">
                                <tr>
                                    <th>SL.</th>
                                    <th><?php echo $this->Paginator->sort('Category Code'); ?></th>
                                    <th><?php echo $this->Paginator->sort('Category Name'); ?></th>
                                    <th class="actions" style="text-align: center;"><?php echo __('Actions'); ?></th>
                                </tr>

                                <?php
                                $i=1;
                                 foreach ($categories as $category): 
                                 ?>

                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo h($category['Category']['cCode']); ?>&nbsp;</td>
                                    <td><?php echo h($category['Category']['name']); ?>&nbsp;</td>
                                    <!-- <td><?php echo h($parentCategories[$category['Category']['parent_id']]); ?>&nbsp;</td> -->
                                    <td class="actions" style="text-align: center;">
                                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil" title="Edit Category"></i>'), array('action' => 'edit', $category['Category']['id']),array('style'=>'margin-right: 10px;','escape' =>false)); ?>
                                    </td>

                                </tr>
                                <?php $i++; endforeach; ?>
                        </table>
                    </div>
    			</div> 
    		</div><br><br>
        
            <p>
                <?php
                echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                ));
                ?>	
            </p>

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




































