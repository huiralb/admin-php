<?php 
  /*
  // this section is extend from dashboard.php
  // this section is on if $_GET['action'] == 'search'
  */

 ?>
<div class="col-sm-6">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Search Item</h3>
    </div>
    <div class="panel-body">
      <form action="<?=THIS_FILE?>?action=search" class="form-horizontal" method="POST" role="form">
        <div class="form-group">
          <label class="col-md-2" for="">Category</label>
          <div class="col-md-8">
            <select name="category" class="form-control input-sm">
              <option value="All" selected>--All--</option>
              <?php foreach($category as $row): ?>
                <option value="<?=$row['catId']?>" <?php if($_POST['category'] == $row['catId']) echo "selected" ?>><?=$row['name']?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2" for="">Status</label>
          <div class="col-md-8">
            <select name="status" class="form-control input-sm">
              <option value="A"   <?php if ($_POST['status'] == "A")    echo "selected";?>>Active</option>
              <option value="All" <?php if ($_POST['status'] == "All")  echo "selected";?>>--All--</option>
              <option value="I"   <?php if ($_POST['status'] == "I")    echo "selected";?>>Inactive</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2" control-label for="">Item ID</label>
          <div class="col-md-8">
            <input name="itemId" type="text" class="form-control input-sm" list="productID" placeholder="Input field">
          </div>
          <datalist id="productID" style="overflow-y:scroll">
            <?php foreach($productID as $id): ?>
            <option  value="<?=$id['productId']?>" /><?=$id['title']?>
            <?php endforeach; ?>
          </datalist>
        </div>

        <div class="form-group">
          <label class="col-md-2" control-label for="">Title</label>
          <div class="col-md-8">
            <input name="title" type="text" class="form-control input-sm" list="productTitle" placeholder="Input field">
          </div>
          <datalist id="productTitle">
            <?php foreach($productID as $id): ?>
            <option  value="<?=$id['title']?>" /><?=$id['productId']?>
            <?php endforeach; ?>
          </datalist>
        </div>

        <div class="form-group">
          <label class="col-md-2" control-label for="">SKU</label>
          <div class="col-md-8">
            <input name="sku" type="text" class="form-control input-sm" list="productSKU" placeholder="Input field">
          </div>
          <datalist id="productSKU">
          </datalist>
        </div>

        <div class="form-group">    
          <div class="col-md-8 col-md-offset-2">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>