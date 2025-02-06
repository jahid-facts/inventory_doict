<div class="content_area">

              <!-- FEATURED PRODUCTS -->
    <div class="shop-single">
              
    </div>&nbsp;&nbsp;&nbsp;&nbsp;  
  
        <?php //pr($order);?>
<style>
.order-title{
	font-size: 20px;
}
</style>
        

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
							<td align="center">৳ <?php echo $orderdetail['Product']['price']; ?></td>
							<td align="center"><?php echo $orderdetail['qty']; ?></td>
							<td align="center">৳ <?php echo $orderdetail['qty']*$orderdetail['Product']['price']; ?></td>
						</tr>
					<?php
					$amount=$amount+$orderdetail['qty']*$orderdetail['Product']['price'];
					endforeach; ?>
                  
                    	 <tr>
							<td colspan="3" align="right">Total</td>
							
							<td align="center"> <?php echo $amount; ?></td>
						</tr>
						
						 <tr>
							<td colspan="3" align="right">Shipping Charge</td>
							
							<td align="center">৳ <?php echo round(30,2); ?></td>
						</tr>
						 <tr>
							<td colspan="3" align="right">Grand Total Amount</td>
							
							<td align="center"> ৳<?php echo round($amount+30,2); ?></td>
						</tr>
					
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

        popupWin.document.write('<html><title>::Preview::</title><link rel="stylesheet" type="text/css" href="http://192.168.0.105:8080/grabit/css/admin/bootstrap.min.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot?>css/admin/member_viewprint.css" /></head><body onload="window.print()">');

        popupWin.document.write(toPrint.innerHTML);

        popupWin.document.write('</html>');

        popupWin.document.close();

    }
</script>
          
          </div><!-- /.row -->
        </section><!-- /.content -->

           

<script>

function confirmation(){
		 if(document.getElementById('contact-name').value == '')
      	{
      		alert('Please give name');
      		document.getElementById('contact-name').focus();
      	
      	}else if(document.getElementById('contact-mobile').value == '')
      	{
      		alert('Please give mobile');
      		document.getElementById('contact-mobile').focus();
      	
      	}else if(document.getElementById('contact-email').value == '')
      	{
      		alert('Please give email');
      		document.getElementById('contact-email').focus();
      	
      	}else if(document.getElementById('contact-message').value == '')
      	{
      		alert('Please give address');
      		document.getElementById('contact-message').focus();
      	
      	}else{
          	var cond = confirm("Are you sure want to order this items.");
          	if(cond == true){

          		$('#OrderOrdernowForm').submit();
          	     
          	}else{
          	}
	  }
}
</script>

 <script  type="text/javascript">

function calPro(b){
	var p_price = parseFloat(document.getElementById('p_price['+b+']').value);
	var p_unit = parseFloat(document.getElementById('p_amount['+b+']').value);
	document.getElementById('total_p_price['+b+']').value = (p_price * p_unit).toFixed(2);
	document.getElementById('gptotal_price').value = parseFloat(document.getElementById('gptotal_price').value)+(p_price * p_unit);

}




</script>
</div>
</div>
</div>


 
   
      
    
   
 
 

  