<?php 
  //For Sortable
   // echo $this -> Html -> script(array('jquery-ui'));
?>

<script>
    $(document).ready(function(){
        $(function() {
            $( ".sortable" ).sortable();
        });
    });
</script>

<style> 

.sortable  li{
        margin: 0px 0px 6px 20px;
        cursor: pointer;
        font-size:14px;

        background: #ffffff !important;
        border: 0 none !important;
        margin: 0 !important;
}
.sortable  ul{
    

        background: #ffffff !important;
      
}


</style>


<div class="categories index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"> Product Tree Diagram </h3>
        </div>
        <div class="panel-body">
    
            </br>
            </br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php if(!empty($menuSortable)):?>
                        <div>
                            <?php echo $this->Tree->menuSortable($menuSortable, 0, 'sortable','dsfd');?>
                        </div>
                    <?php endif;?>
                </div>
                <div class="col-md-2"></div>
            </div><br><br>
        </div>
    </div>
</div>


   





































