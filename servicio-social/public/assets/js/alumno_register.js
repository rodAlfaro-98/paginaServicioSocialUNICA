function vistaEspecificacion(){
    if(document.getElementById('genero_selector').value == "Otro") {
        document.getElementById('especificacion').style.display = "block";
    }else{
        document.getElementById('especificacion').style.display = "none";
        document.getElementById('especificacion_genero').value = null;
    }
}
function internoEspecificacion(){
    if(document.getElementById('procedencia_externo').checked){
        document.getElementById('especificacion_externo').style.display = "block";
    }else{
        document.getElementById('especificacion_externo').style.display = "none";
    }
    if(document.getElementById('procedencia_interno').checked){
        document.getElementById('especificacion_interno').style.display = "block";
    }else{
        document.getElementById('especificacion_interno').style.display = "none";
    }
}