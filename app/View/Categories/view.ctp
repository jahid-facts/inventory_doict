

<br><br>
<style>
	.my-heading{
		font-size:20px;
		text-align:center;
		font-weight:bold;
	}


	.my-space-1{
		height:15px;
	}

</style>

<div class="col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading my-heading">Category</div>
				<div class="panel-body">
					<div class="my-space-1"></div>

					<div class="row">
						<div class="col-sm-12">
							<table class="table table-bordered my-padding-0">

								<tr>
									<td>Sl :</td>
									<td>
										<?php echo h($category['Category']['sl']); ?>
									</td>
								</tr>
								<tr>
									<td class="col-lg-3 col-md-4 col-sm-5 col-xs-5">Name :</td>
									<td>
										<?php echo h($category['Category']['name']); ?>
									</td>
								</tr>
								<tr>
									<td>Parent Category :</td>
									<td>
										<?php echo $this->Html->link($category['ParentCategory']['name'], array('controller' => 'categories', 'action' => 'view', $category['ParentCategory']['id'])); ?>

									</td>
								</tr>

							</table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->
</div><!--/.main-->






























