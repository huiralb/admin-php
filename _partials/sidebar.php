<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar sidebar-fixed">
		<?php switch ($type):
				case 'A':
		?>
		<li><a href="dashboard.php">Search Product</a></li>
		<li><a href="dashboard.php?action=addproduct">Add new Product</a></li>
		<li class="active"><a href="setting.php">Setting</a></li>
		<li><a href="person.php">Employees</a></li>
		<?php break; ?>

		<?php case 'U': ?>
		<li><a href="dashboard.php">Search Product</a></li>
		<li><a href="dashboard.php?action=addproduct">Add new Product</a></li>
		<?php break; ?>

		<?php case 'P': ?>
		<li><a href="person.php">Employees</a></li>
		<?php break; ?>

		<?php endswitch; ?>
	</ul>
</div>