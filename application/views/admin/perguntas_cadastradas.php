<div ng-app="formApp">
	<div class="row" ng-controller="adminPerguntas">
		<h3 class="large-12">Perguntas cadastradas nivel {{ nivel }} ({{questions.length}} perguntas)</h3>
		<div class="large-9 columns">
			<ul>
				<li ng-repeat="question in questions" id="question-{{question.id}}" class="spacing">
					<div>{{ question.pergunta }} <a ng-click="deleteQuestion(question.id)" class="deletar fi-x right"> Deletar</a></div>
					<input type="hidden" name="idPergunta[{{$index}}]" ng-value="{{question.id}}">
					<ul class="respostas no-bullet" ng-hide="hideSubmit">
						<li ng-repeat="resposta in question.respostas" ng-class="{'correctAnswer': resposta.resposta == question.reposta_certa}">
							<label>
								{{ resposta.resposta }}
							</label>
						</li>
					</ul>

				</li>
			</ul>
		</div>
		<div class="large-2 columns">
			Selecione o nivel
			<select ng-model="nivel" ng-change="changeNivel()">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
		</div>
	</div>
	<div hidden="hidden">
		<div id="dialog-confirm" title="Deseja apagar essa pergunta?">
	</div>
	</div>
</div>