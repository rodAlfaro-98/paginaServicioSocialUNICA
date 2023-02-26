var filtros = [];
var filtro_dato = [];

function confirmacionBaja(numero_cuenta){
    if( confirm("Se va a dar de baja al alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/baja/"+numero_cuenta;
    }
}

function confirmacionRechazo(numero_cuenta){
    if( confirm("Se va a rechazar la solicitud del alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/rechazo/"+numero_cuenta;
    }
}

function confirmacionNuevaAlta(numero_cuenta){
    if( confirm("Se va a volver a dar de alta al alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/aceptar/"+numero_cuenta;
    }
}

function getAlumnos(){
    var table,tr,txtValue,txtInput,filter;
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

function filtroTipoDato(){
    document.getElementById('genero_selector').style.display = "none";
    document.getElementById('carrera_selector').style.display = "none";
    document.getElementById('procedencia_selector').style.display = "none";
    document.getElementById('fecha_selector').style.display = "none";
    document.getElementById('estado_selector').style.display = "none";
    document.getElementById('titulo2').style.display = "none";
    if(document.getElementById('Semestre').checked){
        document.getElementById('fecha_selector').style.display = "block";
        document.getElementById('titulo2').style.display = "block";
    }if(document.getElementById('Genero').checked){
        document.getElementById('genero_selector').style.display = "block";
        document.getElementById('titulo2').style.display = "block";
    }if(document.getElementById('Interno').checked){
        document.getElementById('procedencia_selector').style.display = "block";
        document.getElementById('titulo2').style.display = "block";
    }if(document.getElementById('Carrera').checked){
        document.getElementById('carrera_selector').style.display = "block";
        document.getElementById('titulo2').style.display = "block";
    }if(document.getElementById('Estado').checked){
        document.getElementById('estado_selector').style.display = "block";
        document.getElementById('titulo2').style.display = "block";
    }
}

function filtroDato(){
    var options = document.getElementById('tipo_dato_selector');
    var selected = options.options[options.selectedIndex].text;
    if(selected == 'Semestre de servicio'){
        var selector = document.getElementById('fecha_selector');
        if(filtros.includes('semestre')){
            var index = filtros.indexOf("semestre");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
        }else{
            filtros.push("semestre");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }
    }else if(selected == 'Género del alumno'){
        var selector = document.getElementById('genero_selector');
        if(filtros.includes('genero')){
            var index = filtros.indexOf("genero");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
        }else{
            filtros.push("genero");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }
    }else if(selected == "Procedencia del alumno"){
        var selector = document.getElementById('procedencia_selector');
        if(filtros.includes('procedencia')){
            var index = filtros.indexOf("procedencia");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
        }else{
            filtros.push("procedencia");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }
    }else if(selected == 'Carrera del alumno'){
        var selector = document.getElementById('carrera_selector');
        if(filtros.includes('carrera')){
            var index = filtros.indexOf("carrera");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
        }else{
            filtros.push("carrera");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }

        return [filtros,filtro_dato];
    }else if(selected == 'Estado del alumno'){
        var selector = document.getElementById('estado_selector');
        if(filtros.includes('estado')){
            var index = filtros.indexOf("estado");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
        }else{
            filtros.push("estado");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }

        return [filtros,filtro_dato];
    }
}