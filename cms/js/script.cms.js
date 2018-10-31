$(document).ready(function() {
                $('.fecharModal').click(function() {
                    $('#containerModal').fadeOut(400);
                });

                 
        
                // ESSE É O JQUERY PARA FAZER A MODAL APARACER NA TELA-->
       
                $(".viewModal").click(function() {
                    $("#containerModal").fadeIn(600); 
                }); 
          
        });
  /*
                    O elemento AJAX será utilizado para fazer a page modal.php aparecer dentro da div modal onde o usuário possa analisar os dados de cada registro do fale conosco.
                */
function modal(idItem, url, ele) {
    $.ajax({
        type: "POST", //tipo de envio
        url: url, //page requisitada
        //caso o elemento obtenha sucesso ele irá carregar o html dentro da div modal
        data: {idRegistro: idItem},
        success: function(dados){
             $(ele).html(dados);
        } 
    })
}

//função para mostrar a imagem no momento em que o usuário inserir
function readURL(input, id) {
    if(input.files && input.files[0]) {
        //instanciando um obj para leitura de arquivos
        var reader = new FileReader();

        //quando o file carregar o procedure abaixo irá acionar
        reader.onload = function(e) {
            //setando a img no elemento escolhido pelo id
            $(id).attr('src', e.target.result).width(inherit).height(inherit);
        }

        reader.readAsDataURL(input.files[0]);
    }
}



//função responsável por gerenciar a aberturar dos forms especificados pela var formname
function openForm(event, formname) {
    var i, tabcontent, tablinks;
    
    tabcontent = document.getElementsByClassName("tabcontent");
    
    for(i =0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = 'none';
    }
    
    tablinks = document.getElementsByClassName('tablink');
    
    for(i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    
    document.getElementById(formname).style.display = "block";
    event.currentTarget.className += 'active';
}




function larguraHeader(param) {
   // var sizeModal = param;
    alert(param);
    
    var header = (modal.sobre.php).getElementById('smallHeader');
    
    header.style.width = param;
}

//window.onload = larguraHeader(600);


//o usuário irá definir através de parametros qual a url e o elemento onde ele deseja carregar o html
function openInsertModal(url, container, hideEle){
    $.ajax({
        type:"post",
        url: url,
        processData: "false",
        dataType:"text",
        success: function(dados) {
            $(container).html(dados)
            $(container).show();
            $(hideEle).hide();
        }
    })
}

function openEditNivel(idItem, url, container, hideEle){
    $.ajax ({
        type:'POST',
        url:url,
        data: {idRegistro: idItem},
        success: function(dados){
            $(container).show();
           $(container).html(dados);
            $(hideEle).hide();
           

           
        }
    })
}


function openViewUser(idItem, modo, url, container, hideEle){
    
    $.ajax ({
        type:'post',
        url: url,
        data: {idRegistro: idItem, modo: modo},
        success: function(dados){
           $(container).html(dados);
            $(hideEle).hide();
        }
    })
}

