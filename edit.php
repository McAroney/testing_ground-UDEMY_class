<?php include './config.php'; ?>
<?php include './classes/database.php'; ?>
<?php include './classes/test.php'; ?>
<?php
  try{
    $testObj = new Test();
    $test = $testObj->getSingle($_GET['id']);
  } catch(Throwable $e){
    echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
  }

  if(isset($_POST['submit'])){
    $id = $_GET['id'];
    $text = $_POST['text'] ?: null;
    $creator = $_POST['creator'] ?: 'Unknown';

    try{
      $testObj = new Test();
      $testObj->update($id, $text, $creator);
    } catch(Throwable $e){
      echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
    }
  }

    if(isset($_POST['delete'])){
      $id = $_GET['id'];
      try{
        $testObj = new Test();
        $testObj->remove($id);
      } catch(Throwable $e){
        echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
      }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Testing Grounds | New Test</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation" class="active"><a href="new.php">New Test</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">GoodTesting Grounds</h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
          <h2 class="page-header">Edit Test
            <form class="pull-right" method="POST" action="edit.php?id=<?php echo $_GET['id']; ?>">
              <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>
          </h2>
          <form method="POST" action="edit.php?id=<?php echo $_GET['id']; ?>">
            <div class="form-group">
              <label>Test Description</label>
              <input type="text" class="form-control" name="text" value="<?php echo $test['text']; ?>" placeholder="Test description...">
            </div>
            <div class="form-group">
              <label>Creator / Author</label>
              <input type="text" class="form-control" name="creator" value="<?php echo $test['creator']; ?>" placeholder="Test creator...">
            </div>
            <button type="submit" name="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; 2022 Tests OY</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
