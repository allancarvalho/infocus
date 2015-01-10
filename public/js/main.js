


var clientId = '832427881927-qmf0577aba1q2k2ms65c6u0fesn83jc2.apps.googleusercontent.com';

var apiKey = 'AIzaSyCGNO4M8iNuV6S_9N3B1dt0PByxo-jFGPA';

var scopes = 'https://www.googleapis.com/auth/calendar';

$(".recusar_aula").on("click", function(e){
    var tr = $(this).closest("tr");
    var nome = tr.find("td:eq(0)").text();
    var email = tr.find("td:eq(1)").text();
    var hora = tr.find("td:eq(2)").text();
    var id_aula = $(this).attr("data-aula-id");
    $("#recusar").html(nome);
    $("#recusar").append("<br>");
    $("#recusar").append(email);
    $("#recusar").append("<br>");
    $("#recusar").append(hora);


    $( "#recusar" ).dialog({
        resizable: false,
        modal: true,
        draggable: false,
        buttons: {
            "Deletar": function() {
                var self = this;
                $.post(base_url+"agenda/desconfirmar/"+id_aula, function() {
                    location.reload();
                });
            },
            Cancelar: function() {
                $( this ).dialog( "close" );
            }
        }
    });
});
$(".confirmar_aula").on("click", function(e){
    var tr = $(this).closest("tr"), 
    id_aula = $(this).attr("data-aula-id");

    e.preventDefault();
    gapi.auth.authorize(
        {client_id: clientId, scope: scopes, immediate: false},
        function(result){
            if (result) {
                var data = { 
                    start: { dateTime: tr.find('[data-google-start]').attr('data-google-start') }, 
                    end: { dateTime: tr.find('[data-google-end]').attr('data-google-end') }, 
                    summary: tr.find("td:eq(0)").text() + ' - ' + tr.find("td:eq(1)").text()
                };
                makeApiCall(data, function(){
                    $.post(base_url+"agenda/confirmar/"+id_aula, function() {
                        location.reload();
                    });
                });
            }
        });


});

// var url = 'https://www.googleapis.com/calendar/v3/calendars/9rCSFeQD07DvXtFHyF1zAguS@group.calendar.google.com/events?sendNotifications=false&access_token=AIzaSyAvYM47axnYyMuS0U3xDcZnfr2w9XZVKeU';
// var url = 'https://www.googleapis.com/calendar/v3/calendars/37biq431hks8fql5513be543k0@group.calendar.google.com/events?sendNotifications=false&access_token=AIzaSyAvYM47axnYyMuS0U3xDcZnfr2w9XZVKeU';
function makeApiCall(data, callback) {
// return false;
gapi.client.load('calendar', 'v3', function() {
    var request = gapi.client.calendar.events.insert({
        'calendarId': 'engikcn3m5gmclnnjuog1eml1k@group.calendar.google.com',
        resource: data
    });

    request.execute(function(resp) {
        console.log(resp);
        callback.call(this, resp);
    });
});
}

function handleClientLoad() {
    gapi.client.setApiKey(apiKey);
    window.setTimeout(checkAuth,1);
// checkAuth();
}

function checkAuth() {
    gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: true},
        handleAuthResult);
}

function handleAuthResult(authResult) {
    var authorizeButton = document.getElementById('authorize-button');
    if(!authorizeButton) {
        return false;
    }
    if (authResult) {
        authorizeButton.style.visibility = 'hidden';
    } else {
        authorizeButton.style.visibility = '';
        authorizeButton.onclick = handleAuthClick;
    }
}

function handleAuthClick(event) {
    gapi.auth.authorize(
        {client_id: clientId, scope: scopes, immediate: false},
        handleAuthResult);
    return false;
}

//  var data = { 
//         start: { dateTime: "2014-09-11T11:00:00-03:00" }, 
//         end: { dateTime: "2014-09-11T11:30:00-03:00" }, 
//         summary: "Nome do evento"
//       };
// $.post("https://www.googleapis.com/calendar/v3/calendars/37biq431hks8fql5513be543k0@group.calendar.google.com/events", data, function(result) {
//   console.lg(result)
// });




// // define angular module/app
var formApp = angular.module('formApp', ['ngSanitize']);

