<?php   
    echo $this->Html->css('print-style6');                                       
?> 

<style>
    .panel-title{
            font-family: inherit;
            font-size: 16px; 
            font-weight: bold;
        }
    .thla th {
        color: #173a18;
        text-align: left;
    }
    input[type="search"] {
        border:1px solid #8dc641;
    }
    
    .thla th:nth-child(1), .thla th:nth-child(2), .thla th:nth-child(3), .thla th:nth-child(4), .thla th:nth-child(5), .thla th:nth-child(6){
        border-right: 1px solid #a0a0a0;
        text-align: center;
    }
    .thla td:nth-child(1), .thla td:nth-child(2), .thla td:nth-child(3), .thla td:nth-child(4), .thla td:nth-child(5), .thla td:nth-child(6){
        border-right: 1px solid #a0a0a0;
    }
    table.dataTable thead th {
        border-bottom: 1px solid #a0a0a0!important;
    }
    #example {
        border: 1px solid #a0a0a0;
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
        color: #173a18;
        text-align: center;
        padding: 5px 10px;
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
    }
    .pr {
        padding-right: 0px;
      }
    .pl {
        padding-left: 0px;
    }
    .br-rdr {
        border-top-right-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .br-btn {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
        border: 1px solid #ccc;
        line-height: 20px;
    }
</style>

<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> <?php echo __('Products Re-order List'); ?> </h3>
        </div>
        <div class="panel-body">           
            <?php echo $this->Form->create ('Report', array ('name' => 'form') ); ?>
            <div class="col-sm-6 col-sm-offset-3">
                <!-- <div class="col-sm-11 col-xs-10 pr">
                    <select name="data[Report][id]" class="form-control br-rdr" id="PurchasedetailVRProductId">
                        <option value="">-- Select for search --</option> 
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
                </div>
                <div class="col-sm-1 col-xs-2 pl">
                    <?php echo $this->Form->button('<i class="fa fa-search"></i>', array ('type' => 'submit', 'label' => false, 'div' => false, 'class'=>'btn btn-info br-btn') ); ?>
                </div> -->
                <?php echo $this->Form->end (); ?>
            </div>
            <div style="clear: both; height: 15px;"></div> 
            
            <div class="thla"> 
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#example').DataTable( {
                            "pagingType": "full_numbers"
                        } );
                    } );
                </script> 
        		<div id="printid">
                    <table border="1" id="example" class="display" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th colspan="3" style="padding: 0px!important;">
                                    <div class="my-heading">
                                        <div class="col-sm-4 log-h">
                                            <img src="<?php echo $this->webroot;?>img/logo/doict_logo.png">
                                            <span class="one">
                                                <div class="c-height"></div>
                                                তথ্য ও যোগাযোগ প্রযুক্তি অধিদপ্তর
                                            </span>
                                            <br>
                                            <span class="two">Department OF ICT</span>
                                        </div> 
                                        <div class="col-sm-4 log-h1">
                                            <div class="c-height"></div>
                                            <h2>Products Re-order List</h2>
                                        </div> 
                                        <div class="col-sm-4 log-h2">
                                            <span>
                                                <div class="c-height"></div>
                                                
                                            </span><br>
                                            <span><b>Date : </b><?php echo date("d-m-Y"); ?></span>
                                        </div>             
                                        <div style="clear: both;"></div>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>  
                                <th>Stock</th>                      
                            </tr>
                        </thead>

            			<tbody>

                			<?php

                    			$i=0;

                    			foreach ($stockprodcucts as $stock): 
                    			$i++;
                    			//echo p($stock);
                    			$pid=$stock['Product']['id'];
                    			$description=/*$stock['Category']['name'].'->'.*/$stock['SubCategory']['name'].' - '.$stock['Product']['name'];
                                $pdcodes=$stock['Category']['cCode'].$stock['SubCategory']['sCode'].$stock['Product']['productcode'];
                    			
                    		    if(!empty($stock['Brand']['name'])){
                    		    	$description.=' - '.'<span title="Model" style="cursor:pointer">'.$stock['Brand']['name'].'</span>';
                    		    }
                                if(!empty($stock['Size']['name'])){
                                    $description.=' - '.'<span title="Size" style="cursor:pointer">'.$stock['Size']['name'].'</span>';
                                }
                    			if(!empty($stock['Color']['name'])){
                    		    	$description.=' - '.'<span title="Color" style="cursor:pointer">'.$stock['Color']['name'].'</span>';
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
                                    FROM damages WHERE damages.type=1 AND district_id=$distid GROUP BY damages.product_id 
                                )
                                AS ds ON pt.id = ds.product_id LEFT JOIN
                                ( 
                                    SELECT damages.product_id,SUM(damages.quantity) AS dmquantity 
                                    FROM damages WHERE damages.type=2 AND district_id=$distid GROUP BY damages.product_id 
                                )
                                AS dm ON pt.id = dm.product_id 
            					WHERE pt.id='".$pid."'
            					GROUP BY pt.id 
            					";
            					
            					$data = getQueryData($sql);
            					$stockIn=($data['squantity']+$data['pquantity']+$data['rrquantity']);


                               
            					$stockOut=($data['dquantity']+$data['dmquantity']+$data['dsquantity']);
            					$balance=$stockIn-$stockOut; 

                                if($balance<=$stock['Product']['limitation']){
                			
                			?>
        			
        			
        					
                            <tr>
                                <td><?php echo $pdcodes; ?>&nbsp;</td>
                                <td>
                                    <?php  echo $description; ?>
                                </td> 
                        
                                <td style="color: #c12e2e!important; font-weight: bold;"><?php echo $balance.' '.$stock['Measure']['name']; ?>&nbsp;</td>
                            </tr>

                        <?php } endforeach; ?>          
                        <tbody>
        		    </table>
                    <div class="ipsita">
                        <small>কারিগরি সহায়তায়ঃ&nbsp;<a href="http://ipsitasoft.com"> ইপসি্‌তা কম্পিউটার্স প্রাঃ লিঃ</a></small>
                    </div>
                </div>
    		</div>
    		<div class="othetcat"></div> 

            <?php foreach ($categories as $category):  $imgId=$category['Category']['id']; ?>

                <div id=$imgId class="tabcontent">
                    <h3>Developed By</h3>
                    <p>Ipsita Computers Pvt. Ltd.</p>
                </div>
                              
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="col-xs-12 text-center">
    <button href="#" class="btn btn-info" onclick="PrintDoc()"><span class="fa fa-print"></span> Print</button> 
</div>
<div style="clear: both; height: 20px;"></div>

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


document.getElementById("defaultOpen").click();
</script>
<!--Tab Link End-->


<script type="text/javascript">
    function PrintDoc() {
    
        var toPrint = document.getElementById('printid');
    
        var popupWin = window.open('', '_blank', '');
    
        popupWin.document.open();
    
        popupWin.document.write('<html><title>Re-order<?php echo date("YmdHis"); ?></title><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/print-style6.css" /><link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>css/bootstrap.min.css" /><link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet"></head><body onload="window.print()">');
    
        popupWin.document.write(toPrint.innerHTML);
    
        popupWin.document.write('</html>');
    
        popupWin.document.close();
    
    }
</script>