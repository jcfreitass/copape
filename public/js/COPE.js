

/* botão visualizar o resto do perfil */ 

$(document).ready(function(){
    $("#buttonDetalhesPessoa").click(function(){
        $("#containerDetalhesPessoa").toggle();
    });
});

/* botão para visualizar os planos de ensino disponiveis */

function Mudarestado(el) {
    var display = document.getElementById(el).style.display;
    if (display == "none")
      document.getElementById(el).style.display = 'block';
    else
      document.getElementById(el).style.display = 'none';
  }


function alertCreatePlan(){
    alert("Plano cadastrado com sucesso");
}

function alertEditPlan(){
    alert("Plano de aula atualizado com sucesso");
}

function alertEditPlanNew(){
    alert("Plano de aula criado com sucesso");
}
function alertEditPlanEdit(){
    alert("Usuário editado com sucesso");
}

