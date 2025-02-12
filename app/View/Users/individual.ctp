<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/bydisdetail.css">
<script src="<?php echo $this->webroot;?>js/jquery.dataTables.min.js"></script>
<style>  
    input[type="search"] {
        border:1px solid #8dc641;
    } 
    .thla th {
        border-right: 1px solid #a0a0a0;
        text-align: center;
    }
    .thla td {
        border-right: 1px solid #a0a0a0;
    }
    .thla th:last-child {
        border-right: 0px solid #a0a0a0;
    }
    .thla td:last-child {
        border-right: 0px solid #a0a0a0;
    }
    table.dataTable thead th {
        border-bottom: 1px solid #a0a0a0!important;
    }
    #example {
        border: 1px solid #a0a0a0;
    }
    .btn.btn-rounded {
        background: #0a99d4 none repeat scroll 0 0;
        border-radius: 12px;
        border-width: 2px;
        color: #fff;
        font-weight: 600;
        padding: 2px 10px;
        float: right;
        margin-top: -5px;
    }
    .btn.btn-rnd {
        background: #0a99d4 none repeat scroll 0 0;
        color: #fff;
        font-weight: 600;
    }
    .btn.btn-rnd:hover,.btn.btn-rnd:focus{
        color: #0a99d4;
    }
    .panel-title{
        font-family: inherit;
        font-size: 16px; 
        font-weight: bold;
    } 
   .add-span a {
        float: right;
    }
    .message {
        margin: 5px 0px;
        background: #f2f3f7;
        padding: 4px;
        color: #2d6f2d;
        text-align: center;
        font-size: 20px;
    }
    .glyphicon-trash {
        color: red!important;
    } 
</style>

<?php if($currentUser['role_id']==5) {?>
<div class="user index">
    <div style="height:20px;"></div>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"> 
                <?php if (!empty($users[0]['Division']['name']) || !empty($users[0]['District']['name'])) {
                        echo "<a href='".$this->webroot."users/centraldashboard'>".$users[0]['Division']['namebn']."</a> / ".$users[0]['District']['namebn'];
                    }else{
                        echo "<a href='".$this->webroot."users/centraldashboard'>DoICT (Central)</a>";
                    }

                ?> 
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-reply"></span> Back'), array('controller'=>'users','action' => 'centraldashboard'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>  
            </h3>
        </div>
        <div class="panel-body"> 
            <?php echo $this->Session->flash(); ?>   
            <div class="row">        
                <div class="col-md-3">  
                        <div class="my_block my_color_03 fl">
                            <img src="<?php echo $this->webroot; ?>img/my_icons/stock.png" width="30px" />
                            <div style="clear: both;height: 5px;"></div>
                            <p class="my_badges btn btn-default"><a href="<?php echo $this->webroot;?>stocks/stock/<?php echo $idpass;?>">পণ্যদ্রব্যের স্টক </a></p>
                            <hr style="margin: 5px 0px;" >
                            <p class="my_badges btn btn-default"><a href="<?php echo $this->webroot;?>stocks/stockreport/<?php echo $idpass;?>">তারিখ অনুসারে পণ্যদ্রব্যের স্টক </a></p>
                        </div>
                    </a>
                    <div style="clear: both;height: 5px;"></div> 
                    <div class="my_block my_color_01 fl" > 
                        <p class="my_link_01">মোট প্রাপ্ত  চাহিদা </p>
                        <p class="my_badges btn btn-default"> <?php echo $totalreqcount;?> </p>
                    </div> 
                    <div style="clear: both;height: 5px;"></div> 
                    <div class="my_block my_color_04 fl"> 
                        <p class="my_link_01"> অনুমোদনের জন্য অপেক্ষমান চাহিদা</p>
                        <p class="my_badges btn btn-default"> <?php echo $pendingcountss;?> <?php //echo ($totalreqcount-$approvedcount);?> </p>
                    </div> 
                    <div style="clear: both;height: 5px;"></div> 
                    <div class="my_block my_color_02"> 
                        <p class="my_link_01">মোট অনুমোদিত চাহিদা</p>
                        <p class="my_badges btn btn-default"> <?php echo $approvedcount;?> </p>
                    </div> 
                    <div style="clear: both;height: 5px;"></div> 
                    <div class="my_block my_color_07"> 
                        <p class="my_link_01"> মোট প্রত্যাখ্যাত পণ্যদ্রব্য </p>
                        <p class="my_badges btn btn-default"> <?php echo $rejectedecount;?> </p>
                    </div> 
                    <div style="clear: both;height: 5px;"></div>  
                    <div class="my_block my_color_05"> 
                        <p class="my_link_01"> মোট ডেলিভারি চাহিদা </p>
                        <p class="my_badges btn btn-default"><?php echo $deliveredecountss;?></p>
                    </div> 
                    <div style="clear: both;height: 5px;"></div> 
                    <div class="my_block my_color_09 fr"> 
                        <p class="my_link_01"> পণ্যদ্রব্য  রিটার্ন </p>
                        <p class="my_badges btn btn-default">  <?php echo $requisitionreturn;?> </p>
                    </div> 
                    <div style="clear: both;height: 5px;"></div> 
                    <div class="my_block my_color_10 fr"> 
                        <p class="my_link_01"> পণ্যদ্রব্যের সমন্বয় </p>
                        <p class="my_badges btn btn-default">  <?php echo $damage;?> </p>
                    </div> 
                    <div style="clear: both;height: 5px;"></div> 
                    <div class="my_block my_color_02"> 
                        <p class="my_link_01" > মোট সক্রিয় ব্যবহারকারী </p>
                        <p class="my_badges btn btn-default"> <?php echo $usercount;?> </p>
                    </div> 
                </div>
                <div class="col-md-9">
                    <div class="tabcontent">  
                        <div class="table-responsive">  
                            <div class="thla">  
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        $('#example').DataTable( {
                                            "pagingType": "full_numbers"
                                        } );
                                    } );
                                </script> 
                                <table id="example" class="display" cellspacing="0" width="100%">
                                    <thead>                     
                                        <th><?php echo 'Full Name '; ?></th> 
                                        <th><?php echo 'Photo '; ?></th>
                                        <th><?php echo 'Department '; ?></th> 
                                        <th><?php echo 'Email & Mobile '; ?></th> 
                                        <th class="actions"><?php echo __('Actions'); ?></th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user): ?>
                                        <tr>  
                                            <td><?php echo h($user['User']['name']); ?>&nbsp;</td> 
                                            <td>
                                                <?php 
                                                $imgId=$user['User']['id'];
                                                $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';
                                                if(file_exists($check)){?>
                                                    <img style="margin: 0px 10px;" width="50" height="50" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                                                <?php }else{?>
                                                    <img style="margin: 0px 10px;" width="50" height="50" src="<?php echo $this->webroot?>images/dummy.jpg"/>
                                                <?php }?>
                                            </td>
                                            <td><?php echo h($user['Department']['name']); ?>&nbsp;</td> 
                                            <td>    
                                                <span style="border-bottom:1px solid #CCC;"><?php echo h($user['User']['email']); ?></span>&nbsp;
                                                <div style="clear:both;"></div>
                                                <?php echo h($user['User']['mobile']); ?>
                                            </td> 
                                            <td class="actions" style="text-align: center;"> 
                                                <?php echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open" title="View user"></i>'), array('controller'=>'requisitions','action' => 'particularuser',$user['User']['id'],$user['User']['district_id']),array('escape' =>false)); ?> 
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
            <div style="clear: both;height: 15px;"></div> 
        </div>
    </div>
</div>     
 <?php }?>

