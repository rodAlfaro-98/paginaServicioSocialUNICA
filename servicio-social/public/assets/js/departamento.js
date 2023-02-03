function confirmacionBaja(numero_cuenta){
    if( confirm("Se va a dar de baja al alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/baja/"+numero_cuenta;
    }
}

function confirmacionBaja(numero_cuenta){
    if( confirm("Se va a rechazar la solicitud del alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/rechazo/"+numero_cuenta;
    }
}
function getAlumnos(){
    var tablr,tr,txtValue,txtInput,filter;
    table = document.getElementById('TablaAlumnos')
    tr = table.getElementsByTagName("tr");
    filter = document.getElementById('nombre_becario');
    txtInput = filter.value.toUpperCase()
    for (var i = 1; i < tr.length; i++){
        var nombre = tr[i].getElementsByTagName("td")[1].innerHTML
        if(nombre.toUpperCase().includes(txtInput)){
            tr[i].style.display = "";
        }else{
            tr[i].style.display = "none";
        }
    }
}
function getSelected(){
    var filter = [];
    if(document.getElementById('DSA').checked) {
        filter.push('DSA');
    }
    if(document.getElementById('DID').checked) {
        filter.push('DID');
    }
    if(document.getElementById('DSC').checked) {
        filter.push('DSC');
    }
    if(document.getElementById('DROS').checked) {
        filter.push('DROS');
    }
    if(document.getElementById('Salas').checked) {
        filter.push('Salas');
    }
    var table, tr, txtValue;
    table = document.getElementById('TablaAlumnos')
    tr = table.getElementsByTagName("tr");
    if(filter.length == 0){
        for (var i = 1; i < tr.length; i++){
            tr[i].style.display = "";
        }
    }
    else{
        for (var i = 1; i < tr.length; i++){
            var departamento = tr[i].getElementsByTagName("td")[5]
            if(filter.includes(departamento.innerHTML)){
                tr[i].style.display = "";
            }else{
                tr[i].style.display = "none";
            }
        }
    }

}