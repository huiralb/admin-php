<?php
  require 'api/check_session.php';

  if($type == "A"):
    
     // --------------------------------------------
    $THIS_FILE    = $_SERVER['PHP_SELF'];
    $action       = $_GET['action'];
    $id           = $_GET['id'];
    $website      = "@horestco.com";      

    require 'classes/Db.class.php';
    $db = new Db();
    $category = $db->query(" SELECT * FROM category WHERE status = 'A' ORDER BY name ");
    $users    = $db->query(" SELECT * FROM admin ");
    
    // add new user
    if ( $action == "adduser" && isset($_POST['submit']) && $_GET['submit'] ) {
      $username = $_POST['name'];
      $username.= "@horestco.com";
      $password = $_POST['password'];
      $type = $_POST['type'];
      $display_name  = $_POST['display'];
      if ($display_name == null) {
        $display_name = $_POST['name'];
      }
      $post_user = $db->query(" INSERT INTO admin(username, password, type, displayname) VALUES('".$username."', '".$password."', '".$type."', '".$display_name."') ");
      
        header("location:setting.php");
        echo "success";      
    }; 


    // delete user
    if ( $_GET['action'] == "delete" && !$_GET['id'] == null){

      $delete_user = $db->query(" DELETE FROM admin WHERE AdminId = ".$_GET['id']." ");
      header("location:".$THIS_FILE);

    }
 ?>

    <!-- top navigation -->
    <?php include '_partials/header.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar col-sm-3 col-md-2 -->        
        <?php include '_partials/sidebar.php'; ?>
        <div class="col-sm-9 col-md-10 main">
          <h1>Setting User Login</h1>
          <hr />
<!--
===============================================================
Add new user
===============================================================
-->
          <?php if($_GET['action'] == "adduser" ): ?>
          <div class="panel panel-primary" style="width:50%">
              <div class="panel-heading">
                <h3 class="panel-title">Add new user</h3>
              </div>
              <div class="panel-body">
                <form action="<?=$THIS_FILE?>?action=adduser&amp;id=<?=$id?>&amp;submit=true" method="POST" role="form">

                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="name" placeholder="username" required="required"/>
                      <div class="input-group-addon">@horestco.com</div>
                    </div>
                  </div>                  

                  <div class="form-group">
                    <input type="text" class="form-control" name="password" placeholder="password" required="required"/>
                  </div>

                  <div class="form-group">
                    <select name="type" class="form-control" required="required">
                      <option value="A">Admin</option>
                      <option value="P">Personalia</option>
                      <option value="U" selected>User</option>
                    </select>
                  </div>                   

                  <div class="form-group">
                    <input type="text" class="form-control" name="display" placeholder="Display name" />
                  </div>            
                
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <a href="<?=$THIS_FILE?>" name="cancel" class="btn btn-primary">Cancel</a>
                </form>
              </div>
          </div>

          <?php endif ?>
<!--
===============================================================
Edit user
===============================================================
-->
          <?php if($_GET['action'] == "edituser"):

          // get data admin
            $db->bind("id", $_GET['id']);
            $user_edit = $db->query(" SELECT * FROM admin WHERE AdminId = :id ");     

            foreach ($user_edit as $user) {
              $id         = $user['AdminId'];
              $username   = str_replace("@horestco.com", "", $user['username']);
              $password   = $user['password'];
              $type       = $user['type'];
              $display    = $user['displayname'];
            };

            // update user

            if ( isset($_POST['edit_submit']) ) {

              $display_name = $_POST['display'];
              if ($display_name == null) {
                $display_name = $_POST['name'];
              };

              $db->bindMore(array(
                  "id"        => $_POST['id'],
                  "username"  => $_POST['name']."@horestco.com",
                  "password"  => $_POST['password'],
                  "type"      => $_POST['type'],
                  "display"   => $display_name
                ));
              $db->query(" UPDATE admin SET username = :username, password = :password, type = :type, displayname = :display WHERE AdminId = :id ");
              header("location:setting.php");
            };
          ?>
          <div class="panel panel-primary" style="width:50%">
              <div class="panel-heading">
                <h3 class="panel-title">Edit user</h3>
              </div>
              <div class="panel-body">
                <form action="<?=$THIS_FILE?>?action=edituser&amp;submit=true" method="POST" role="form">
                  
                  <div class="form-group">
                    <input type="hidden" class="form-control" name="id" value="<?=$id?>"/>
                  </div>  

                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="name" placeholder="username" value="<?=$username?>"/>
                      <div class="input-group-addon">
                        <?=$website?>
                      </div>
                    </div>
                  </div>                  

                  <div class="form-group">
                    <input type="text" class="form-control" name="password" placeholder="password" value="<?=$password?>"/>
                  </div>

                  <div class="form-group">
                    <select name="type" class="form-control">
                      <?php if($type == "A"):?>
                        <option value="A" selected>Admin</option>
                        <option value="P">Personalia</option>
                        <option value="U">User</option>
                      <?php elseif($type == "P"): ?>                      
                        <option value="A">Admin</option>
                        <option value="P" selected>Personalia</option>
                        <option value="U">User</option>
                      <?php else: ?>
                        <option value="A">Admin</option>
                        <option value="P">Personalia</option>
                        <option value="U" selected>User</option>
                      <?php endif ?>
                    </select>
                  </div>                   

                  <div class="form-group">
                    <input type="text" class="form-control" name="display" placeholder="Display name" value="<?=$display?>" />
                  </div>            
                
                  <button type="submit" name="edit_submit" class="btn btn-primary">Submit</button>
                  <a href="<?=$THIS_FILE?>" name="cancel" class="btn btn-primary">Cancel</a>
                </form>
              </div>
          </div>

          <?php endif ?>

          <p><a href="<?=$THIS_FILE?>?action=adduser">Add User</a></p>
<!--
==========================================================
GET USER
==========================================================
-->
          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Password</th>
                  <th>Type</th>
                  <th>Display Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
                $i = 1;
               foreach($users as $user): ?>
                <tr>
                  <td><?=$i?></td>
                  <td><?=$user['username']?></td>
                  <td><?=$user['password']?></td>
                  <td><?=$user['type']?></td>
                  <td><?=$user['displayname']?></td>
                  <td>
                    <a href="<?=$THIS_FILE?>?action=edituser&amp;id=<?=$user['AdminId']?>">Edit</a> | 
                    <a onclick="return confirm('Are you sure DELETE <?=$user["username"]?> ?');" href="<?=$THIS_FILE?>?action=delete&amp;id=<?=$user['AdminId']?>">Remove</a>
                  </td>
                </tr>
              <?php
                $i = $i + 1;
                endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>
  <?php
    else:
      $msg = "Ooops+,+You+have+not+access+for+".rtrim(basename($_SERVER['REQUEST_URI']), ".php");
      header("location:index.php?error=1&msg=$msg");
    endif;
  ?>