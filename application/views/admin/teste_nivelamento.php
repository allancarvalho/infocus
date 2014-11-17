<div class="row spacing">
	<h1>Cadastrar perguntas para o teste de nivelamento</h1>
</div>
<div class="row spacing" ng-app="formApp">
	<div class="large-8 columns" ng-controller="formController">
		<form method="post" ng-submit="processForm()"  class="custom" data-defaultAction="<?php echo site_url('admin/cadastrar_teste_nivelamento') ?>">
			<div class="alert" ng-show="alertSubmit">
				Pergunta cadastrada com sucesso.
			</div>
			<div class="row">
				<div class="large-10 columns">
					<input type="text" tabindex="1" placeholder="Digite a pergunta" name="pergunta">
				</div>
				<div class="large-2 columns">
					<input type="number" tabindex="2" placeholder="Nivel" name="nivel">
				</div>
			</div>
			<label>
			</label>
			<div class="row">
				<div class="large-4 columns right">
					Marque a certa
				</div>
			</div>
			<?php for ($i=0; $i < 4; $i++) { ?>
			<div class="row">
				<div class="large-8 columns">
					<label>
						<input type="text"  tabindex="<?php echo $i + 3; ?>"placeholder="A resposta" name="resposta[]">
					</label>
				</div>
				<div class="large-4 columns">
					<label>
						<span class="custom radio"></span>
						<input type="radio" name="resposta_certa" value="<?php echo $i ?>">
					</label>
				</div>
			</div>
			<?php } ?>
			<input type="submit" class="button small" value="Cadastrar e inserir outro">
		</form>
	</div>
	<div class="large-3 columns">
		<a href="<?php echo site_url('admin/perguntas_cadastradas') ?>">Perguntas cadastradas</a>
	</div>
</div>