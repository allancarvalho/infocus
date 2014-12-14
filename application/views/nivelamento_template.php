<div class="row" ng-app="formApp">
	<div ng-controller="testeNivelamentoController">
		<h1>Teste de nivelamento</h1>
		<h3>Nivel {{ nivel }}</h3>
		<hr>
		<form id="formNivelamento" class="spacing" ng-submit="submitQuestions()">
			{{loading}}
			<div ng-show="formSubmitted">
				Você acertou {{ porcent }}% do teste.
			</div>
			<div ng-show="testEnd">
				O teste terminou, seu nível é <h1 class="hightlightLevel">{{ nivelName }}</h1>
			</div>

			<input type="button" ng-show="loadNextAvailable" ng-click="getNextQuestions()" class="button" value="Carregar próximas questões">

			<ol>
				<input type="hidden" name="currentLevel" value="{{ nivel }}">
				<li ng-repeat="question in questions" ng-class="getClass(question.id)" id="question-{{question.id}}">
					<div>{{ question.pergunta }}</div>
					<input type="hidden" name="idPergunta[{{$index}}]" ng-value="{{question.id}}">
					<ul class="respostas no-bullet" ng-hide="hideSubmit">
						<li ng-repeat="resposta in question.respostas">
							<label>
								<input type="radio" value="{{ resposta.resposta }}" name="question[{{$parent.$index}}]"/> {{ resposta.resposta }}
							</label>
						</li>
					</ul>
				</li>
			</ol>
	
			<input type="submit" ng-hide="hideSubmit" class="button" value="Enviar respostas">
		</form>
	</div>
</div>