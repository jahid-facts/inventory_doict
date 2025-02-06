<style>
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
<link rel="stylesheet" href="<?php echo $this->webroot;?>css/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

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


<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Stocks'); ?> </h3>
        </div>
        <div class="panel-body">           
                <?php
                        echo $this->Form->create ('Report', array ('name' => 'form') );
                ?>
                <table  class="table table-bordered table-striped table-hover table-responsive" cellpadding="0" cellspacing="0">
                        <tr>						

                            <td>
  						<select name="data[Report][id]" class="form-control" id="PurchasedetailVRProductId">
							<option value="">Select</option>
							
							<?php foreach ($stockprodcucts as $product){
								
							$description=$product['Category']['name'].'->'.$product['SubCategory']['name'].'->'.$product['Product']['name'];
						    if(!empty($product['Brand']['name'])){
						    	$description.='->'.$product['Brand']['name'];
						    }
							if(!empty($product['Color']['name'])){
						    	$description.='->'.$product['Color']['name'];
						    }
						    if(!empty($stock['Size']['name'])){
						    	$description.='->'.$product['Size']['name'];
						    }
							
							?>
							<option value="<?php echo $product['Product']['id'];?>"><?php echo $description;?></option>
							<?php }?>
							
							
						</select>

                                                </td>

                                                <td>
                                                      <?php
                            echo $this->Form->input ( 'Search', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info') );
                            ?>
                                                </td>
                        </tr>
                </table>
                <?php
                        echo $this->Form->end ();
                ?>
            
            <div class="table-responsive">

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable( {
                "pagingType": "full_numbers"
            } );
        } );
        </script> 

        <table id="example" class="display" cellspacing="0" width="100%">
		<!-- <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example"> -->
          <thead>
                    <tr>
                        <th>SL.No.</th>
                        <th> Product</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                         <th>Balance</th>
                    </tr>
          </thead>
          
          <tbody>
			
			<?php

			$i=0;

			foreach ($stockprodcucts as $stock): 
			$i++;
			//echo p($stock);
			$pid=$stock['Product']['id'];
			$description=$stock['Category']['name'].'->'.$stock['SubCategory']['name'].'->'.$stock['Product']['name'];
			
		    if(!empty($stock['Brand']['name'])){
		    	$description.='->'.$stock['Brand']['name'];
		    }
			if(!empty($stock['Color']['name'])){
		    	$description.='->'.$stock['Color']['name'];
		    }
		    if(!empty($stock['Size']['name'])){
		    	$description.='->'.$stock['Size']['name'];
		    }
		
			$cdate=date('Y-m-d');
			
			$pdate=date('Y-m-d', strtotime('-1 days'));
			$distid = $currentUser['district_id'];
			    $sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity,rr.rrquantity,ds.dsquantity,dm.dmquantity FROM products 
                          AS pt LEFT JOIN
                          ( 
                            SELECT stocks.product_id,SUM(stocks.quantity) AS squantity 
                            FROM stocks WHERE district_id=$distid GROUP BY stocks.product_id 
                          ) 
                          AS s ON pt.id = s.product_id LEFT JOIN 
                          ( 
                            SELECT purchasedetails.product_id,SUM(purchasedetails.quantity) AS pquantity 
                            FROM purchasedetails WHERE district_id=$distid GROUP BY purchasedetails.product_id 
                          )
                           AS p ON pt.id = p.product_id LEFT JOIN 
                          ( 
                            SELECT deliverydetails.product_id,SUM(deliverydetails.quantity) AS dquantity 
                            FROM deliverydetails WHERE district_id=$distid GROUP BY deliverydetails.product_id 
                          )
                          AS d ON pt.id = d.product_id LEFT JOIN
                                    ( 
                                        SELECT requisitionreturns.product_id,SUM(requisitionreturns.quantity) AS rrquantity 
                                        FROM requisitionreturns WHERE district_id=$distid GROUP BY requisitionreturns.product_id 
                                    )
                                    AS rr ON pt.id = rr.product_id LEFT JOIN
                                    ( 
                                        SELECT damages.product_id,SUM(damages.quantity) AS dsquantity 
                                        FROM damages WHERE damages.type=1 AND damages.district_id=$distid  GROUP BY damages.product_id 
                                    )
                                    AS ds ON pt.id = ds.product_id LEFT JOIN
                                    ( 
                                        SELECT damages.product_id,SUM(damages.quantity) AS dmquantity 
                                        FROM damages WHERE damages.type=2 AND damages.district_id=$distid GROUP BY damages.product_id 
                                    )
                                    AS dm ON pt.id = dm.product_id WHERE pt.id='".$pid."' GROUP BY pt.id ";
					
					$data = getQueryData($sql);
					$stockIn=$data['squantity']+$data['pquantity'];
                                  
					$stockOut=$data['dquantity'];
					$balance=$stockIn-$stockOut;
	
			if($balance<=10){
			
			?>
			
			
					
                    <tr>
                        <td><?php echo h($i); ?>&nbsp;</td>
                        <td>
                                <?php 
                                echo $description;
                                
                                //echo $this->Html->link($stock['Category']['name'].'->'.$stock['Product']['name'].$description, array('controller' => 'products', 'action' => 'view', $stock['Product']['id'])); ?>
                        </td>
                        <td><?php echo $stockIn; ?>&nbsp;</td>
                        <td><?php echo $stockOut; ?>&nbsp;</td>
                        <td><?php echo $balance.' '.$stock['Measure']['name']; ?>&nbsp;</td>
                    </tr>
<?php 
                        }
