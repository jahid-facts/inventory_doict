<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/dashbox.css"> 
<div class="clearfix" style="margin-top: 20px;">   
    <div class="col-md-12"> 
        <div class="row equal">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <div class="col-md-4">
                        <p class="my_badges1 col-sm-12" style="margin:0px;text-align:center;"><a href="#"><?php echo "Total  Division: 8";?></a></p>
                    </div>
                    <div class="col-md-4">
                        <p class="my_badges1 col-sm-12" style="margin:0px;text-align:center;"><a href="#"><?php echo "Total District: 64";?></a></p>
                    </div>
                    <div class="col-md-4">
                        <p class="my_badges1 col-sm-12" style="margin:0px;text-align:center;"><a href="#"><?php echo "Total Active User: ".count($users);?></p>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
            <div style="clear:both;height:2px;"></div>
        </div>
		<div class="row equal">  
            <div class="col-md-4">
                <div class="panel panel-primary column">
                    <div class="panel-heading" id="iduser"> 
                        <h3 class="panel-title"><a href="<?php echo $this->webroot?>users/individual/district/100"><?php echo "DoICT (Central)";?></a></h3>
                    </div>
                    <div class="panel-body"> 
                        <div class="preBlockdiv">
                            <img src="<?php echo $this->webroot; ?>img/my_icons/storekeeper.png" width="50px" /> <br>
                            <p class="my_badges1"><a href="<?php echo $this->webroot?>users/individual/district/100"><?php echo "DoICT Activity";?></a></p>
                            <!-- <p class="my_badges2"> <?php //echo "Total - Division: 8 || District: 64";?> </p> -->  
                            <p class="my_badges"><a href="#"><?php echo "Total Active Users: ".$centrall;?></a></p>
                        </div>
                    </div>
                </div> 
            </div>

            <?php foreach ($divisions as $division): ?>      
			<div class="col-md-4">
                <div class="panel panel-primary column">
                    <div class="panel-heading" id="id<?php echo $division['Division']['id'];?>">
                        <h3 class="panel-title"> 
                            <?php 
                                $userDivcount=classRegistry::init('User')->find('count',array('conditions'=>array('User.division_id'=>$division['Division']['id'],'User.status'=>1)));
                                echo "<a href='".$this->webroot."users/superusers/division/".$division['Division']['id']."'>".$division['Division']['namebn']." - ".$userDivcount."</a>";  
                            ?> 
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="centrallUl">
                            <?php foreach ($division['District'] as $district): ?>
                                <li>
                                    <?php 
                                        $userDiscount=classRegistry::init('User')->find('count',array('conditions'=>array('User.district_id'=>$district['id'],'User.status'=>1)));
                                        echo "<a href='".$this->webroot."users/individual/district/".$district['id']."'>".$district['namebn']."<span> [ <b>".$userDiscount."</b> ]</span></a>"; 
                                    ?> 

                                </li>
                            <?php endforeach; ?>
                            <div style="clear:both"></div>
                        </ul>
                        <div style="clear:both"></div>
                    </div>
                </div> 
			</div> 
            <?php endforeach; ?> 
		</div> 
    </div> 
</div>
<div style="clear:both;height:50px;"></div>
<script type="text/javascript">
    var maxHeight = 0;
    $(".column").each(function(){
      maxHeight = $(this).height() > maxHeight ? $(this).height() : maxHeight;
    }).height(maxHeight);
</script>