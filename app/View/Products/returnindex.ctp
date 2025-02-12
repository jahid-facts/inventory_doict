<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>

<style>
    .btn.btn-rounded { 
        border-radius: 12px;
        border: 1px solid #FFF;
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
    .btn.btn-rounded:hover,.btn.btn-rounded:focus{
    	border-color: #ADADAD!important; 
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
    .pd-l-o {
    	padding-left: 0px!important;
    }
</style> 
<script type="text/javascript">
  $(function() {

    $( "#datepicker").datepicker(
      {
          dateFormat:'dd-mm-yy',
          changeMonth:true,
          changeYear:true,
          yearRange:"-10:+5",

      }
    );
  });
 </script>
<div class="products index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Product Return List'); ?> 
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Product Return Form'), array('action' => 'proreturn'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>
            </h3>
        </div>
        <div class="panel-body"> 
            <div class="col-sm-8 col-sm-offset-2 table-responsive">
                <?php echo $this->Session->flash(); ?>
                <div class="col-sm-12 pd-l-o">
                	<div class="col-sm-11 pd-l-o">
                		<div class="col-sm-4 pd-l-o">
		                	<?php echo $this->Form->input ('reqName', array ('class' => 'form-control','label' => false,'required'=>false,'placeholder'=>'Returned By' ) );?> 
		                </div>
		                <div class="col-sm-4 pd-l-o">
		                	<?php echo $this->Form->input ('retrnNo', array ('class' => 'form-control', 'label' => false,'required'=>false,'placeholder'=>'Returned No.' ) );?> 
		                </div>
		                <div class="col-sm-4 pd-l-o">
		                	<?php echo $this->Form->input ('retrnDate', array ('class' => 'form-control','id'=>'datepicker', 'label' => false,'required'=>false,'placeholder'=>'Returned Date' ) );?> 
		                </div>
                	</div>
                	<div class="col-sm-1 pd-l-o">
	                	<?php echo $this->Form->button('<i class="fa fa-search"></i>', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info br-btn') ); ?>
	                </div>  
                </div> 
                
                <div style="clear: both; height: 15px;"></div>
        		<table cellpadding="0" cellspacing="0" class="table table-bordered" id="dataTables-example">
        			<tr> 
            			<th><?php echo $this->Paginator->sort('SL'); ?></th>
            		    <th><?php echo $this->Paginator->sort('Returned By'); ?></th> 
            			<th style="color: #337ab7;">Returned To</th>
            			<th><?php echo $this->Paginator->sort('Returned No.'); ?></th>
            			<th><?php echo $this->Paginator->sort('Returned Date'); ?></th>
            			<th class="actions" style="color: #337ab7;"><?php echo __('Actions'); ?></th>
            	   </tr>
        			
        			<?php $i=$this->Paginator->counter(array('format' => __('{:start}'))); ?>
                                
                	<tr>
                        
                        <td> <?php echo $i;?></td>
                		<td style="text-transform: capitalize;">
                             
                        </td>  
                		<td> </td>
                		<td> </td>
                		<td> </td>
                        <td class="actions" style="text-align: center;"> 
                            <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open"></i>'), array('action' => 'edit'),array('escape' =>false)); ?> 
                        </td>
                				
                    </tr>
                    <?php $i++;?>
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
 
  
