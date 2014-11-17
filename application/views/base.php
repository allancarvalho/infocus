<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Infocus Virtual</title>
	<link rel="stylesheet" href="<?php echo base_url('public/css/foundation.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('public/css/foundation-icons.css'); ?>">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url('public/css/style.css'); ?>">
	<script src="<?php echo base_url('public/js/vendor/modernizr.js'); ?>"></script>
	<script>
	base_url = "<?php echo base_url(); ?>";
	</script>
</head>
<body>
	<div class="row spacing">
		<div class="large-7 small-6 small-centered large-uncentered columns">
			<h1 class="left"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('public/img/logo.png'); ?>" height="58" width="170" alt=""></a></h1>
		</div>
		<div class="large-5 columns">
			<?php 

			if($this->ion_auth->logged_in()) { 
				?>

				<?php 
				echo "Bem vindo ".$this->ion_auth->user()->row()->username;
					// echo $this->ion_auth->user()->row()->points;
				echo "<br>";
				echo $this->points->getPoints($this->ion_auth->user()->row()->id). " minutos disponíveis";
				echo "<br>";
				if($this->points->hasNivel($this->ion_auth->user()->row()->id)) {
					echo "Nivel: ".$this->points->getNivel($this->ion_auth->user()->row()->id);
				}
				echo "<br>";
				?>
				<a href="<?php echo base_url('auth/logout') ?>">Deslogar</a>
				<?php if($this->ion_auth->is_admin()) { ?>
				<div class="row ">
					<button href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button tiny secondary dropdown">Administrar</button>
					<ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true" tabindex="-1">
						<li><a href="<?php echo base_url('agenda') ?>">Agenda de Aulas</a></li>
						<li><a href="<?php echo base_url('nivelamento') ?>">Teste de nivelamento</a></li>
						<li><a href="<?php echo base_url('auth') ?>">Usuários cadastrados</a></li>
						<li><a href="<?php echo base_url('admin/teste_nivelamento') ?>">Teste nivelamento</a></li>
						<li><a href="<?php echo base_url('auth/logout') ?>">Deslogar</a></li>
					</ul>
				</div>

				<?php }  } else { 
					?>

					<form action="<?php echo base_url('auth/login') ?>" class="login-form" method="POST">
						<div class="row">
							<span class="small-6 columns">
								<input type="text" name="identity" id="identity" placeholder="usuário">
							</span>
							<div class="row collapse">
								<span class="small-4 columns">
									<input type="password" name="password" id="password" placeholder="senha">
								</span>
								<span class="small-2 columns">
									<input type="submit" class="button postfix" value="login">
								</span>
							</div>
						</div>
						<div class="row">
							<div class="large-5 columns">
								<input type="checkbox" name="remember" value="1" id="remember">
								<label for="remember">Manter logado</label>
							</div>
							<div class="large-6 columns">
								<a href="<?php echo base_url('auth/forgot_password') ?>">Esqueceu sua senha?</a>
							</div>
						</div>
					</form>
					<?php 

				};
				?>
			</div>
		</div>
		<nav class="top-bar spacing ">
			<div class="row">
				<section class="top-bar-section small-10">
					<ul class="">
						<!-- <li class="active">
							<a href="#">Quem somos</a>
						</li> -->
						<?php if($this->ion_auth->logged_in()) {  ?>
						<?php if($this->ingles->hasNivel()) {  ?>
						<li class="<?=($this->uri->segment(1)==='comprar')?'active':''?>">
							<a href="<?php echo base_url('comprar') ?>">Comprar pontos</a>
						</li>
						<li class="<?=($this->uri->segment(1)==='marcar')?'active':''?>">
							<a href="<?php echo base_url('marcar') ?>">Marcar aulas</a>
						</li>
						<?php } else {  ?>
						<li class="<?=($this->uri->segment(1)==='nivelamento')?'active':''?>">
							<a href="<?php echo base_url('nivelamento') ?>">Teste de nivelamento</a>
						</li>
						<?php }   ?>
						<?php } else {  ?>
						<li class="<?=($this->uri->segment(1)==='cadastro')?'active':''?>">
							<a href="<?php echo base_url('cadastro') ?>">Cadastre-se</a>
						</li>
						<li class="<?=($this->uri->segment(1)==='servicos')?'active':''?>">
							<a href="<?php echo base_url('servicos') ?>">Serviços</a>
						</li>
						<?php } ?>
						

						<li class="<?=($this->uri->segment(1)==='downloads')?'active':''?>">
							<a href="<?php echo base_url('downloads') ?>">Download</a>
						</li>
						<li class="<?=($this->uri->segment(1)==='faq')?'active':''?>">
							<a href="<?php echo base_url('faq') ?>">FAQ</a>
						</li>
						<li class="<?=($this->uri->segment(1)==='contato')?'active':''?>">
							<a href="<?php echo base_url('contato') ?>">Contato</a>
						</li>

				<!-- <li class="has-dropdown not-click">
					<a href="#">Main Item 3</a>
					<ul class="dropdown">
						<li><a href="#">Dropdown Level 1a</a></li>
						<li><label>Dropdown Level 2 Label</label></li>
						<li><a href="#">Dropdown Level 2a</a></li>
						<li><a href="#">Dropdown Level 2b</a></li>
					</ul>
				</li> -->
			</ul>
		</section>
	</div>
</nav>
