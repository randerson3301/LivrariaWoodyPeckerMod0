$(document).ready(function() {
                $('.fecharModal').click(function() {
                    $('#containerModal').fadeOut(400);
                });
            });

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

document.getElementById('openByDefault').click();


function larguraHeader(param) {
   // var sizeModal = param;
    alert(param);
    
    var header = (modal.sobre.php).getElementById('smallHeader');
    
    header.style.width = param;
}

window.onload = larguraHeader(600);