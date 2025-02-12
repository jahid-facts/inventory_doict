
<div class="role_id view">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo __('Role Details'); ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <?php echo __('Role'); ?>                </div>
                <div class="panel-body"> 

                    	<div class='row-fluid'>
		<div class='span3'><?php echo __('Id'); ?></div>
		<div class='span9'>
			<?php echo h($role_id['Role']['id']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Title'); ?></div>
		<div class='span9'>
			<?php echo h($role_id['Role']['title']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Description'); ?></div>
		<div class='span9'>
			<?php echo h($role_id['Role']['description']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
                        <div class='span3'><?php echo __('Roles'); ?></div>
                        <div class='span9'>
                            <?php
                            //echo h($role_id['Role']['role_ids']);
                            $role_ids = json_decode($role_id['Role']['role_ids'], true);
                            foreach ($role_ids as $key => $value) {
                                echo "<div class='row show-grid'>
                                        <div class='col-md-12'><strong>" . str_replace("Controller", "", $key) . "</strong></div>";
                                foreach ($value as $k => $v) {
                                    if ($v != "0") {
                                        echo "<div class='col-md-2'>$v</div>";
                                    }
                                }
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Status'); ?></div>
		<div class='span9'>
			<?php echo h($role_id['Role']['status']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Created'); ?></div>
		<div class='span9'>
			<?php echo h($role_id['Role']['created']); ?>
			&nbsp;
		</div>
	</div>	<div class='row-fluid'>
		<div class='span3'><?php echo __('Modified'); ?></div>
		<div class='span9'>
			<?php echo h($role_id['Role']['modified']); ?>
			&nbsp;
		</div>
	</div>              </div>
            </div>
        </div>
    </div>
</div>

    <div class="related">
        <h3><?php echo __('Related Users'); ?></h3>
        <?php if (!empty($role_id['User'])): ?>
        <table class="table table-striped table-bordered table-hover">
            <tr>
                		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Employee Id'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
            </tr>
            	<?php foreach ($role_id['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['role_id_id']; ?></td>
			<td><?php echo $user['employee_id']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['status']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
		</tr>
	<?php endforeach; ?>
        </table>
        <?php endif; ?>

    </div>
