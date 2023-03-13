var filtros = [];
var filtro_dato = [];

/*
* @brief Función encargada de generar un popup para confirmar la decisión del usuario.
* @return Si se confirma la acción se invoca a la función encargada de dar de baja
*/
function confirmacionBaja(numero_cuenta){
    if( confirm("Se va a dar de baja al alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/baja/"+numero_cuenta;
    }
}

/*
* @brief Función encargada de generar un popup para confirmar la decisión del usuario.
* @return Si se confirma la acción se invoca a la función encargada de rechazar al alumno
*/
function confirmacionRechazo(numero_cuenta){
    if( confirm("Se va a rechazar la solicitud del alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/rechazo/"+numero_cuenta;
    }
}

/*
* @brief Función encargada de generar un popup para confirmar la decisión del usuario.
* @return Si se confirma la acción se invoca a la función encargada de Volver a dar de alta al alumno
*/
function confirmacionNuevaAlta(numero_cuenta){
    if( confirm("Se va a volver a dar de alta al alumno con numero de cuenta: "+numero_cuenta+"\nDesea confirmar la acción?") == true ){
        window.location.href = "/departamento/aceptar/"+numero_cuenta;
    }
}

/*
* @brief Función encargada de filtrar por nombre del becario
*/
function getAlumnos(){
    var table,tr,txtValue,txtInput,filter;
    table = document.getElementById('TablaAlumnos')
    tr = table.getElementsByTagName("tr");
    //Obtenemos el nombre ingresado por el usuario y lo cambiamos a mayúsculas
    filter = document.getElementById('nombre_becario');
    txtInput = filter.value.toUpperCase()
    //Iteramos la tabla de alumnos
    for (var i = 1; i < tr.length; i++){
        var nombre = tr[i].getElementsByTagName("td")[1].innerHTML
        //Si el renglón de la tabla incluye al nombre ingresado se muestra el registro, sino su display se cambia a none
        if(nombre.toUpperCase().includes(txtInput)){
            tr[i].style.display = "";
        }else{
            tr[i].style.display = "none";
        }
    }
}

/*
* @brief Función encargada de filtrar la tabla de alumnos por división a la que pertenecen
*/
function getSelected(){
    //Creamos una lista de divisiones seleccionadas
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
    //Mostramos todos los registros si no se seleccionó ninguna división
    if(filter.length == 0){
        for (var i = 1; i < tr.length; i++){
            tr[i].style.display = "";
        }
    }
    else{
        //Filtramos los registros para que solo muestre aquellos pertenecientes a las divisiones seleccionadas
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

/*
* @brief Función encargada de mostrar los combobox de los criterios seleccionados
*/
function filtroTipoDato(){
    document.getElementById('genero_selector').style.display = "none";
    document.getElementById('carrera_selector').style.display = "none";
    document.getElementById('procedencia_selector').style.display = "none";
    document.getElementById('fecha_selector').style.display = "none";
    document.getElementById('estado_selector').style.display = "none";
    document.getElementById('titulo2').style.display = "none";
    document.getElementById('becario_selector').style.display = "none";
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
    }if(document.getElementById('becario_unica').checked){
        document.getElementById('becario_selector').style.display = "block";
        document.getElementById('titulo2').style.display = "block";
    }
}

/*
* @brief Función encargada de generar una lista de filtros seleccionados
*
*/
function filtroDato(){
    var options = document.getElementById('tipo_dato_selector');
    //Checamos el filtro seleccionado de los checkbox tipo_dato_selector
    var selected = options.options[options.selectedIndex].text;
    //Si se seleccionó el semestre como filtro obtenemos el semestre seleccionado de fecha_selector y lo guardamos en la lista
    if(selected == 'Semestre de servicio'){
        var selector = document.getElementById('fecha_selector');
        //Si ya fue seleccionado anteriormente este dato sustituimos el nuevo filtro de la lista de filtros
        if(filtros.includes('semestre')){
            var index = filtros.indexOf("semestre");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
            //Si no fue seleccionado anteriormente este dato lo agregamos con un push a la lista
        }else{
            filtros.push("semestre");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }
    //Si se seleccionó el género como filtro obtenemos el género seleccionado de genero_selector y lo guardamos en la lista
    }else if(selected == 'Género del alumno'){
        var selector = document.getElementById('genero_selector');
        //Si ya fue seleccionado anteriormente este dato sustituimos el nuevo filtro de la lista de filtros
        if(filtros.includes('genero')){
            var index = filtros.indexOf("genero");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
            //Si no fue seleccionado anteriormente este dato lo agregamos con un push a la lista
        }else{
            filtros.push("genero");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }
    //Si se seleccionó la procedencia como filtro obtenemos la procedencia seleccionado de procedencia_selector y lo guardamos en la lista
    }else if(selected == "Procedencia del alumno"){
        var selector = document.getElementById('procedencia_selector');
        //Si ya fue seleccionado anteriormente este dato sustituimos el nuevo filtro de la lista de filtros
        if(filtros.includes('procedencia')){
            var index = filtros.indexOf("procedencia");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
            //Si no fue seleccionado anteriormente este dato lo agregamos con un push a la lista
        }else{
            filtros.push("procedencia");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }
    //Si se seleccionó la carrera como filtro obtenemos la carrera seleccionado de carrera_selector y lo guardamos en la lista
    }else if(selected == 'Carrera del alumno'){
        var selector = document.getElementById('carrera_selector');
        //Si ya fue seleccionado anteriormente este dato sustituimos el nuevo filtro de la lista de filtros
        if(filtros.includes('carrera')){
            var index = filtros.indexOf("carrera");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
            //Si no fue seleccionado anteriormente este dato lo agregamos con un push a la lista
        }else{
            filtros.push("carrera");
            filtro_dato.push(selector.options[selector.selectedIndex].text);
        }

        return [filtros,filtro_dato];
    //Si se seleccionó el estado como filtro obtenemos la estado seleccionado de estado_selector y lo guardamos en la lista
    }else if(selected == 'Estado del alumno'){
        var selector = document.getElementById('estado_selector');
        //Si ya fue seleccionado anteriormente este dato sustituimos el nuevo filtro de la lista de filtros
        if(filtros.includes('estado')){
            var index = filtros.indexOf("estado");
            filtro_dato[index] = selector.options[selector.selectedIndex].text.toUpperCase();
            //Si no fue seleccionado anteriormente este dato lo agregamos con un push a la lista
        }else{
            filtros.push("estado");
            filtro_dato.push(selector.options[selector.selectedIndex].text.toUpperCase());
        }

        return [filtros,filtro_dato];
    //Si se seleccionó si es becario como filtro obtenemos si es becario seleccionado de becario_selector y lo guardamos en la lista
    }else if(selected == 'Becario de UNICA'){
        var selector = documento.getElementById('becario_selector');
        //Si ya fue seleccionado anteriormente este dato sustituimos el nuevo filtro de la lista de filtros
        if(filtros.includes('becario')){
            var index = filtros.indexOf("becario");
            filtro_dato[index] = selector.options[selector.selectedIndex].text;
            //Si no fue seleccionado anteriormente este dato lo agregamos con un push a la lista
        }else{
            filtros.push('becario');
            filtro_dato.push(selector.options[selector.selectedIndex].text)
        }
    }
}