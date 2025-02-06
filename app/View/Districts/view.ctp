<div class="districts view">
<h2><?php echo __('District'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($district['District']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Division'); ?></dt>
		<dd>
			<?php echo $this->Html->link($district['Division']['name'], array('controller' => 'divisions', 'action' => 'view', $district['Division']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($district['District']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Namebn'); ?></dt>
		<dd>
			<?php echo h($district['District']['namebn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($district['District']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit District'), array('action' => 'edit', $district['District']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete District'), array('action' => 'delete', $district['District']['id']), array(), __('Are you sure you want to delete # %s?', $district['District']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Districts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New District'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Divisions'), array('controller' => 'divisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Division'), array('controller' => 'divisions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teachers'), array('controller' => 'teachers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teacher'), array('controller' => 'teachers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Thanas'), array('controller' => 'thanas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Thana'), array('controller' => 'thanas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Teachers'); ?></h3>
	<?php if (!empty($district['Teacher'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Thana Id'); ?></th>
		<th><?php echo __('District Id'); ?></th>
		<th><?php echo __('TeacherID'); ?></th>
		<th><?php echo __('Tifserial'); ?></th>
		<th><?php echo __('Teacherindex'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('First Namebn'); ?></th>
		<th><?php echo __('Last Namebn'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('Father Name'); ?></th>
		<th><?php echo __('Mother Name'); ?></th>
		<th><?php echo __('Dob'); ?></th>
		<th><?php echo __('Paddress'); ?></th>
		<th><?php echo __('Parmaddress'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Updated'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Htel'); ?></th>
		<th><?php echo __('Designation'); ?></th>
		<th><?php echo __('Designationbn'); ?></th>
		<th><?php echo __('Joindate'); ?></th>
		<th><?php echo __('Subteacher'); ?></th>
		<th><?php echo __('Age'); ?></th>
		<th><?php echo __('Blood'); ?></th>
		<th><?php echo __('Groups'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Class'); ?></th>
		<th><?php echo __('Nid'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Cell'); ?></th>
		<th><?php echo __('Maritalstatus'); ?></th>
		<th><?php echo __('HaswaifeName'); ?></th>
		<th><?php echo __('HaswaifeNamebn'); ?></th>
		<th><?php echo __('Huswifedesignation'); ?></th>
		<th><?php echo __('Huswifedesignationbn'); ?></th>
		<th><?php echo __('SpouseCell'); ?></th>
		<th><?php echo __('ContactPerson'); ?></th>
		<th><?php echo __('ContactPersonbn'); ?></th>
		<th><?php echo __('Dutybn'); ?></th>
		<th><?php echo __('Parmaddressbn'); ?></th>
		<th><?php echo __('Paddressbn'); ?></th>
		<th><?php echo __('Mother Namebn'); ?></th>
		<th><?php echo __('Father Namebn'); ?></th>
		<th><?php echo __('Examinerinfo'); ?></th>
		<th><?php echo __('Examinerinfobn'); ?></th>
		<th><?php echo __('Relationwithcontact'); ?></th>
		<th><?php echo __('Relationwithcontactbn'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($district['Teacher'] as $teacher): ?>
		<tr>
			<td><?php echo $teacher['id']; ?></td>
			<td><?php echo $teacher['thana_id']; ?></td>
			<td><?php echo $teacher['district_id']; ?></td>
			<td><?php echo $teacher['teacherID']; ?></td>
			<td><?php echo $teacher['tifserial']; ?></td>
			<td><?php echo $teacher['teacherindex']; ?></td>
			<td><?php echo $teacher['first_name']; ?></td>
			<td><?php echo $teacher['last_name']; ?></td>
			<td><?php echo $teacher['first_namebn']; ?></td>
			<td><?php echo $teacher['last_namebn']; ?></td>
			<td><?php echo $teacher['gender']; ?></td>
			<td><?php echo $teacher['father_name']; ?></td>
			<td><?php echo $teacher['mother_name']; ?></td>
			<td><?php echo $teacher['dob']; ?></td>
			<td><?php echo $teacher['paddress']; ?></td>
			<td><?php echo $teacher['parmaddress']; ?></td>
			<td><?php echo $teacher['created']; ?></td>
			<td><?php echo $teacher['updated']; ?></td>
			<td><?php echo $teacher['status']; ?></td>
			<td><?php echo $teacher['htel']; ?></td>
			<td><?php echo $teacher['designation']; ?></td>
			<td><?php echo $teacher['designationbn']; ?></td>
			<td><?php echo $teacher['joindate']; ?></td>
			<td><?php echo $teacher['subteacher']; ?></td>
			<td><?php echo $teacher['age']; ?></td>
			<td><?php echo $teacher['blood']; ?></td>
			<td><?php echo $teacher['groups']; ?></td>
			<td><?php echo $teacher['subject']; ?></td>
			<td><?php echo $teacher['class']; ?></td>
			<td><?php echo $teacher['nid']; ?></td>
			<td><?php echo $teacher['email']; ?></td>
			<td><?php echo $teacher['cell']; ?></td>
			<td><?php echo $teacher['maritalstatus']; ?></td>
			<td><?php echo $teacher['haswaifeName']; ?></td>
			<td><?php echo $teacher['haswaifeNamebn']; ?></td>
			<td><?php echo $teacher['huswifedesignation']; ?></td>
			<td><?php echo $teacher['huswifedesignationbn']; ?></td>
			<td><?php echo $teacher['spouseCell']; ?></td>
			<td><?php echo $teacher['contactPerson']; ?></td>
			<td><?php echo $teacher['contactPersonbn']; ?></td>
			<td><?php echo $teacher['dutybn']; ?></td>
			<td><?php echo $teacher['parmaddressbn']; ?></td>
			<td><?php echo $teacher['paddressbn']; ?></td>
			<td><?php echo $teacher['mother_namebn']; ?></td>
			<td><?php echo $teacher['father_namebn']; ?></td>
			<td><?php echo $teacher['examinerinfo']; ?></td>
			<td><?php echo $teacher['examinerinfobn']; ?></td>
			<td><?php echo $teacher['relationwithcontact']; ?></td>
			<td><?php echo $teacher['relationwithcontactbn']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'teachers', 'action' => 'view', $teacher['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'teachers', 'action' => 'edit', $teacher['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'teachers', 'action' => 'delete', $teacher['id']), array(), __('Are you sure you want to delete # %s?', $teacher['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Teacher'), array('controller' => 'teachers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Thanas'); ?></h3>
	<?php if (!empty($district['Thana'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Division Id'); ?></th>
		<th><?php echo __('District Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Namebn'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($district['Thana'] as $thana): ?>
		<tr>
			<td><?php echo $thana['id']; ?></td>
			<td><?php echo $thana['division_id']; ?></td>
			<td><?php echo $thana['district_id']; ?></td>
			<td><?php echo $thana['name']; ?></td>
			<td><?php echo $thana['namebn']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'thanas', 'action' => 'view', $thana['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'thanas', 'action' => 'edit', $thana['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'thanas', 'action' => 'delete', $thana['id']), array(), __('Are you sure you want to delete # %s?', $thana['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Thana'), array('controller' => 'thanas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
