<?php
	$bold_search_keyword = '<strong>'.$search_keyword.'</strong>';
	
	if(!empty($deliveries)){
		
		
		   $i=0;
            foreach($deliveries as $delivery) 
            {		
            	$i++;
                echo '<div class="show" align="left" onclick="showTaxpayer('.$i.')"><span class="work_smart'.$i.'">'.str_ireplace($search_keyword,$bold_search_keyword,$delivery['Delivery']['user_id']).'</span></div>'; 	
            }
            
            
        }else{
            echo '<div class="show" align="left" onclick="showTaxpayerout()">No matching records.</div>'; 	
        }
        
         
?>