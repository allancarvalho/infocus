<div class="row">
	<h3>Contato</h3>

	<?php if(isset($success)) {
		if($success) {
			echo "Sua mensagem foi enviada com sucesso.";
		} else {
			echo "Occoreu algum problema ao enviar sua mensagem.";
		}
	}
	?>
	<form method="post" action="<?php echo base_url('contato/send'); ?>" class="contact-submit">
		<div class="row">
			<div class="large-6 columns">
				<input type="text" required name="nome" placeholder="Nome">
			</div>
			<div class="large-6 columns">
				<input type="text" required  name="email" placeholder="E-mail">
			</div>
			<div class="large-12 columns">
				<input type="text" name="empresa" placeholder="Empresa">
			</div>
			<div class="large-12 columns">
				<input type="text" required name="assunto" placeholder="Assunto">
			</div>
			<div class="large-12 columns">
				<textarea name="mensagem" required cols="30" rows="5" placeholder="Mensagem"></textarea>
			</div>
			<div class="columns">
				<input type="submit" class="button right" value="Enviar">
			</div>

		</div>
	</form>

</div>