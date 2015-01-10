<div class="col-sm-6">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Add New Product</h3>
    </div>
    <div class="panel-body">
      <form action="<?=THIS_FILE?>?action=addproduct&amp;upload=true" method="POST" class="form-horizontal" role="form">

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Category:</label>
          <div class="col-sm-8">
            <select name="category" id="add-category" class="form-control input-sm" required="required">
              <option value="">-- Please select --</option>
              <?php foreach($category as $item):    ?>
              <option <?php if( GET_ID == $item['catId'] ) echo "selected" ?> value="<?=$item['catId']?>"><?=$item['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <script>
          $(document).ready(function(){
            $('#add-category').change(function(){
              //console.log($(this).val());
              window.location.replace("dashboard.php?action=addproduct&id="+ $(this).val());
            });
          });
        </script>

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Sub category:</label>
          <div class="col-sm-8">
            <select name="subcategory"  class="form-control input-sm" required="required">
              <?php
                $catid = GET_ID;
                if ($catid == null) {
                  $catid = 0;
                };
                $db->bind('catid', $catid);
                $subcategory = $db->query(" SELECT subcatid, name FROM subcategory WHERE catid = :catid AND status = 'A' ORDER BY name ");
               ?>
              <option value="">-- No Sub Category --</option>
              <?php foreach ($subcategory as $item): ?>
              <option value="<?=$item['subcatid']?>"><?=$item['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Title:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="title" class="form-control input-sm" id="" placeholder="Input Title" required="required"/>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Product Code:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="code" class="form-control input-sm" id="" placeholder="Input Product Code" />
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">SKU:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="sku" class="form-control input-sm" id="" placeholder="Input SKU" />
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Description:</label>
          </div>
          <div class="col-sm-8">
            <textarea name="description" class="form-control input-sm" id="" placeholder="Input description" rows="5"  required="required"></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Dimension:</label>
          </div>
          <div class="col-sm-8">
            <textarea name="dimension" class="form-control input-sm" id="" placeholder="Input dimension" rows="3"></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Also Like:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="alsolike" class="form-control input-sm" id="" placeholder="Input Also like" />
            <p class="help-block"><em>(Please separated by " , ")</em></p>
          </div>
        </div>



        <div class="form-group">
          <div class="col-sm-8 col-sm-offset-4">
            <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
            <button type="reset" class="btn btn-info btn-sm">Reset</button>
            <a href="<?=THIS_FILE?>" type="button" class="btn btn-danger btn-sm">Cancel</a>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
<?php
// process upload product
if ($_GET['upload'] == true) {
  if (isset($_POST['submit'])) {
    // $category     = $_POST['category'];
    // $subcategory  = $_POST['subcategory'];
    // $title        = $_POST['title'];
    // $code         = $_POST['code'];
    // $sku          = $_POST['sku'];
    // $description  = $_POST['description'];
    // $dimension    = $_POST['dimension'];
    // $also         = $_POST['alsolike'];

    $db->bind( 'category'      , $_POST['category'] );
    $db->bind( 'subcategory'   , $_POST['subcategory'] );
    $db->bind( 'title'         , $_POST['title'] );
    $db->bind( 'code'          , $_POST['code'] );
    $db->bind( 'sku'           , $_POST['sku'] );
    $db->bind( 'description'   , $_POST['description'] );
    $db->bind( 'dimension'     , $_POST['dimension'] );
    $db->bind( 'also'          , $_POST['alsolike'] );

    $upload_prod = $db->query(" INSERT INTO product(title,description,dimension,alsolike,sku,code,catid,subcatid) VALUES (:title,:description,:dimension,:also,:sku,:code,:category,:subcategory) ");
    
    if ($upload_prod > 0) {
      $prod = $db->query(" SELECT * FROM product ORDER BY productId desc LIMIT 1; ");
      echo "<h3 class='text-success'>Upload, success !</h3>";
      echo "<pre>";
      print_r($prod);
      echo "</pre>";
    }else{
      echo "<p text-danger'>Failed upload to database</p>";
    }
  }
}
 ?>
