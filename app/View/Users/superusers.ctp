<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot;?>css/jquery.dataTables.min.css">
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
                <?php
                    if ($idname==division) {
                        echo "<a href='".$this->webroot."users/centraldashboard'>Division</a> / ".$users[0]['Division']['name']; 
                    }else { ?>
                        Super Admin List 
                        <span class="add-span">
                            <?php echo $this->Html->link(__('<span class="fa fa-plus"></span> Add Super Admin'), array('action' => 'superadd'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                        </span>
                <?php } ?>
                
            </h3>
        </div>
        <div class="panel-body"> 
            <?php echo $this->Session->flash(); ?>   
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
                                <th><?php echo $this->Paginator->sort('District'); ?></th>                   
                                <th><?php echo $this->Paginator->sort('Full Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('User Name'); ?></th>
                                 <th><?php echo $this->Paginator->sort('photo'); ?></th>
                                <th><?php echo $this->Paginator->sort('department'); ?></th> 
                                <th><?php echo $this->Paginator->sort('email'); ?></th>
                                <th><?php echo $this->Paginator->sort('mobile'); ?></th> 
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): 
                                    if ($user['User']['district_id']==100) { 
                                        //echo "Doict"; 
                                }else{?>
                                <tr> 
                                    <td><?php echo $districts[$user['User']['district_id']]; ?>&nbsp;</td>
                                    <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
                                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                                    <td>
                                        <?php 
                                        $imgId=$user['User']['id'];
                                        $check = WWW_ROOT."img/upload/user/" . $imgId.'.png';
                                        if(file_exists($check)){?>
                                            <img width="50" height="50" src="<?php echo $this->webroot?>img/upload/user/<?php echo $imgId;?>.png"/>
                                        <?php }else{?>
                                            <img style="margin: 0px 10px;" width="50" height="50" src="<?php echo $this->webroot?>images/dummy.jpg"/>
                                        <?php }?>
                                    </td>
                                    <td><?php echo h($user['Department']['name']); ?>&nbsp;</td> 
                                    <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                                    <td><?php echo h($user['User']['mobile']); ?>&nbsp;</td> 
                                    <td class="actions" style="text-align: center;">
                                        <?php
                                            if ($idname==division) { 

                                            }else {
                                                echo $this->Html->link(__('<i class="glyphicon glyphicon-pencil" title="Edit user"></i>'), array('action' => 'superedit', $user['User']['id']),array('escape' =>false)).'&nbsp;&nbsp;&nbsp;';
                                            } ?> 

                                        <?php if ($this->params['pass'][0]=='division') { 
                                            echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open" title="View user"></i>'), array('controller'=>'requisitions','action' => 'particularuser',$user['User']['id'],$user['User']['district_id']),array('escape' =>false)); 
                                            }else{
                                                echo $this->Html->link(__('<i class="glyphicon glyphicon-eye-open" title="View user"></i>'), array('action' => 'view', $user['User']['id']),array('escape' =>false)); 
                                            } 
                                        ?>
                                        <?php if($currentUser['role_id'] == 4){?>
                                            <?php echo $this->Form->postLink(__('<i class="glyphicon glyphicon-trash" title="Delete user"></i>'), array('action' => 'delete', $user['User']['id']), array('escape' =>false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } endforeach;?>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
            <div style="clear: both;height: 15px;"></div> 
        </div>
    </div>
</div>     
 <?php }?>

