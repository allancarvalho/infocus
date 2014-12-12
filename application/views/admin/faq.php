<div class="row" ng-app="formApp">
	<div ng-controller="faqController">
		<div class="large-8 columns">
			
			<h1>Perguntas do FAQ</h1>
			<hr>

			<ol>
				<li ng-repeat="question in questions" ng-class="getClass(question.id)" id="question-{{question.id}}">
					<div><strong>{{ question.pergunta }}</strong></div>
					<div>{{ question.resposta }}</div>
					<input type="button" ng-click="deleteFaq(question.id)" value="Deletar">
				</li>
			</ol>
		</div>
		<div class="large-4 columns">
			

			<form id="formFaq" class="spacing" ng-submit="submitFaq()">
				Cadastrar FAQ
				<textarea name="pergunta" placeholder="Pergunta" cols="30" rows="4"></textarea>
				<textarea name="resposta" placeholder="Resposta" cols="30" rows="10"></textarea>
				<input type="submit" value="Cadastrar">


			</form>
		</div>
	</div>
</div>