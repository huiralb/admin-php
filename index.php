
<!DOCTYPE html>
<html lang="en" data-ng-app="hrcApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Admin Horestco</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/styles.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container" style="padding:40px 20px;">
      <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
              <form role="form" action="api/login.php" method="post" name="formLogin">
                  <h2 class="text-center">Admin Login</h2>
                  <hr />
                  <?php if ($_GET['error'] == 1): ?>
                    <div class="form-group">
                      <p class="help-block text-danger"><?=$_GET['msg']?>.</p>
                      <p class="help-block text-danger">Please retry !</p>
                    </div>
                  <?php else: ?>
                    <div class="form-group">
                      <p class="help-block text-info"><?=$_GET['msg']?></p>
                    </div>                   
                  <?php endif ?>
                  <div class="form-group">
                      <label for="inputName">Username</label>
                      <input type="text" class="form-control" name="name" data-ng-model="user.name" placeholder="Enter Username" required="required" />
                  </div>
                  <div class="form-group">
                      <label for="inputPass">Password</label>
                      <input type="password" class="form-control" name="password" data-ng-model="user.password" placeholder="Password" required="required" />
                  </div>
                  <button type="submit" class="btn btn-primary btn-block" name="submit" ng-disabled="formLogin.$invalid">Login</button>
              </form>
          </div>

      </div>
  </div>
  </body>
</html>
