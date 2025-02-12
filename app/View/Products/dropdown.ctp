<?php
	$bold_search_keyword = '<strong>'.$search_keyword.'</strong>';
	
	if(!empty($products)){
		
		
		   $i=0;
            foreach($products as $project) 
            {		
            	$i++;

                $pid="'".$project['Product']['finalcode']."'";
                echo '<div class="show" align="left" onclick="showTaxpayer('.$i.','.$nid.','.$pid.')"><span class="work_smart'.$nid.'">'.str_ireplace($search_keyword,$bold_search_keyword,$project['Product']['name']).'</span></div>'; 	
            }
            
            
        }else{
            echo '<div class="show" align="left" onclick="showTaxpayerout()">No matching records.</div>'; 	
        }
        
         
?>