endforeach; 

?>    
      </tbody>
		</table>
<?php 

if($stockprodcuctps){
	
	 $prev_p_name = "";
   	 $i = 1;
   	 
   	 $s=0;
		foreach($stockprodcuctps as $key => $stocks)
    {
$s++;
   			 $description=$stocks['Category']['name'].'->'.$stocks['SubCategory']['name'].'->'.$stocks['Product']['name'];
			
		    if(!empty($stocks['Brand']['name'])){
		    	$description.='->'.$stocks['Brand']['name'];
		    }
			if(!empty($stocks['Color']['name'])){
		    	$description.='->'.$stocks['Color']['name'];
		    }
		    if(!empty($stocks['Size']['name'])){
		    	$description.='->'.$stocks['Size']['name'];
		    }

    	$value=$stocks['Stockacrchive']['sdate'];
    	
    	$stockIn=$stocks['Stockacrchive']['stockIn'];
		$stockOut=$stocks['Stockacrchive']['stockOut'];
		$balance=$stocks['Stockacrchive']['balance'];
		
    	if($value != $prev_p_name)
    	{
			if($i > 0)
			{
				echo ("</table>");
			}
			echo("<br><h4 style='text-align: center;'>$value</h4>");
			$prev_p_name = $value;
?>
   <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <tr>
                        <th>SL.No.</th>
                        <th> Product</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                         <th>Balance</th>
                    </tr>
                    
<?php
    	}

	$i += 1;
?>
       <tr>
                        <td><?php echo h($s); ?>&nbsp;</td>
                        <td>
                                <?php 
                                echo $description;
                                
                                //echo $this->Html->link($stock['Category']['name'].'->'.$stock['Product']['name'].$description, array('controller' => 'products', 'action' => 'view', $stock['Product']['id'])); ?>
                        </td>
                        <td><?php echo $stockIn; ?>&nbsp;</td>
                        <td><?php echo $stockOut; ?>&nbsp;</td>
                        <td><?php echo $balance.' '.$stocks['Measure']['name']; ?>&nbsp;</td>
                    </tr>
<?php
	}
}

?>
  </table>
            </div>
           
        </div>
    </div>
</div>

