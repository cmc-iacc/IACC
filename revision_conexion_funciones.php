<?php
function ConectarBD(){
    $Servidor = "localhost";
    $Usuario = "root";
    $Password = "";
    $BaseDatos = "agencia";

    $Conexion = new mysqli($Servidor, $Usuario, $Password, $BaseDatos);
    if ($Conexion->connect_error){
        die("Conexion fallida:".$Conexion->connect_error);
    }
    return $Conexion;
}

function Agregarvuelo($id_vuelo, $origen, $destino, $fecha, $plaza_disponibles, $precio){
    $Conexion = ConectarBD();

    $Insertar = $Conexion->prepare("INSERT INTO vuelo (id_vuelo, origen, destino, Fecha, plaza_disponibles, precio) VALUES (?, ?, ?, ?, ?, ?)");
    $Insertar->bind_param("isssii", $id_vuelo, $origen, $destino, $fecha, $plaza_disponibles, $precio);

    if ($Insertar->execute()) {
        $Insertar->close();
        mysqli_close($Conexion);
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $Insertar->error;
        $Insertar->close();
        mysqli_close($Conexion);
    }
}

function Listarvuelos(){
    $Conexion = ConectarBD();

    $Listar = "SELECT * FROM vuelo";
    $Resultado = mysqli_query($Conexion, $Listar);
    $Vuelos = array();
    if (mysqli_num_rows($Resultado) > 0) {
        while ($Filas = mysqli_fetch_assoc($Resultado)) {
            $Vuelos[] = $Filas;
        }
    } else {
        echo "No hay registros de vuelos que mostrar";
    }
    mysqli_close($Conexion);
    return $Vuelos;
}

function Agregarhotel($nombre, $ubicacion, $habitacion, $tarifa){
    $Conexion = ConectarBD();

    $Insertarhotel = $Conexion->prepare("INSERT INTO hotel (nombre, ubicacion, habitaciones_disponible, tarifa_noche) VALUES (?, ?, ?, ?)");
    $Insertarhotel->bind_param("ssii", $nombre, $ubicacion, $habitacion, $tarifa);

    if ($Insertarhotel->execute()) {
        $Insertarhotel->close();
        mysqli_close($Conexion);
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $Insertarhotel->error;
        $Insertarhotel->close();
        mysqli_close($Conexion);
    }
}

function Listarhoteles(){
    $Conexion = ConectarBD();

    $Listar = "SELECT * FROM hotel";
    $Resultado = mysqli_query($Conexion, $Listar);
    $Hoteles = array();
    if (mysqli_num_rows($Resultado) > 0) {
        while ($Filas = mysqli_fetch_assoc($Resultado)) {
            $Hoteles[] = $Filas;
        }
    } else {
        echo "No hay registros de hoteles que mostrar";
    }
    mysqli_close($Conexion);
    return $Hoteles;
}

function Listarreservas(){
    $Conexion = ConectarBD();

    $Listar = "SELECT * FROM reserva";
    $Resultado = mysqli_query($Conexion, $Listar);
    $Reservas = array();
    if (mysqli_num_rows($Resultado) > 0) {
        while ($Filas = mysqli_fetch_assoc($Resultado)) {
            $Reservas[] = $Filas;
        }
    } else {
        echo "No hay registros de reservas que mostrar";
    }
    mysqli_close($Conexion);
    return $Reservas;
}

function Consultaavanzada(){
    $Conexion = ConectarBD();

    $Consulta = "SELECT h.nombre, COUNT(r.id_reserva) as num_reservas
    FROM hotel h
    INNER JOIN reserva r ON h.id_hotel = r.id_hotel
    GROUP BY h.id_hotel
    HAVING COUNT(r.id_reserva) > 2";
    
    $Resultado = mysqli_query($Conexion, $Consulta);
    $Res_consulta = array();
    if (mysqli_num_rows($Resultado) > 0 ){
        while ($Filas = mysqli_fetch_assoc($Resultado)){
            $Res_consulta[] = $Filas;
        }
    } else {
        echo "No hay registros";
    }
    mysqli_close($Conexion);
    return $Res_consulta;
}

if(isset($_POST["Btn_registrar_vuelo"])){
    $id_vuelo = $_POST['id_vuelo'];
    $origen = $_POST["origen"];
    $destino = $_POST["destino"];
    $fecha = $_POST["fecha"];
    $plaza_disponibles = $_POST["plaza_disponibles"];
    $precio = $_POST["precio"];
    Agregarvuelo($id_vuelo, $origen, $destino, $fecha, $plaza_disponibles, $precio);
}

if(isset($_POST["Btn_registrar_hotel"])){
    $nombre = $_POST["nombre"];
    $ubicacion = $_POST["ubicacion"];
    $habitacion = $_POST["habitacion"];
    $tarifa = $_POST["tarifa"];
    Agregarhotel($nombre, $ubicacion, $habitacion, $tarifa);
}
?>
