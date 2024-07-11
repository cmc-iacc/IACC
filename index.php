<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/validar.js"></script>
  <title>Agencia de Viajes</title>
</head>

<body>
<h1>Agencia de Viajes</h1>
  <?php
  include 'conexion_funciones.php';
  $Vuelos = Listarvuelos();
  $Hoteles = Listarhoteles();
  $Reservas = Listarreservas();
  $Res_consulta = Consultaavanzada();
  ?>
  <div class="container">
    <div class="">
      <h4>Registrar Vuelos</h4>
      <form action="conexion_funciones.php" method="post" class="form-buscar" onsubmit="return validar()">
        <label for="id_vuelo"> ID del vuelo: </label>
        <input type="number" id="id_vuelo" name="id_vuelo" placeholder="Ingrese el ID del vuelo">
        <label for="origen"> Ciudad de origen: </label>
        <input type="text" id="origen" name="origen" placeholder="Ingrese la ciudad origen">
        <label for="destino"> Ciudad de destino: </label>
        <input type="text" id="destino" name="destino" placeholder="Ingrese la ciudad de destino">
        <label for="fecha"> Fecha del viaje: </label>
        <input type="date" id="fecha" name="fecha">
        <label for="plaza_disponibles"> Plazas disponibles: </label>
        <input type="number" id="plaza_disponibles" name="plaza_disponibles" placeholder="Ingrese las plazas disponibles">
        <label for="precio"> Precio: </label>
        <input type="number" id="precio" name="precio" placeholder="Ingrese el precio">
        <input type="submit" class="boton" name="Btn_registrar_vuelo" value="Registrar">
      </form>
    </div>
    <div class="">
      <table>
        <h4>Lista de Vuelos </h4>
        <thead>
          <tr>
            <th>ID</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha</th>
            <th>Plazas disponibles</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Vuelos as $Vuelo) { ?>
            <tr>
              <td><?php echo $Vuelo['id_vuelo']; ?></td>
              <td><?php echo $Vuelo['origen']; ?></td>
              <td><?php echo $Vuelo['destino']; ?></td>
              <td><?php echo $Vuelo['Fecha']; ?></td>
              <td><?php echo $Vuelo['plaza_disponibles']; ?></td>
              <td><?php echo $Vuelo['precio']; ?></td>
              <td><a href="#">Editar</a> - <a href="#">Eliminar</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="">
      <h4>Registrar Hotel</h4>
      <form action="conexion_funciones.php" method="post" class="form-buscar" onsubmit="return validarhotel()">
        <label for="nombre"> Nombre del Hotel: </label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre del hotel">
        <label for="ubicacion"> Ubicación del Hotel: </label>
        <input type="text" id="ubicacion" name="ubicacion" placeholder="Ingrese la ubicación del hotel">
        <label for="habitacion"> Habitaciones Disponibles: </label>
        <input type="number" id="habitacion" name="habitacion" placeholder="Ingrese la cantidad de habitaciones">
        <label for="tarifa"> Tarifa por Noche: </label>
        <input type="number" id="tarifa" name="tarifa" placeholder="Ingrese la tarifa por noche">
        <input type="submit" class="boton" name="Btn_registrar_hotel" value="Registrar">
      </form>
    </div>
    <div class="">
      <table>
        <h4>Lista de Hoteles </h4>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>ubicación</th>
            <th>Habitaciones Disponibles</th>
            <th>Tarifa por Noche</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Hoteles as $Hotel) { ?>
            <tr>
              <td><?php echo $Hotel['id_hotel']; ?></td>
              <td><?php echo $Hotel['nombre']; ?></td>
              <td><?php echo $Hotel['ubicacion'];  ?></td>
              <td><?php echo $Hotel['habitaciones_disponible'];  ?></td>
              <td><?php echo $Hotel['tarifa_noche']; ?></td>
              <td><a href="#">Editar</a> - <a href="#">Eliminar</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="">
      <table>
        <h4>N° de Reserva por Hotel</h4>
        <thead>
          <tr>
            <th>Hotel</th>
            <th>N° de Reservas</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Res_consulta as $consulta) { ?>
            <tr>
              <td><?php echo $consulta['nombre']; ?></td>
              <td><?php echo $consulta['num_reservas']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="">
      <table>
        <h4>Lista de Reservas </h4>
        <thead>
          <tr>
            <th>ID Reserva</th>
            <th>ID Cliente</th>
            <th>Fecha de Reserva</th>
            <th>ID del Vuelo</th>
            <th>ID del Hotel</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($Reservas as $Reserva) { ?>
            <tr>
              <td><?php echo $Reserva['id_reserva']; ?></td>
              <td><?php echo $Reserva['id_cliente']; ?></td>
              <td><?php echo $Reserva['fecha_reserva'];  ?></td>
              <td><?php echo $Reserva['id_vuelo'];  ?></td>
              <td><?php echo $Reserva['id_hotel']; ?></td>
              <td><a href="#">Editar</a> - <a href="#">Eliminar</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>