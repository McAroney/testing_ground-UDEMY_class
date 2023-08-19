<?php include './config.php'; ?>
<?php include './classes/database.php'; ?>
<?php include './classes/test.php'; ?>
<?php
  try{
    $testObj = new Test();
    $tests = $testObj->index();
  } catch(Throwable $e){
    echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Testing ground</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="#">New Test</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">Tests</h3>
      </div>

      <div class="jumbotron">
        <h1>Why use testing Grounds?</h1>
        <p class="lead">Store your favorite tests here to streamline worrflows and maintain them  and better customize them</p>
        <p><a class="btn btn-lg btn-success" href="new.php" role="button">Add Test Now</a></p>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <?php foreach($tests as $t) : ?>
          <h3><a href="edit.php?id=<?php echo $t['id']; ?>"><?php echo $t['text']; ?></a></h3>
          <p><?php echo $t['creator']; ?></p>
        <?php endforeach; ?>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 20222 Tests OY</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>

