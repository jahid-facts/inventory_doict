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
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );
</script>
 
<table id="example" class="display thla" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th colspan="4">Product</th>
            <th colspan="2">Product Adjustment Quantity</th> 
            <?php if($currentUser['role_id'] !=3) {?>
            <th rowspan="2">Balance</th>
            <?php }else{?>
            <th rowspan="2">Stock</th>
            <?php }?>
        </tr>
        <tr>
            <th>Code</th>
            <th>Name</th> 
            <th>Stock In</th>
            <th>Stock Out</th>
            <th>Missing</th>
            <th>Damage</th>                        
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

            if ($currentUser['role_id']==5) {
                $distid= $getpassDis;
            }else{
                $distid = $currentUser['district_id'];
            }  
            
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
            AS dm ON pt.id = dm.product_id WHERE pt.id='".$pid."' GROUP BY pt.id ";
            
            $data = getQueryData($sql);
            $stockIn=($data['squantity']+$data['pquantity']+$data['rrquantity']);


           
            $stockOut=($data['dquantity']+$data['dmquantity']+$data['dsquantity']);
            $balance=$stockIn-$stockOut; 
        
        ?>
        
        <tr>
            <td><?php echo $pdcodes; ?>&nbsp;</td>
            <td>
                <?php  echo $description; ?>
            </td>  
            <td><?php echo $stockIn; ?>&nbsp;</td>
            <td><?php echo $stockOut; ?>&nbsp;</td> 
            <td><?php echo $data['dmquantity'];?></td>
            <td><?php echo $data['dsquantity'];?></td>
            <td><?php echo $balance.' '.$stock['Measure']['name']; ?>&nbsp;</td>
        </tr> 
    	<?php endforeach; ?>          
    <tbody>
</table>