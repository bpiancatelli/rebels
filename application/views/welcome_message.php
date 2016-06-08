<?php $this->load->view('tags/header'); ?>

<div class="col-md-offset-4 col-md-4" style="margin-top:15%; padding:5px; border:1px solid #ccc; border-radius:5px;">
	<a style="float:left" class="navbar-brand" href="http://rebelfox.weebly.com/">Site des Rebels - v2.5.0</a>
	<?php echo form_open('membre/login') ?>	
	<form class="form-signin">																																	
		<div class="form-group"><input class="input-block-level form-control" placeholder="Identifiant" type="input" name="pseudo"/></div>
		<div class="form-group"><input class="input-block-level form-control" placeholder="Mot de passe" type="password" name="password"></div>
		<div class="form-group"><input class="btn btn-default btn-block active" type="submit" name="submit" value="Connexion" name="confirmer"/></div>
	</form>
	<div class="text-center">
		<a style="color: white" style="float:left"  href="mailto:liegebaseballstats@gmail.com">Nous contacter</a>
	</div>	
	
</div>


<?php $this->load->view('tags/footer'); ?>