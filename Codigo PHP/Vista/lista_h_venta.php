<?php
    require_once("../Modelo/h_venta.php");
    require_once("../Controlador/h_ventaDAO.php");
    require_once("../Modelo/producto.php");
    require_once("../Controlador/productoDAO.php");
    require_once("../Estilo/scripts/scripts.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../Estilo/alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="../Estilo/alertifyjs/css/themes/default.min.css" />
    <link rel="stylesheet" type = "text/css" href="../Estilo/css/style_lista.css">
    <title>Historial de Ventas</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Historial de Venta</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item active">
                <a class="nav-link" href="principal.php">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST">
            <input class="form-control mr-sm-2" type="search" placeholder="Busqueda" aria-label="Search" name="busqueda">
            <select name="cat" class="form-control">
                <option value="nombre">Producto</option>
                <option value="cantidad_venta">Cantidad de Venta</option>
                <option value="total_venta">Total de Venta</option>
                <option value="fecha_venta">Fecha de Venta</option>
            </select>
            <input class="btn btn-outline-secondary my-2 my-sm-0" type="submit" value="Buscar">
        </form>
    </div>
</nav>
<div class="collapse" id="collapseNuevo">
    <div class="card card-body">
        <form method="POST" action="../Controlador/h_ventaControlador.php?a=agregar&id">
            <div class="form-row">
                <div class="col-3">
                    <input type="date" class="form-control" id="fecha_venta" name="fecha_venta"required>
                </div>
                <div class="col">
                    <input type="num" class="form-control" placeholder="Cantidad de venta" id="cantidad_venta" name="cantidad_venta"required>
                </div>
                <div class="col">
                    <input type="num" class="form-control" placeholder="Total de venta" id="total_venta" name="total_venta"required>
                </div>
                <div class="col">
                    <select name="id_producto" id="" class="form-control">
                        <?php 
                            $producto = ProductoDAO::listarProducto();
                            foreach($producto as $elemento):
                        ?>
                        <option value="<?php echo $elemento[0]?>" class="form-control"><?php echo $elemento[1]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <input class="btn btn-dark mb-2" type="submit" value="Guardar" onclick="validar()">
                </div>
            </div>
        </form>
    </div>
</div>

<form method="get">
    <table class="table" style="text-align: center">
        <thead class="thead-dark" >
            <tr >
                <th scope="col">Producto</th>
                <th scope="col">Cantidad de venta</th>
                <th scope="col" title="Informe">Total de venta</th>
                <th scope="col">Fecha de venta</th>
                <th colspan="2" scope="col" >
                    <a  data-toggle="collapse" href="#collapseNuevo" class="btn btn-dark">
                        Nuevo
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : null ;
                if($busqueda=="" || $busqueda==null)
                    $datos = HVentaDAO::listarHVenta();
               else
                    $datos = HVentaDAO::buscar($_POST["busqueda"],$_POST["cat"]);
            ?>
            <tr>
            <?php foreach($datos as $elemento):?>
                <td ><?php echo $elemento[1]?></td>
                <td ><?php echo $elemento[2]?></td>
                <td ><?php echo $elemento[3]?></td>
                <td ><?php echo $elemento[4]?></td>
                <td >
                    <a class="btn btn-outline-dark"" href="form_h_venta.php?id=<?=$elemento[0]?>">
                        Actualizar
                    </a>
                </td>
                <td>
                    <a class="btn btn-outline-dark"" href="../Controlador/h_ventaControlador.php?a=eliminar&id=<?=$elemento[0]?>" onclick="return confirm('¿Realmente quiere eliminar el dato?')">
                        Eliminar
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>
<script src="../Estilo/alertifyjs/alertify.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
function validar(){
        // Campos de texto
        if($("#fecha_venta").val() == ""){
            alertify.alert("Fecha de Venta","El campo Fecha de Venta no puede estar vacío.");
            $("#fecha_venta").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
            return false;
        }
        if($("#cantidad_venta").val() == ""){
            alertify.alert("Cantidad de Venta","El campo Cantidad de Venta no puede estar vacío.");
            $("#cantidad_venta").focus();
            return false;
        }
        if($("#total_venta").val() == ""){
            alertify.alert("Total de Venta","El campo Total de Venta no puede estar vacío.");
            $("#total_venta").focus();
            return false;
        }
        return true;  //Si todo está correcto
    }
</script>