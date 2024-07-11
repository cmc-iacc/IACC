<?php
function ConectarBD(){
    $Servidor = "localhost";
    $Usuario = "root";
    $Password = "";
    $BaseDatos = "agencia";
    
    $Conexion = mysqli_connect($Servidor, $Usuario, $Password, $BaseDatos);
    if ($Conexion->connect_error){
        die("Conexion fallida:".$Conexion->connect_error);
    }
    return $Conexion;
}

function Agregarvuelo($id_vuelo, $origen, $destino, $fecha, $plaza_disponibles, $precio){
    $Conexion = ConectarBD();

    $Insertar = "INSERT INTO vuelo (id_vuelo, origen, destino, Fecha, plaza_disponibles, precio) 
    VALUES ('$id_vuelo','$origen', '$destino', '$fecha', '$plaza_disponibles', '$precio')";
    mysqli_query($Conexion, $Insertar);
    mysqli_close($Conexion);

    header("Location: index.php");
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
        return $Vuelos;
    } else {
        echo "No hay resgistros de vuelos que mostrar";
        mysqli_close($Conexion);
    }
}

function Agregarhotel($nombre, $ubicacion, $habitacion, $tarifa){
    $Conexion = ConectarBD();

    $Insertarhotel = "INSERT INTO hotel (nombre, ubicacion, habitaciones_disponible, tarifa_noche) 
    VALUES ('$nombre', '$ubicacion', '$habitacion', '$tarifa')";
    mysqli_query($Conexion, $Insertarhotel);
    mysqli_close($Conexion);

    header("Location: index.php");
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
        return $Hoteles;
    } else {
        echo "No hay resgistros de vuelos que mostrar";
        mysqli_close($Conexion);
    }
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
        return $Reservas;
    } else {
        echo "No hay resgistros de vuelos que mostrar";
        mysqli_close($Conexion);
    }
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
        return $Res_consulta;
    } else {
        echo "No hay resgistros";
        mysqli_close($Conexion);
    }

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
