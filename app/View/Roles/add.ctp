<style>
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
    .thla th {
            color: #0088cc;
            text-align: left;
        }
    .add-span a {
        float: right;
    } 
    .mgb {
        margin-bottom: 5px;
        border-bottom: 1px solid #337AB7!important;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    .bgst {
        background-color: #eee!important;
        min-height: 50px;
    }
    .checkbox {
        margin: 5px 0px;
    }
    .checkbox input[type="checkbox"] {
        margin-left: 0px;
    }
    .cl2 {
        padding: 0px 5px;
        min-height: 72px;
    }
</style>

<script>

function _sel(id, area) {
    if ($(id).html() === 'Check All') {
        $('#' + area).find('input[type="checkbox"]').prop('checked', true);
        $(id).html('Uncheck All');
    } else {
        $('#' + area).find('input[type="checkbox"]').removeAttr('checked');
        $(id).html('Check All');
    }
}
</script>
<div class="role_ids form">
    <div style="clear: both; height: 20px;"></div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h1 class="panel-title" > 
                <?php echo __('Add Authorized Role'); ?>
                <span class="add-span">
                    <?php echo $this->Html->link(__('<span class="fa fa-mail-reply-all"></span> Back'), array('action' => 'index'),array('class'=>'btn btn-default btn-rounded btn-condensed btn-sm','escape'=>false)); ?>
                </span>
            </h1>               
        </div>
        <div class="panel-body">  
            <?php echo $this->Form->create('Role'); ?>
            <div class="col-sm-6">
                <?php echo $this->Form->input('title',array('type'=>'text','class'=>'form-control','label'=>'Title'));?>
            </div>
            <div class="col-sm-6">
                <?php echo $this->Form->input('description',array('type'=>'text','class'=>'col-sm-6 form-control','label'=>'Description')); ?>
            </div>
            <div style="clear: both;"></div>
                <?php   
                    echo '<div class="show-grid">';
                    foreach ($menudata as $key => $value) {
                        echo '<div class="col-sm-12 mgb" id="' . $key . '"><strong>' . str_replace('Controller', ' Management', $key) . '</strong>&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="_sel(this, \'' . $key . '\')"><b>Check All <i class="fa fa-hand-o-up" aria-hidden="true"></i></b></a><br />';
                        foreach ($value as $k => $val) {
                            echo '<div class="col-sm-2 cl2">';
                            echo $this->Form->input("Role.roles.$key.$val", array('type' => 'checkbox', 'value' => $val));
                            echo '</div>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';

                    echo '<div class="col-sm-12 bgst mgb">';
    		          echo $this->Form->input('status');
                    echo '</div>';
	            ?>
            <div style="clear: both; height: 10px;"></div>
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-default" style="background-color:#428BCA;color:white;">Submit</button> 
           </div>
           <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>