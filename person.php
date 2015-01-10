<?php 
require 'api/check_session.php';
if ( $type == "A" || $type == "P"):
?>
<!-- top navigation -->
<?php include '_partials/header.php'; ?>
<div class="container-fluid">
	<div class="row">
		<!-- Sidebar col-sm-3 col-md-2 -->        
    <?php include '_partials/sidebar.php'; ?>
    <div class="col-sm-9 col-md-10 main">
      <h1>Employees</h1>
      <p>( to be continue . . .)</p>
      <hr />
    </div>
	</div>
</div>

<?php
  else:
    $msg = "Ooops+,+You+have+not+access+for+".rtrim(basename($_SERVER['REQUEST_URI']), ".php");
    header("location:index.php?error=1&msg=$msg");
  endif;
?>