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

<?php
    $pdname=$pscode=array();
    foreach($categories as $category){
        $pdname[$category['Category']['id']]=$category['Category']['name'];
        $pscode[$category['Category']['id']]=$category['Category']['sCode'];
    }
?>

<div class="products index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Products Detail List'); ?> 
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Product Detail'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>
            </h3>
        </div>
        <div class="panel-body"> 
            <div class="col-sm-10 col-sm-offset-1 table-responsive">
                <?php echo $this->Session->flash(); ?>  
        		<table cellpadding="0" cellspacing="0" class="table table-bordered" id="dataTables-example">
        			<tr>
            			<!-- <th><?php echo $this->Paginator->sort('id','S/N'); ?></th> -->
            			<th><?php echo $this->Paginator->sort('Code'); ?></th>
            		    <th><?php echo $this->Paginator->sort('Product Detail'); ?></th> 
            			<!-- <th><?php //echo $this->Paginator->sort('price'); ?></th> -->
            			<th style="color: #337ab7;">Re-order Warning Qty.</th>
            			<th><?php echo $this->Paginator->sort('description'); ?></th>
            			<th><?php echo $this->Paginator->sort('status'); ?></th>
            			<th class="actions" style="color: #337ab7;"><?php echo __('Actions'); ?></th>
            	   </tr>
        			
        			<?php
        		    $i=$this->Paginator->counter(array('format' => __('{:start}')));
        			 foreach ($products as $product): 
        			 ?>
                                
                	<tr> 
                        <td>
                			<?php echo $product['Category']['cCode'].$pscode[$product['Product']['pcid']].$product['Product']['productcode'];?>
                		</td>
                		<td style="text-transform: capitalize;">
                            <?php 
                                echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id']));
                                echo "<b> - </b>";
                                echo $pdname[$product['Product']['pcid']];
                                echo "<b> - </b>";
                                echo $product['Product']['name'];
                            ?> 
                            <?php
                                if(!empty($product['Brand']['name'])){
                                   echo '-'.$product['Brand']['name'];
                                }
                                if(!empty($product['Size']['name'])){
                                   echo '-'.$product['Size']['name'];
                                }
                                if(!empty($product['Color']['name'])){
                                   echo '-'.$product['Color']['name'];
                                } 
                            ?> 
                        </td> 
                		<!-- <td><?php //echo h($product['Product']['price']); ?>&nbsp;</td> -->
                		<td><?php echo h($product['Product']['limitation']); ?>&nbsp;</td>
                		<td><?php echo h($product['Product']['description']); ?>&nbsp;</td>
                		<td><?php echo h($status[$product['Product']['status']]); ?>&nbsp;</td>
                        <td class="actions" style="text-align: center;"> 
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil"></i>'), array('action' => 'edit', $product['Product']['id']),array('escape' =>false)); ?> 
                        </td>
                				
                    </tr>
                    <?php $i++; endforeach; ?>
        		</table>
            </div>
            <div style="clear: both; height: 10px;"> </div>
            <div class="col-sm-12" style="text-align: center;">
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
