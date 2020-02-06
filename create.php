<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $eventError = null;
        $dateError = null;
        $timeError = null;
         
        // keep track post values
        $event = $_POST['event'];
        $date = $_POST['date'];
        $time = $_POST['time'];
         
        // validate input
        $valid = true;
        if (empty($event)) {
            $eventError = 'Please enter event name';
            $valid = false;
        }
         
        if (empty($date)) {
            $emailError = 'Please enter event date';
            $valid = false;
        }
         
        if (empty($time)) {
            $mobileError = 'Please enter event time';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO events (event,date,time) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($event,$date,$time));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($eventError)?'error':'';?>">
                        <label class="control-label">Event</label>
                        <div class="controls">
                            <input name="event" type="text"  placeholder="Event" value="<?php echo !empty($event)?$event:'';?>">
                            <?php if (!empty($eventError)): ?>
                                <span class="help-inline"><?php echo $eventError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
                        <label class="control-label">Event Date</label>
                        <div class="controls">
                            <input name="date" type="text" placeholder="1/1/2020" value="<?php echo !empty($date)?$date:'';?>">
                            <?php if (!empty($dateError)): ?>
                                <span class="help-inline"><?php echo $dateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
                        <label class="control-label">Event Time</label>
                        <div class="controls">
                            <input name="time" type="text"  placeholder="6:00PM" value="<?php echo !empty($time)?$time:'';?>">
                            <?php if (!empty($timeError)): ?>
                                <span class="help-inline"><?php echo $timeError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>