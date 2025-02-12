<?php
App::uses ( 'AppHelper', 'View/Helper' );

define('T', "\t");
define('NL', "\r\n");
class TreeHelper extends AppHelper {
	public $helpers = array('Html','Form');
    /*
     * sortable menu for adamin
     */
	public function menuSortable($threaded, $level = 0,$sortableClass , $enable_ordering = 1)
	    {
	        $html = '<ul class = "'.$sortableClass.'">';
	        foreach ($threaded as $key => $node){
	            $html .= '<li>'.'<input type="hidden" value="'.$node['Category']['id'].'" name="order[]">';
	       
	            foreach ($node as $type => $threaded)
	            {
	                if ($type !== 'children')
	                {   
                		$html .= $threaded['name'].'<ul>';
	                  	$html .= '</ul>';
	                }
	                else
	                {
	                    if (!empty($threaded))
	                    {
	                        $html .= $this->menuSortable($threaded, $level + 2,$sortableClass, $enable_ordering = 1);
	                    }   
	                }
	            }
	            $html .= '</li>';
	        }
	        $html .= '</ul>';
	        return $html;
	    }
}
?>