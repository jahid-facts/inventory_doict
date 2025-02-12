<?php //pr($order);?>
<style>
.order-title{
	font-size: 20px;
}
</style>
        <section class="content-header">
        	<ol class="breadcrumb">
            <li><?php echo $this->Html->link('Dashboard',array('controller'=>'users','action'=>'dashboard'));?></li>
            <li><a href="#">Orders</a></li>
            <li class="active">Orders List</li>
          </ol>
          <h1>
            <small></small>
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content" id="main-lay">
        
        
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
               
                <div class="box-body">
                  <div class="row">
                  
		         <div class="col-xs-12">
		            <div align="center" class="order-title">Orders Information</h3>
		            </div>
		         </div>
		         <div class="row">
		            <div class="col-md-12" align="center">
		            	<?php echo $order[0]['Order']['address']?>
		            </div>
		         </div>
		         <br/>
		         <div class="row">
		           <div class="col-md-2">
		            </div>
		            <div class="col-md-3">
		             <b>Name:</b> <?php echo $order[0]['Order']['name']?>
		            </div>
		            <div class="col-md-3">
		             <b>Mobile:</b> <?php echo $order[0]['Order']['mobile']?>
		            </div>
		            <div class="col-md-4">
		             <b>Email:</b> <?php echo $order[0]['Order']['email']?>
		            </div>
		           <p>&nbsp;</p>
		         </div>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                   <tr>
						<td align="center"><?php echo __('Item'); ?></td>
						<td align="center"><?php echo __('Price'); ?></td>
						<td align="center"><?php echo __('Qty'); ?></td>
						<td align="center"><?php echo __('Total'); ?></td>
					</tr>
                    </thead>
                    <tbody>
                    <?php 
                    $amount=0;
                    foreach ($order[0]['Orderdetail'] as $orderdetail): ?>
						<tr>
							<td align="center"><?php echo $orderdetail['Product']['name']; ?></td>
							<td align="center">&pound; <?php echo $orderdetail['Product']['price']; ?></td>
							<td align="center"><?php echo $orderdetail['qty']; ?></td>
							<td align="center">&pound; <?php echo $orderdetail['qty']*$orderdetail['Product']['price']; ?></td>
						</tr>
					<?php
					$amount=$amount+$orderdetail['qty']*$orderdetail['Product']['price'];
					endforeach; ?>
                  
                    	 <tr>
							<td colspan="3" align="right">Total</td>
							
							<td align="center">&pound; <?php echo $amount; ?></td>
						</tr>
						<?php if($order[0]['Order']['type']=="Collection"){
						$discount=0;
							if($amount>=15){
								$discount=$amount*15/100;
							}
							
							?>
						 <tr>
							<td colspan="3" align="right">Discount</td>
							
							<td align="center">&pound; <?php echo round($discount*15/100,2); ?></td>
						</tr>
						 <tr>
							<td colspan="3" align="right">Paid Amount</td>
							
							<td align="center">&pound; <?php echo round($amount-$discount,2); ?></td>
						</tr>
						<?php }?>
                    </tbody>
                   
                  </table>
                  
                
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              
            </div><!-- /.col -->
            <div align="center">
	<button class="btn btn-warning print" href="#" onclick="PrintDoc()" style="font-size:20px; margin-bottom: 10px;">Print Order</button>
</div>		
			
<script type="text/javascript">
    function PrintDoc() {

        var toPrint = document.getElementById('main-lay');

        var popupWin = window.open('', '_blank', '');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Preview::</title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot?>css/admin/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot?>css/admin/member_viewprint.css" /></head><body onload="window.print()">');

        popupWin.document.write(toPrint.innerHTML);

        popupWin.document.write('</html>');

        popupWin.document.close();

    }
</script>
          
          </div><!-- /.row -->
        </section><!-- /.content -->