// // create angular controller and pass in $scope and $http
function faqController($scope, $http) {
    $scope.getQuestions = function() {
        $http({
            method  : 'GET',
            url     : base_url+'admin/getFaq',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(data) {
            $scope.questions = data
        });
    }

    $scope.deleteFaq = function(id) {
        $http({
            method  : 'GET',
            url     : base_url+'admin/deleteFaq/'+id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(data) {
            $scope.getQuestions();
        });
    }

    $scope.getQuestions();

    $scope.submitFaq = function() {
        $http({
            method  : 'POST',
            url     : base_url+'admin/insertFaq/',
            data    : $.param($("#formFaq").serializeArray()),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(data) {
            $("#formFaq").get(0).reset();
            $scope.getQuestions();
        });
    }
}
function formController($scope, $http) {

	$scope.processForm = function() {

        $http({
            method  : 'POST',
            url     : $("form").attr("data-defaultAction"),
            data    : $.param($("form").serializeArray()),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
        .success(function(data) {
            // console.log(data);
            $("input[type='text']").val("")

            document.querySelector("input[type='text']").focus();
            
            $scope.alertSubmit = true;

            setTimeout(function() {
                $scope.alertSubmit = false;
            }, 10000);
        });
  //       return false;
};

}

function adminPerguntas($scope, $http) {
    $scope.nivel = 1;
    $scope.changeNivel = function() {
        $http.get(base_url+'index.php/admin/getPerguntas/'+$scope.nivel).success(function(data) {
            $scope.questions = data;
        });
    }
    $scope.deleteQuestion = function($id) {
        $scope.deletando = $id;
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Apagar": function() {
                    $http.get(base_url+'index.php/admin/deletePergunta/'+$id).success(function(data) {
                        $scope.changeNivel();
                        $scope.deletando = '';
                    });         
                    $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $scope.deletando = '';
                    $( this ).dialog( "close" );
                }
            }
        });
    }
    $scope.editQuestion = function($id) {
        $scope.editando = $id;

        $http.get(base_url+'index.php/admin/getPergunta/'+$id).success(function(data) {
            $scope.cQuestion = data;
        });  



        $( "#dialog-edit" ).dialog({
            resizable: false,
            height:400,
            width:400,
            modal: true,
            buttons: {
                "Salvar": function() {
                    $self = this;
                    $scope.loading = "Salvando...";
                    var serialized = $( "#dialog-edit form" ).serialize()
                    console.log(serialized);
                    $http({
                        method: 'POST',
                        url: base_url+'admin/editPergunta',
                        data: serialized,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).success(function(data) {
                        $( $self ).dialog( "close" );
                        $scope.loading = "";
                        $scope.changeNivel();

                        

                    });
                    // $http.get(base_url+'index.php/admin/getPergunta/'+$id).success(function(data) {
                    //     $scope.changeNivel();
                    //     $scope.deletando = '';
                    // });         
                    // $( this ).dialog( "close" );
                },
                Cancel: function() {
                    $scope.editando = '';
                    $( this ).dialog( "close" );
                }
            }
        });
}
$scope.changeNivel();
}
function testeNivelamentoController($scope, $http) {
    $scope.nivel = 1;
    $http.get(base_url+'index.php/admin/getPerguntas/'+$scope.nivel).success(function(data) {
        $scope.questions = data;
        $scope.getNameNivel();
    });


    $scope.getNameNivel = function() {
        
        $niveis = ['ELEMENTARY', 'PRE-INTERMEDIATE', 'INTERMEDIATE', 'UPPER INTERMEDIATE', 'ADVANCED' ];

        $scope.nameNivel = $niveis[$scope.nivel - 1] || 'ELEMENTARY';

    }

    $scope.submitQuestions = function() {
        $scope.loading = "Enviando...";
        $http({
            method: 'POST',
            url: base_url+'nivelamento/sendRespostas',
            data: $("#formNivelamento").serialize(),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function(data) {
            $("html, body").animate({ scrollTop: 0 }, 600);

            $scope.loading = "";

            $scope.formSubmitted = true;
            $scope.porcent = data.percentageCorrect;

            $scope.loadNextAvailable = data.hasNext;
            $scope.hideSubmit = true;
            $scope.nivelName = data.nivel;
            if(!data.hasNext) {
                $scope.testEnd = true;
            }
            data.correctQuestionsIds.forEach(function(idCorrect) {
                $scope['question-'+idCorrect] = "correct";
            });

            data.inCorrectQuestionsIds.forEach(function(idIncorrect) {
                $scope['question-'+idIncorrect] = "incorrect";
            });
        });
    }
    $scope.getClass = function(id) {
        return $scope['question-'+id];
    }

    $scope.getNextQuestions = function() {
        $scope.nivel = $scope.nivel + 1;
        $http.get(base_url+'index.php/admin/getPerguntas/'+$scope.nivel).success(function(data) {
            $scope.questions = data;
            $scope.formSubmitted = false;
            $scope.hideSubmit = false;
            $scope.loadNextAvailable = false;

        });
    }
}

$("[name=cep]").on("blur", function() {
    $.getJSON("http://cep.republicavirtual.com.br/web_cep.php?formato=json&cep="+this.value, function(data) {
        if(data.resultado == 1) {
            $("[name=endereco]").val(data.tipo_logradouro + " " + data.logradouro);
            $("[name=uf]").val(data.uf);
            $("[name=cidade]").val(data.cidade);
            $("[name=bairro]").val(data.bairro);
            $("[name=pais]").val("Brasil");
        }
    });
})

$("[data-form-signup]").on("submit", function(event){
    event.preventDefault(), form = this;

    $.ajax({
        url: this.action,
        method: this.method,
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data){
            if(data.success) {
                $(form).html("")
                $("#messages").html(data.messages);
                $("#messages").append("<br>Redirecionando para o teste de nivelamento...");
                $("#teste-nivelamento [name=id_user]").val(data.id);
                setTimeout(function() {
                    location.href=base_url+"nivelamento";
                }, 2000);
            } else {
                $("#messages").html(data.messages[0]);
            }
        }
    })
});
$(function() {
    $(".pontos-nome").on("click", function() {
        $(".pontos-setname").val($(".pontos-nome:checked").parent().text().trim());
    });
});

$(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'
    });

    $(".marcar-form").on("submit", function(e) {
        e.preventDefault(), form = this;

        $.ajax({
            url: this.action,
            method: this.method,
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data){

                // $(form).appendThtml(data.message);
                if(data.success) {
                    var item = "<div class='result-form-marcar'><strong>Aula marcada com sucesso</strong><br>"+data.message+"</div>";
                    form.reset();
                } else {
                    var item = "<div class='result-form-marcar'><strong>Houve algum erro na marcação da aula</strong><br>"+data.message+"</div>";
                    // $("#messages").html(data.messages[0]);
                }
                $(item).appendTo(form);

                setTimeout(function() {
                    $(".result-form-marcar").remove();
                }, 5000);
            }
        });
    });
    $("[data-mask]").each(function() { 
        $(this).mask($(this).attr('data-mask'));
    });
    $(".DeleteUser").on("click", function(e) {
        e.preventDefault();
        if(confirm("Deseja deletar esse usuário?")) {
            $.get($(this).attr("href"), function() {
                location.reload();
            });
        }
    })
}); 