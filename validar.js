function validar() {
    let id_vuelo = document.getElementById('id_vuelo').value;
    let origen = document.getElementById('origen').value;
    let destino = document.getElementById('destino').value; 
    let fecha = document.getElementById('fecha').value;
    let plaza_disponibles = document.getElementById('plaza_disponibles').value;
    let precio = document.getElementById('precio').value;
    if (id_vuelo === '' || origen === '' || destino === '' || fecha === '' || plaza_disponibles === '' || precio === '') {
        alert('Por favor completa todos los campos');
        return false;
    }
    return true;
}

function validarhotel() {
    let nombre = document.getElementById('nombre').value;
    let ubicacion = document.getElementById('ubicacion').value; 
    let habitacion = document.getElementById('habitacion').value;
    let tarifa = document.getElementById('tarifa').value;
    if (nombre === '' || ubicacion === '' || habitacion === '' || tarifa === '') {
        alert('Por favor completa todos los campos');
        return false;
    }
    return true;
}

