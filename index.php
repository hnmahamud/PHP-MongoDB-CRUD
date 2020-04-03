<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Home</title>
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
								<a href="create.php"><i class="fa fa-plus"></i> Add Note</a>
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

				<div class="padding">
					<div class="full col-sm-9">
						<div class="row">
							<div class="col-sm-5">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4>Profile</h4>
									</div>
									<div class="panel-body">
										<div class="list-group">

                                            <?php

                                            require_once __DIR__ . "/vendor/autoload.php";

                                            $collection = (new MongoDB\Client)->mongotest->users;

                                            $id = $_SESSION["id"];

                                            $users = $collection->find(['id' => $id]);

                                            //$notes = $collection->find([]);

                                            foreach($users as $user) {
                                                echo "<p>"."Name:".$user->username."</p>";
                                                echo "<p>"."ID:".$user->id."</p>";
                                            };

                                            ?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="tab-content">
											<div role="tabpanel" class="tab-pane active" id="list">
												<table class="table table-striped table-bordered table-list">
													<thead>
													<tr>
														<th>Title</th>
														<th>Note</th>
														<th><em class="fa fa-cog"></em></th>
													</tr>
													</thead>
													<tbody>
													<?php

                                					require_once __DIR__ . "/vendor/autoload.php";

                                					$collection = (new MongoDB\Client)->mongotest->notes;

                                                    $id = $_SESSION["id"];

													$notes = $collection->find(['id' => $id]);

													$_SESSION["id"] = $id;

													//$notes = $collection->find([]);

													foreach($notes as $note) {
													echo "<tr>";
														echo "<td>".$note->title."</td>";
														echo "<td>".$note->note."</td>";
														echo "<td align='center'>";
															echo "<a href='edit.php?id=".$note->_id."' class='btn btn-primary' title='Edit'><i class='fa fa-pencil'></i></a>";
															echo "<a href='delete.php?id=".$note->_id."' class='btn btn-danger'  title='delete'><i class='fa fa-trash'></i></a>";
															echo "</td>";
														echo "</tr>";
													};

													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
	</html>