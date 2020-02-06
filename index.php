<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Events</h3>
            </div>
            <div class="row">
				<p>
                    <a href="create.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Event</th>
                      <th>Date</th>
                      <th>Time</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM events ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['event'] . '</td>';
                            echo '<td>'. $row['date'] . '</td>';
                            echo '<td>'. $row['time'] . '</td>';
							echo '<td width=250>';
							echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
							echo ' ';
							echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
							echo ' ';
							echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>