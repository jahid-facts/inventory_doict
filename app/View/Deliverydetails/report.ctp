<script type="text/javascript">

var path='<?php echo $this->webroot;?>';

function getTaxpayerId(id){
  $.ajax({
    type: 'POST',
    url: path +'deliveries/dropdown',
    data: {t_id:id},
    success: function(data){
       $("#result").html(data).show();
            
    }
  });
}


function showTaxpayerout(){
  $("#result").fadeOut();
}
function showTaxpayer(v){
	  var $name = $('.work_smart'+v).html(); 
	  
	  var decoded = $("<div/>").html($name).text();
	  $('#TaxpayerHoldingNo').val(decoded);
	  $("#result").fadeOut();
	}

</script>
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">
<script src="<?php echo $this->webroot;?>js/jquery-1.10.2.js"></script>
<script src="<?php echo $this->webroot;?>js/jquery-ui.js"></script>

<script type="text/javascript">
  $(function() {

    $( "#datepicker").datepicker(
      {
          dateFormat:'yy-mm-dd',
          changeMonth:true,
          changeYear:true,
          yearRange:"-10:+5",

      }
    );
  });
 


 
  $(function() {

    $( "#datepicker1").datepicker(
      {
          dateFormat:'yy-mm-dd',
          changeMonth:true,
          changeYear:true,
          yearRange:"-10:+5",

      }
    );
  });
</script>
<div class="deliveries index">
    <h2><?php echo __('Deliveries'); ?></h2>
     <?php echo $this->Session->flash(); ?>
    <div style="margin-top:30px;">
	<?php
		echo $this->Form->create ( 'Report', array ('name' => 'form' ) );
	?>
	<table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
		<tr>						
							 
                    <td>
						
					<?php echo $this->Form->input('user_id',array('label'=>false,'type'=>'select','options'=>$users,'empty'=>'select'));?>
					<div id="result"></div>
					</td>
					<td>
						
							<?php echo $this->Form->input('product_id ',array('onclick'=>'showTaxpayerout(this.value)','onkeyup'=>'getTaxpayerId(this.value)','class'=>'search_keyword form-control','label'=>false,'required'=>false,'placeholder'=>'Product name','id'=>'TaxpayerHoldingNo','options'=>$products,'type'=>'select'));?>
							   
						
					</td>
					<td>
						
						<?php echo $this->Form->input ('frommonth', array ('class' => 'form-control','id'=>'datepicker', 'label' => false,'required'=>false,'placeholder'=>'From' ) );?> 
					    
					</td>
					<td>
					    
						<?php echo $this->Form->input ('tomonth', array ('class' => 'form-control','id'=>'datepicker1', 'label' => false,'required'=>false,'placeholder'=>'To' ) );?> 
					    
					</td>
					<td>
						<button type="submit" class="btn btn-default">Search</button>
					</td>
		</tr>
	</table>
	<?php
		echo $this->Form->end ();
	?>
</div>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('Requisitioner'); ?></th>
                <th><?php echo $this->Paginator->sort('Order No'); ?></th>
                <th><?php echo $this->Paginator->sort('Product Name'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                
            </tr>

                <?php
                    $i=$this->Paginator->counter(array('format' => __('{:start}')));
                    foreach ($deliveries as $delivery): 
                    	 /*echo "<pre>";
                    	 print_r($delivery);
                    	 echo "<pre>";*/
                 ?>

                <tr>
                    <td><?php echo h($delivery['Delivery']['id']); ?>&nbsp;</td>
                    <td>
                          <?php echo h($delivery['User']['name']); ?>
                    </td>
                     
                    <td><?php echo h($delivery['Delivery']['orderid']); ?>&nbsp;</td>
                    <td><?php echo h($delivery['Productname']['name']); ?>&nbsp;</td>
                    <td><?php echo h($delivery['Delivery']['created']); ?>&nbsp;</td>
                    

                </tr>
            <?php $i++; endforeach; ?>
        </table>
	</div>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>