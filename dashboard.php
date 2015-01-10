<?php

require 'api/check_session.php';

if($type == 'A' || $type == 'U'):
  require 'classes/Db.class.php';
  require 'config.php';

  $db = new Db();
  $category = $db->query(" SELECT * FROM category WHERE status = 'A' ORDER BY name ");
  $productID = $db->query(" SELECT productId, sku, title FROM product ORDER BY productId DESC", PDO::FETCH_NUM);
 ?>

    <!-- top navigation -->
    <?php include '_partials/header.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar col-sm-3 col-md-2 -->        
        <?php include '_partials/sidebar.php'; ?>

        <div class="col-sm-9 col-md-10 main">

          <h1 class="page-header">Dashboard</h1>
          <hr />
          <?php if(!GET_ACTION == 'addproduct' || GET_ACTION == 'search'): ?>
          <p><a href="<?=THIS_FILE?>?action=addproduct">Add New Product</a></p>
          <?php endif; ?>
          <div class="row">
            <?php if( GET_ACTION == 'addproduct' ): ?>
            <?php include '_partials/addproduct.php'; ?>
            <?php endif; ?>
            <?php if(GET_ACTION == '' || GET_ACTION == 'search' ): ?>
            <?php include '_partials/searchproduct.php'; ?>
            <?php endif; ?>
          </div>

          <?php
            if ( GET_ACTION == 'search' && isset($_POST['submit'])) {

              $productId  = $_POST['itemId'];
              $title      = $_POST['title'];
              $category   = $_POST['category'];
              $status     = $_POST['status'];

              $str = "1 = 1";
              $str = (empty($productId))    ? $str : $str." AND productId =".$productId;
              $str = (empty($title))        ? $str : $str." AND title LIKE '%".$title."%'";
              $str = ($category == "All")   ? $str : $str." AND catId = ".$category;
              $str = ($status == "All")     ? $str : $str." AND status = '".$status."'";

              $prod = $db->query(" SELECT * FROM product WHERE ".$str);

              if (empty($prod)){
                echo "<h3 class='text-danger'>No record found !</h3>";
              }else{ ;
            ?>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>SKU</th>
                  <th>Status</th>
                  <?php if( $type == 'A' ): ?>
                  <th>Action</th>
                  <?php endif ?>
                </tr>
              </thead>
              <tbody>              
                <?php
                  foreach($prod as $row):
                    $product_id = $row['productId'];
                    $title      = $row['title'];
                    $url        = $_SERVER['SERVER_HOST'].'/itemdetail.asp?pid='. $product_id;

                  if ($row['status'] == 'A') {
                    $status = 'Open';
                    $color  = 'green';
                  }else{
                    $status = 'Inactive';
                    $color  = 'red';
                  };
                ?>
                <tr>
                  <td><?=$product_id?></td>
                  <td><a href="<?=$url?>" target="_blank"><?=$title?></a></td>
                  <td><?=$row['sku']?></td>
                  <td style="color:<?=$color?>"><?=$status?></td>
                  <?php if( $type == 'A' ): ?>
                  <td><a href="<?=THIS_FILE?>?edit=1&amp;pid=<?=$product_id?>">Edit</a></td>
                  <?php endif ?>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>

              <?php
                }
                // End if empty($prod)
              };
              // End if submit
              ?>



          </div> <!-- end .table-responsive -->

        </div><!-- end column -->
      </div><!-- end row -->
    </div><!-- end container -->
  </body>
</html>
<?php
  else:
    $msg = "Ooops+,+You+have+not+access+for+".rtrim(basename($_SERVER['REQUEST_URI']), ".php");
    header("location:index.php?error=1&msg=$msg");
  endif;
?>