<?php
include_once('conexion.php');

//para leer los datos de la base de datos 
$query_leer='SELECT * FROM colores';
$gsent= $pdo->prepare($query_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();


//agregar datos a la base de datos 
if($_POST){
    $color= $_POST['color'];
    $descripcion= $_POST['descripcion'];
    $query_insertar = 'INSERT INTO colores(color, descripcion) VALUES (?,?)';
    $sentencia_agregar =$pdo->prepare($query_insertar);
    $sentencia_agregar->execute(array($color, $descripcion));
    header('location:index.php');
}
//para mostrar los datos e la BD para editar
if($_GET){
$id=$_GET['id'];
$query_unico='SELECT * FROM colores WHERE id=?';
$gsent_unico= $pdo->prepare($query_unico);
$gsent_unico->execute(array($id));
$resultado_unico = $gsent_unico->fetch();
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous"> 
    <title>Crud PHP</title>
  </head>
  <body>
  <nav class="navbar navbar-dark bg-dark">
  <span class="navbar-brand mb-0 h1 mx-auto">CRUD CON PHP</span>
</nav>
  <div class="container mt-5 bg-danger">
  <div class="row">
    <div class="col-md-6">

      <?php foreach($resultado as $dato): ?>

      <div class="my-3 alert alert-primary alert-<?php echo $dato['color'] ?> text-uppercase" role="alert">
       <?php echo $dato['color'] ?>
       -
       <?php echo $dato['descripcion'] ?>
 
        <a href="eliminar.php?id=<?php echo $dato['id'] ?>" 
          class="float-right ml-3">
          <i class="fas fa-trash"></i>
        </a>

       <a href="index.php?id=<?php echo $dato['id'] ?>" 
          class="float-right">
          <i class="fas fa-edit"></i>
       </a>
      

        
       </div>
       <?php endforeach ?>
    </div>
       
       <div class="col-md-6">
       <?php if(!$_GET): ?>
       <form action="" method="POST" class="my-3">
       <h3>Agregar colores</h3>
       <input type="text" class="form-control" name="color">
       
       <input type="text" class="form-control mt-3" name="descripcion">
       <button type="submit" class="btn btn-primary mt-3">Agregar</button>
       </form>
       <?php endif ?>


         <!--Formulario de editar la BD-->
        <?php if($_GET): ?>
       <form method="GET" action="editar.php" class="my-3">
       <h3>Editar colores</h3>
       <input type="text" class="form-control" name="color" value="<?php echo $resultado_unico['color'] ?>">
       
       <input type="text" class="form-control mt-3" name="descripcion" value="<?php echo $resultado_unico['descripcion'] ?>">
       <input type="hidden" name="id" value="<?php echo $resultado_unico['id'] ?>">
       <button type="submit" class="btn btn-dark mt-3">Editar</button>
       </form>
       <?php endif ?>
       </div>
  </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>