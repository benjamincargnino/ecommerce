
<h1> Modification du mot de passe </h1>

<form class="form-horizontal" action="" method="post" name="password" role="form">

	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="email" id="email" value="<?= $oUser->getEmail(); ?>" readonly></input>
		</div>
	</div>

	<div class="form-group">
		<label for="currentpassword" class="col-sm-2 control-label">Current password</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="currentpassword" id="currentpassword" required></input>
		</div>
	</div>	

	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">New password</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="password" id="password"></input>
		</div>
	</div>

	<div class="form-group">
		<label for="confirm_password" class="col-sm-2 control-label">Confirmation</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="confirm_password" id="confirm_password" required></input>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary" name="subscribe" value="subscribe">Modifier</button>
		</div>
	</div>

</form>

