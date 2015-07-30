
<h1> Modification de l'adresse </h1>

<form class="form-horizontal" action="" method="post" name="address" role="form">

	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">New firstname</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="firstname" id="firstname" placeholder="<?= $oUser->getFirstname(); ?>"></input>
		</div>
	</div>	

	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">New name</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="name" id="name" placeholder="<?= $oUser->getName(); ?>"></input>
		</div>
	</div>	

	<div class="form-group">
		<label for="address" class="col-sm-2 control-label">New address</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="address" id="address" placeholder="<?= $oUser->getAddress(); ?>"></input>
		</div>
	</div>	

	<div class="form-group">
		<label for="cp" class="col-sm-2 control-label">New CP</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="cp" id="cp" placeholder="<?= $oUser->getCp(); ?>"></input>
		</div>
	</div>

	<div class="form-group">
		<label for="city" class="col-sm-2 control-label">New City</label>
		<div class="col-sm-10">
			<input class="col-sm-3 form-control" name="city" id="city" placeholder="<?= $oUser->getCity(); ?>"></input>
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary" name="subscribe" value="subscribe">Modifier</button>
		</div>
	</div>
</form>

