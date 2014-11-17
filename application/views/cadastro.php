<div class="row">
	<h2 class="text-center">Cadastre-se</h2>
	<div id="messages"></div>
	<form method="POST" data-form-signup action="<?php echo base_url('cadastro/send') ?>">
		<h4>Dados pessoais</h4>
		<div class="row">
			<div class="large-6 columns">
				<input type="text" name="username" required placeholder="Usuario">
				<input type="password" name="password" required  placeholder="Senha">
				<input type="email" name="email" required  placeholder="E-mail">
			</div>
			<div class="large-6 columns">
				<input type="text" name="skype" required  placeholder="Skype">
				<input type="text" name="nascimento" required  placeholder="Nascimento">
				<input type="text" name="telefone" required  placeholder="Telefone">
			</div>
		</div>
		<h4>Endereço</h4>
		<div class="row">
			<div class="large-6 columns">
				<input type="text" name="cep" required  placeholder="Cep">
				<input type="text" name="endereco" required  placeholder="Endereço">
				<input type="text" name="numero" required  placeholder="Numero">
				<input type="text" name="complemento" required  placeholder="Complemento">
			</div>
			<div class="large-6 columns">
				<input type="text" name="bairro" required placeholder="Bairro">
				<input type="text" name="cidade" required placeholder="Cidade">
				<input type="text" name="uf" required placeholder="UF">
				<input type="text" name="pais" required placeholder="País">
			</div>
		</div>
		<h4>Need Analysis</h4>
		<div class="row">
			<ol>
				<li>
					<p class="title">O que o leva a estudar inglês?</p>
					<ul class="no-bullet">
						<li>
							<label><input type="checkbox" name="question[0][]" value="Para aprimorar o domínio do  idioma"> <span>Para aprimorar o domínio do  idioma</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Para obter melhores oportunidades no trabalho atual"> <span>Para obter melhores oportunidades no trabalho atual</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Para um trabalho novo ou melhor"> <span>Para um trabalho novo ou melhor</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Para viagens"> <span>Para viagens</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Porque é necessário para a minha graduação"> <span>Porque é necessário para a minha graduação</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Para conhecer pessoas de outros países"> <span>Para conhecer pessoas de outros países </span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Tenho amigos/familiares que falam inglês"> <span>Tenho amigos/familiares que falam inglês</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Porque gosto e me interesso pelo idioma"> <span>Porque gosto e me interesso pelo idioma</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[0][]" value="Porque me interesso pelos aspectos culturais"> <span>Porque me interesso pelos aspectos culturais </span> </label>
						</li>
						<li>
							<label>
								<div class="left">
									Outros (listar)
								</div>
								<div class="">
									<input type="text" name="question[0][]" value="">
								</div>
							</label>
						</li>

					</ul>
				</li>
				<li>
					<p class="title">Quais as áreas descritas abaixo que considera que mais precise melhorar no idioma (assinalar por ordem de prioridade) ?</p>
					<label><input type="text" name="question[1][Leitura]" style="width:30px; height:30px; margin-right:10px; display:inline-block">Leitura</label>
					<label><input type="text" name="question[1][Escrita]" style="width:30px; height:30px; margin-right:10px; display:inline-block">Escrita</label>
					<label><input type="text" name="question[1][Parte Oral]" style="width:30px; height:30px; margin-right:10px; display:inline-block">Parte Oral</label>
					<label><input type="text" name="question[1][Compreensao Auditiva]" style="width:30px; height:30px; margin-right:10px; display:inline-block">Compreensão Auditiva</label>
					<label><input type="text" name="question[1][Gramatica]" style="width:30px; height:30px; margin-right:10px; display:inline-block">Gramática</label>
					<label><input type="text" name="question[1][Vocabulario]" style="width:30px; height:30px; margin-right:10px; display:inline-block">Vocabulário</label>
				</li>
				<li>
					<p class="title">Quais as situações em que você mais precisa usar o inglês?</p>
					<ul class="no-bullet">
						<li>
							<label><input type="checkbox" name="question[2][]" value="Conferências"> <span>Conferências</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[2][]" value="Reuniões Individuais"> <span>Reuniões Individuais</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[2][]" value="Telefonemas"> <span>Telefonemas</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[2][]" value="Teleconferências"> <span>Teleconferências</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[2][]" value="Reuniões em Grupos"> <span>Reuniões em Grupos</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[2][]" value="Apresentações"> <span>Apresentações</span> </label>
						</li>
						<li>
							<label><input type="checkbox" name="question[2][]" value="Socialização"> <span>Socialização</span> </label>
						</li>
					</ul>

				</li>
			</ol>
		</div>
		<input type="submit" class="button small" value="Cadastrar">
	</form>
	<form method="POST" id="teste-nivelamento" action="<?php echo base_url('cadastro/nivelamento') ?>">
		<input type="hidden" name="id_user">
		
	</form>
</div>