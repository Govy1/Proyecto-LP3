<?php
    //include ("../Controllers/ctrl_productos.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../JavaScript/ajax_producto.js" type="text/javascript"></script>
    <title>Productos</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Productos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="principal.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Busqueda" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>

<div class="collapse" id="collapseActualizar">
    <div class="card card-body">
        <form>
            <div class="form-row">
                <div class="col-7">
                    <input type="text" class="form-control" placeholder="RUC">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
    
<div class="collapse" id="collapseNuevo">
    <div class="card card-body">
        <form method="POST" id="frNewprdt">
            <div class="form-row">
                <div class="col-7">
                    <input type="text" class="form-control" placeholder="Nombre" name="nom">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Stock" name="stk">
                </div>
                <div class="col">
                    <input type="date" class="form-control" placeholder="Fecha de Vencimiento" name="fv">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Precio de Venta" name="pv">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary mb-2" id="btnnuevo" onclick="AgregarPrdt()">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<form method="get">
    <table class="table" >
        <thead class="thead-dark" >
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Stock</th>
                <th scope="col">Fecha de Vencimiento</th>
                <th scope="col">Precio de Venta</th>
                <th colspan="2" scope="col" >
                    <p>
                        <a class="btn btn-dark" href="form_producto.php" role="button">
                            Nuevo
                        </a>
                    </p >
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($array_producto as $elemento):?>
            <tr>
            <td ><?php echo $elemento['nombre']?></td>
            <td ><?php echo $elemento['stock']?></td>
            <td ><?php echo $elemento['fecha_vencimiento']?></td>
            <td ><?php echo $elemento['precio_venta']?></td>
            <td >
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseActualizar" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Actualizar
                    </a>
                </p >
            </td>
            <td>
                <a href="principal.php?Id=<?php echo $elemento['id_distribuidor']?>">Eliminar</a>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>