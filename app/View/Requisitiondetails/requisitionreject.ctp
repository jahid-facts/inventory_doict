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
        text-align: center;
    }
</style>
<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Requisitions Rejected'); ?> </h3>
        </div>
        <div class="panel-body">
            <?php
                    echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
            ?>
            <table width="70%" cellpadding="0" cellspacing="0" style="margin: 0 auto">
                    <tr>
                        <?php if($currentUser['role_id'] ==1 || $currentUser['role_id'] ==4  ){?>
                            <td class="col-md-3">
                                <?php echo $this->Form->input('user_id',array('type'=>'select','options'=>$users,'class'=>'form-control','label'=>false,'required'=>false,'empty'=>'Select Name'));?>

                            </td>
                        <?php }?>
                            <td class="col-md-3"><?php
                            echo $this->Form->input ( 'frommonth', array ('type'=>'text','id'=>'FromMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'From') );
                            ?></td>
                            <td class="col-md-3"><?php
                            echo $this->Form->input ( 'tomonth', array ('type'=>'text','id'=>'ToMonth','class'=>'form-input-text form-control','label'=>false,'placeholder'=>'To') );
                            ?></td>
                            <td class="col-md-1"><?php
                            echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info', 'style'=>'font-family:inherit; font-weight:bold;') );
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
                        <th><?php echo 'SL.'; ?></th>
                        <th><?php echo 'Reject Date'; ?></th>
                        <th><?php echo 'Requisitioner Name'; ?></th>
                        <th><?php echo 'Requisition No.'; ?></th>
                        <th><?php echo 'Product & Quantity'; ?></th>
                        <th><?php echo 'Reason for Rejection';?></th>   
                    </tr>

                    <?php 
                        $i=$this->Paginator->counter(array('format' => __('{:start}')));
                        foreach ($requisitions as $requisition):
                    ?>
                    <tr>
                        <td><?php echo $i; ?>&nbsp;</td>

                        <td>
                            <?php echo $requisition['Requisitionname']['dateupdate']; ?>
                        </td>

                        <td> <?php echo $requisition['User']['name'];?></td>
                         <td>
                            <?php echo $requisition['Requisitionname']['requisitionno']; ?>

                        </td>


                        <td> <?php echo $requisition['Productname']['finalcode']." (".$requisition['Requisitiondetail']['quantity']." ".$measures[$requisition['Productname']['measure_id']].")"; ?></td>
                        <td><?php echo $requisition['Requisitiondetail']['purposeothers']; ?></td>

                    </tr>
                    <?php $i++;endforeach; ?>
                </table>
            </div><br><br>
        
                

            <div class="col-sm-12" style="text-align: center;">
                <p >
                <?php
                echo $this->Paginator->counter(array(
                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                ));
                ?>  </p>

                <ul class="pagination" >
                        <li><?php echo $this->Paginator->prev('' . __('Previous'), array(), null, array('class' => 'paginate_button previous btn btn-rnd'));?></li>
                        <li><?php echo $this->Paginator->numbers(array('separator' => ''));?></li>
                        <li><?php echo $this->Paginator->next(__('Next') . '', array(), null, array('class' => 'paginate_button next btn btn-rnd'));?></li>
                </ul>
            </div>

        </div>
    </div>
</div>
