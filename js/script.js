//jquery para causar efeito de smooth scrolling
$(document).ready(function(){
    teste();

    //abrindo a modal para detalhes do livro
    $('.modal').click(function(){
        $('#containerModal').fadeIn(600);
    });

    //abrindo a modal para detalhes do livro
    $('.closeModal').click(function() {
        $('#containerModal').fadeOut(400);
    });
        
        mudarImg(slideindex);
        //automatizando o slider
        setInterval(
            function(){             mudarImg(slideindex++)}, 
        5500);
        
    // adicionando rolagem suave a todos os links
        $("a").on('click', function(event) {

        // Está verificando se a já não existe um hash,
        //que é o sustenido da URl
        if (this.hash !== "") {
        // evita o comportamento padrão da âncora
            event.preventDefault();

            // armazena o hash
            var hash = this.hash;

            /*usando a função animate() do jquery para 
            dar o feito de scroll suave na página*/  
            /*
            o 800 representa a quantidade de milisegundos para a page nos levar até o link esperado
            */
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
        //adicionando o sustenido para a URL quando o scroll estiver finalizado
        window.location.hash = hash;
      });
    } // End if
  });
    
    
});
//código para funcionamento do slider     

 var slider = document.getElementById("slider");     
var slideindex = 0; //controla a img do slider


//funcao para abrir a modal
//var url será o path da page 
 function abrirModalAdd(idItem) {
            $.ajax({
               type: "POST", //tipo de envio
               url: "modal.nivel.php", //page requisitada
               //caso o elemento obtenha sucesso ele irá carregar o html dentro da div modal
               success: function(dados){
                  // $("#viewDados").html(dados);
                   alert('Oi');
               } 
            })

            
        }
         
//muda a img para a próxima
function proxImg() {
    return slideindex++;    
}
        
//volta uma imagem
function prevImg() {
    /*
    se o slideindex for maior q o 0, ela irá retornar uma decrementação, caso ela for igual a 0, seu valor mudará para 2, e assim ela o slider irá voltar para a última imagem, e nunca cairá em um número negativo.
    */
            
    if(slideindex > 0) {
        return slideindex--;    
    } else {
         slideindex = 2;
    }
}
        
//muda as imagens do slider de acordo com o clique do botão
function mudarImg() {
    switch(slideindex) {
        case 1:
            slider.style.backgroundImage = "url('imagens/lib1.jpg')";
            break;
        case 2:
            slider.style.backgroundImage = "url('imagens/lib2.jpg')";
            break;
        default: 
            slider.style.backgroundImage = "url('imagens/lib0.jpg')";
                        slideindex = 0;
                      
    }
    //colocando um contador no slider dentro do html
    document.getElementById('indexslider').innerHTML = slideindex + 1 +  "/3";   
             
}

//function para validar campos no fale conosco
function validar(caracter, blocktype, id) {
    document.getElementById(id).style = "background: #fff;";
                
    if(blocktype == "num") {
    /*Transformando a letra em ascii, o código de identificação*/
        if(window.event)
             var letra = caracter.charCode; 
        else
             var letra = caracter.which;
                
        if(letra > 47 && letra <= 57) {
            document.getElementById(id).style="background: #f00;";
            return false; /*Cancela a ação da tecla*/
        }  
                 
    } else if(blocktype == "txt") {
        if(window.event)
            var letra = caracter.charCode; 
        else
            var letra = caracter.which;
                
        if(letra != 8 && letra != 46 && letra < 47 || letra > 57) {
            document.getElementById(id).style="background: #f00;";
            return false; /*Cancela a ação da tecla*/
        }  
    } //fim elseif  
}

//verificação do AJAX para detecção de qual instância usar
// nos navegadores
function initAjax() {
    var objAjax = false;
    if(window.XMLHttpRequest) {
        objAjax = new XMLHttpRequest();
    } else if(window.ActiveXObject) {
        objAjax = new ActiveXObject("Msxml2.XMLHTTP");
        if(!objAjax) {
            objAjax = new ActiveXObject("Microsoft.XMLHTTP");
        }
    } else {
        alert("Seu navegador não suporta a aplicação");
    }

    return objAjax;
}

/*Fazendo uma requisição ao servidor, onde o mesmo irá retornar um 
status de comunicação, isso será possível através da ação disparadora
onreadystatechange
*/
function teste(){
    var request = initAjax();
    if(request) {
        request.onreadystatechange = function() {
            if(request.readyState == 1) {
                alert("Oi, eu sou o server");
            }
        };
    }
}

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




