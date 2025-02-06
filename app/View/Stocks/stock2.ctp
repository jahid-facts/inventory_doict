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
    
    
    ul.tab {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #DFF0D8;
    }

    /* Float the list items side by side */
    ul.tab li {float: left;}

    /* Style the links inside the list items */
    ul.tab li a {
        display: inline-block;
        color: #3c763d;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        transition: 0.3s;
        font-size: 14px;
        font-weight: bold;
    }

    /* Change background color of links on hover */
    ul.tab li a:hover {
        background-color: #8dc641;
        color: #fff;
    }

    /* Create an active/current tablink class */
    ul.tab li a:focus, .active {
        background-color: #8dc641;
        color:#fff;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #8dc641;
        background: #DFF0D8;
    }
</style>
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


<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-success">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Product Stock'); ?> </h3>
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
            
            
            
            <ul class="tab">
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'AllProducts')" id="defaultOpen">All Products</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Stationary')">Stationary</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Furniture')">Furniture</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'ComputerGoods')">Computer Goods</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Software')">Software</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Cookeries')">Cookeries</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Beverage')">Beverage</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Machinary')">Machinary</a></li>
                <li><a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Electrical')">Electrical</a></li>
            </ul>
            
            
        <div id="AllProducts" class="tabcontent">    
            <div class="table-responsive">
  
		<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover thla" id="dataTables-example">
                    <tr>
                        <th>SL.No.</th>
                        <th> Product</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                         <th>Balance</th>
                    </tr>
                    
			
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
			
					$sql  = "SELECT pt.id,s.squantity, d.dquantity, p.pquantity FROM products 
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
					AS d ON pt.id = d.product_id 
					WHERE pt.id='".$pid."'
					GROUP BY pt.id 
					";
					
					$data = getQueryData($sql);
					$stockIn=$data['squantity']+$data['pquantity'];
					$stockOut=$data['dquantity'];
					$balance=$stockIn-$stockOut;
	
			
			
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

endforeach; 

?>
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

                  <div id="Stationary" class="tabcontent">
                    <h3>Stationary</h3>
                    <p>Paris is the capital of France.</p>
                  </div>

                  <div id="Furniture" class="tabcontent">
                    <h3>Furniture</h3>
                    <p>Tokyo is the capital of Japan.</p>
                  </div>
                <div id="ComputerGoods" class="tabcontent">
                    <h3>ComputerGoods</h3>
                    <p>Paris is the capital of France.</p>
                  </div>

                  <div id="Software" class="tabcontent">
                    <h3>Software</h3>
                    <p>Tokyo is the capital of Japan.</p>
                  </div>
                <div id="Cookeries" class="tabcontent">
                    <h3>Cookeries</h3>
                    <p>Paris is the capital of France.</p>
                  </div>

                  <div id="Beverage" class="tabcontent">
                    <h3>Beverage</h3>
                    <p>Tokyo is the capital of Japan.</p>
                  </div>
                <div id="Machinary" class="tabcontent">
                    <h3>Machinary</h3>
                    <p>Paris is the capital of France.</p>
                  </div>

                  <div id="Electrical" class="tabcontent">
                    <h3>Electrical</h3>
                    <p>Tokyo is the capital of Japan.</p>
                  </div>
                
                  
              
           
        </div>
    </div>
</div>


<!--Tab Link Start-->
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<!--Tab Link End-->