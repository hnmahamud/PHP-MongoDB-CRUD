<?php

session_start();

require_once __DIR__ . "/vendor/autoload.php";

$collection = (new MongoDB\Client)->mongotest->notes;

if (isset($_GET['id'])) {
$note = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['id'])]);
}

if(isset($_POST['submit'])){

	$collection->updateOne(
	['_id' => new MongoDB\BSON\ObjectID($_GET['id'])],
	['$set' => ['title' => $_POST['title'], 'note' => $_POST['note'],]]
	);

	$_SESSION['success'] = "Book updated successfully";
	header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Edit Note</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href="css/crud.css" rel="stylesheet">

    </head>
    <body>
        <div class="wrapper">
			<div class="column col-md-12" id="main">
				<div class="navbar navbar-blue navbar-static-top">
					<div class="navbar-header">
						<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<nav class="collapse navbar-collapse" role="navigation">
						<ul class="nav navbar-nav">
							<li>
								<a href="index.php"><i class="fa fa-home"></i> Home</a>
							</li>
							<li>
								<a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
							</li>
							<li>
								<a href="delete-account.php"><i class="fa fa-trash"></i> Delete Account</a>
							</li>
						</ul>
					</nav>
				</div>
				<div class="container">
					<div class="row">
						<hr><hr>
						<div class="col-md-12">
							<h2 class="text-center" style="color: #5bc0de">Edit Note</h2>
							<form method="POST">
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-info-circle"> </i></span>
										<input type="text" name="title" value="<?php echo $note->title; ?>" required="" class="form-control" placeholder="Title">
									</div>
								</div>

								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-sticky-note-o"> </i></span>
										<textarea class="form-control" name="note" placeholder="Note"><?php echo $note->note; ?></textarea>
									</div>
								</div>

								<button type="submit" name="submit" class="btn btn-info">Submit</button>
								<a href="index.php" class="btn btn-info">Back</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
	</html>