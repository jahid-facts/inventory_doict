<?php 
    echo $this->Html->script('jquery-ui');
	echo $this->Html->css('jquery-ui');
	
?>
<script>
$(function() {

	$("#FromMonth,#ToMonth").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
        changeYear: true,
        yearRange:"-100:+50"
	});


});
</script>

<style>
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
    .ad-span a{
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
    .td-pd-lf {
        padding-left: 0px!important;
    }
    .td-pd-rt {
        padding-right: 0px!important;
    }
</style>
<div class="purchases index">
    <div style="height:20px;"></div> 
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php echo __('Purchases Product List'); ?> 
                <span class="ad-span"><?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Purchase Product'), array('action' => 'add'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?></span>
            </h3> 
        </div>
        <div class="panel-body">
            <div class="col-sm-8 col-sm-offset-2"> 
                <table width="100%" cellpadding="0" cellspacing="0">
                    <?php echo $this->Form->create ( 'Report', array ('name' => 'form' ) ); ?>
                    <tr>
                        <td class="col-sm-3 col-xs-6 td-pd-lf">
                            <?php echo $this->Form->input ('invoice', array ('type'=>'text','class' => 'form-control','label'=>false,'placeholder'=>'Invoice No') );?>
                        </td>
                        <td class="col-sm-3 col-xs-6">
                            <?php echo $this->Form->input ( 'frommonth', array ('type'=>'text','id'=>'FromMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'From') ); ?> 
                        </td>
                        <td class="col-sm-3 col-xs-9">
                            <?php echo $this->Form->input ( 'tomonth', array ('type'=>'text','id'=>'ToMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'To') );?>
                        </td>
                        <td class="col-sm-1 col-xs-3 td-pd-rt">
                            <?php echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') ); ?>
                        </td> 
                    </tr>
                    <?php echo $this->Form->end (); ?> 
                </table>
                <br/>
                <?php echo $this->Session->flash(); ?>    
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla">
                        <tr>
                            <th><?php echo 'SL.'; ?></th>
                            <th><?php echo $this->Paginator->sort('Purchase Date'); ?></th>
                            <th><?php echo $this->Paginator->sort('Invoice Number'); ?></th>
                            <th><?php echo $this->Paginator->sort('supplier Name'); ?></th>  
                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>

                            <?php
                                $i=$this->Paginator->counter(array('format' => __('{:start}')));
                                foreach ($purchases as $purchase): 
                             ?>

                        <tr>
                            <td><?php echo $i; ?>&nbsp;</td>
                            <td><?php echo h($purchase['Purchase']['created']); ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($purchase['Purchase']['invoice'], array('controller' => 'purchases', 'action' => 'view', $purchase['Purchase']['id'],'v1')); ?>&nbsp;
                            </td>
                            <td>
                                <?php echo $purchase['Supplier']['name']; ?>
                            </td>  
                            <td class="actions" style="text-align: center;">
                         
                                <?php echo $this->Html->link(__('<i class="fa fa-eye" title="View Product"></i>'), array('action' => 'view', $purchase['Purchase']['id'],'v1'),array('escape' =>false)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil" title="Edit Product"></i>'), array('action' => 'edit', $purchase['Purchase']['id']),array('escape' =>false)); ?> 
                            </td>

                        </tr>
                        <?php $i++; endforeach; ?>
                    </table>
                </div>
                <div style="clear: both; height: 15px;">
                <div class="col-sm-12" style="text-align: center;">
                    <p>
                        <?php
                        echo $this->Paginator->counter(array(
                        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                        ));
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
</div>

 





