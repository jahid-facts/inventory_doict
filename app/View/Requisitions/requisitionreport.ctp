<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>
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
<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Requisitions'); ?> </h3>
        </div>
        <div class="panel-body">
            <?php
                    echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
            ?>
            <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>

                            <td class="col-md-3"></td>
                            <td class="col-md-2">
                                <?php echo $this->Form->input ('status', array ('type'=>'select','options'=>$status_rquisition,'class' => 'form-control','label'=>false,'empty'=>'choose status') );?>
                            </td>
                            <td class="col-md-3"><?php
                            echo $this->Form->input ( 'frommonth', array ('type'=>'text','id'=>'FromMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'From') );
                            ?></td>
                            <td class="col-md-3"><?php
                            echo $this->Form->input ( 'tomonth', array ('type'=>'text','id'=>'ToMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'To') );
                            ?></td>
                            <td class="col-md-1"><?php
                            echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') );
                            ?></td>

                    </tr>

            </table>
		<br />
                <?php
                echo $this->Form->end ();
                ?>
            <div class="table-responsive">
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                            <th><?php echo 'Sl.'; ?></th>
                            <th><?php echo $this->Paginator->sort('Requisition By'); ?></th>
                            <th><?php echo $this->Paginator->sort('Requisition No'); ?></th>
                            <th><?php echo $this->Paginator->sort('created'); ?></th>
                    </tr>
			
			<?php 
			$i=$this->Paginator->counter(array('format' => __('{:start}')));
			foreach ($requisitions as $requisition):
			//echo p($requisition);
			 ?>
                    <tr>
                        <td><?php echo $i; ?>&nbsp;</td>
                        <td>
                                <?php echo $this->Html->link($requisition['User']['name'], array('controller' => 'users', 'action' => 'view', $requisition['User']['id'])); ?>
                        </td>
                         <td>
                                <?php echo $this->Html->link($requisition['Requisition']['requisitionno'],array('controller'=>'requisitions','action'=>'view',$requisition['Requisition']['id'])); ?> 
                        </td> 
                        <td>
                                <?php echo h($requisition['Requisition']['created']); ?> 
                        </td>
                    </tr>
                        <?php $i++;endforeach; ?>
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
