@if ($departamento != 'DSA')
    <h6 class="alumnos-departamento">Alumnos de la {{$departamento}} - Inscritos</h6>
@else


    <h5 class="tipo-dato">Filtro por Datos</h5>
    <h6>Filtro por division:</h6>
    <div class="container-checkbox">
        <div class="form-check-box">
            <div class="checkbox-wrapper-13">
                <input class="form-check-input" type="checkbox" id="DSA" name="DSA" value="DSA" onclick="getSelected()">
            </div>
            <label class="option-select" for="DSA">DSA</label>
        </div>
        <div class="form-check-box">
            <div class="checkbox-wrapper-13">
                <input class="form-check-input" type="checkbox" id="DID" name="DID" value="DID" onclick="getSelected()">
            </div>
            <label class="option-select" for="DID">DID</label>
        </div>
        <div class="form-check-box">
            <div class="checkbox-wrapper-13">
                <input class="form-check-input" type="checkbox" id="DSC" name="DSC" value="DSC" onclick="getSelected()">
            </div>
            <label class="option-select" for="DSC">DSC</label>
        </div>
        <div class="form-check-box">
            <div class="checkbox-wrapper-13">
                <input class="form-check-input" type="checkbox" id="DROS" name="DROS" value="DROS" onclick="getSelected()">
            </div>
            <label class="form-check-label" for="DROS">DROS</label>
        </div>
        <div class="form-check-box">
            <div class="checkbox-wrapper-13">
                <input class="form-check-input" type="checkbox" id="Salas" name="Salas" value="Salas" onclick="getSelected()">
            </div>
            <label class="form-check-label" for="Salas">Salas</label>
        </div>
    </div>
@endif
