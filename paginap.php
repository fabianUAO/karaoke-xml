<!DOCTYPE html>
<html>
<head>
    <title>Karaoke</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css">

    <style>
        #miBoton {
          padding: 30px;
          background: light-gray;
          color: black;
        }
        #miBoton:hover {
          padding: 30px;
          background: blue;
          color: white;
        }
        #miBoton:active {
          padding: 30px;
          background: red;
          color: white;
        }
    </style>

</head>
<body>

    <?php
        $Mesa = $_GET["id"];
    ?>
    <div class="container">
        <div class="row">

                <div class="col-12" id="box" style="width: 200%; height: 800%; text-align: center;">
                 <!-- cambiar el estado de la mesa de ocupado a desocupado en el xml -->
                 <form action="desvalidar.php" method="post">
                    <input hidden type="text" name="idvuelta" value= <?php echo $Mesa ?>>
                    <button type="submit" value="Enviar datos!">Desocupar Mesa</button>
                </form>
                    <?php

                        $cambioestado = simplexml_load_file("mesas.xml");
                        foreach ($cambioestado as $key => $value) {
                            if ($value[id]==$Mesa) {
                                echo $value [estado];
                            }
                        }

                        echo "<h1> .: Karaoke Mesa ".$Mesa." :. </h1>";
                        echo "<br><hr><br>";

                        echo "<h2> .: Lista de Canciones:. </h2>";
                        echo "<br><hr><br>";

                    $canciones = simplexml_load_file("canciones.xml");
                    echo "<table class='table table-striped table-bordered table-hover'>
                            <thead>
                                <tr>
                                <th>Pistas</th>
                                <th>Nombre</th>
                                <th>Artista</th>
                                <th>Genero</th>
                                <th>Agregar</th>
                                </tr>
                            </thead>
                            <tbody>";

                    foreach ($canciones as $cancion) {
                        echo "<tr>";
                        echo "<td>".$cancion['id']."</td>";
                        echo "<td>" .$cancion->nombre. "</td>";
                        echo "<td>".$cancion->artista."</td>";
                        echo "<td>" .$cancion->genero. "</td>";
                        echo "<td><button type='button' class='btn btn-success'
                        onclick='guardarxml(".$cancion['id'].",".$Mesa.")';>Agregar</button></td>";
                        echo "</tr>";

                    }
                    echo "</tbody></table>";
                ?>
                </div>


        </div>
    </div>
</body>
</html>

<script src="js/jquery-3.4.1.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/localization/messages_es.js"></script>
    <script src="js/datatables.min.js"></script>



<script type="text/javascript">
function guardarxml(id,mesa){
  $.ajax({
            type: "POST",
            dataType: 'html',
            url: "guardarPedido.php",
            data: "id="+id+"&mesa="+mesa,
            success: function(resp){
                alert("Listo");
            }
        });
}
</script>
