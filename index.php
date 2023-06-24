<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php

$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
$conexion = new PDO('mysql:host=localhost;dbname=recuperacion_0907-22-22489', 'root', '', $pdo_options);

if (isset($_POST["accion"])){
    
    if($_POST["accion"] == "Crear"){
        $insert = $conexion->prepare("INSERT INTO producto (codigo,nombre,precio, existencia) VALUES
        (:codigo,:nombre,:precio,:existencia)");
        $insert->bindValue('codigo', $_POST['codigo']);
        $insert->bindValue('nombre', $_POST['nombre']);
        $insert->bindValue('precio', $_POST['precio']);
        $insert->bindValue('existencia', $_POST['existencia']);
        $insert->execute();
    }
}
if (isset($_POST["accion"])){
   
    if($_POST["accion"] == "Crear"){
        $update = $conexion->prepare("UPDATE producto SET nombre=:nombre, precio=:precio,
        existencia=:existencia WHERE codigo=:codigo");
        $update->bindValue('codigo', $_POST['codigo']);
        $update->bindValue('nombre', $_POST['nombre']);
        $update->bindValue('precio', $_POST['precio']);
        $update->bindValue('existencia', $_POST['existencia']);
        $update->execute();
       
    }
}


$select = $conexion->query("SELECT codigo, nombre, precio, existencia FROM producto");

?>

<?php if(isset($_POST["accion"]) && $_POST["accion"] == "Editar") { ?>
<form method="POST">
    <input type="text" name="codigo" value="<?php echo $_POST["codigo"] ?>" placeholder="Ingresa el codigo"/>
    <input type="text" name="nombre" placeholder="Ingresa el nombre"/>
    <input type="text" name="precio" placeholder="Ingresa el precio"/>
    <input type="text" name="existencia" placeholder="Ingresa la existencia"/>
    <input type="hidden" name="accion" value="Editado"/>
    <button type="submit">Guardar</button>
</form>
<?php } else { ?>
    <form method="POST">
    <input type="text" name="codigo" placeholder="Ingresa el codigo"/>
    <input type="text" name="nombre" placeholder="Ingresa el nombre"/>
    <input type="text" name="precio" placeholder="Ingresa el precio"/>
    <input type="text" name="existencia" placeholder="Ingresa la existencia"/>
    <input type="hidden" name="accion" value="Crear"/>
    <button type="submit">Crear</button>
</form>
    <?php } ?>

<table>
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($select->fetchAll() as $producto) { ?>
        <tr>
            <td> <?php echo $producto["codigo"] ?> </td>
            <td> <?php echo $producto["nombre"] ?> </td>
            <td> <?php echo $producto["precio"] ?> </td>
            <td> <?php echo $producto["existencia"] ?> </td>
            <td> <form method="POST" >  
                <button type="submit">Editar</button>
                <input type="hidden" name="accion" value="Editar"/>
                <input type="hidden" name="codigo" value="<?php echo $producto["codigo"] ?>"/>
        </form> 
         </td>
        </tr>
            <?php } ?>
    </tbody>
</table>
</body>
</html>