<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>TP4 - Grupo 8</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    iframe {
      width: 100%;
      height: 800px;
      border: none;
    }
  </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Grupo 8</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../View/pages/consignas.php">Consignas</a></li>
                <li class="nav-item"><a class="nav-link" href="../View/pages/test.php">Test</a></li>
            </ul>
            </div>
        </div>
    </nav>

    <!--Main -->
    <main class="container text-center" style="margin-top: 100px;">
        <div class="container mt-5">
            <?php
                include_once (__DIR__ . '../../configuracion.php');
                include_once (__DIR__ . '../../Controller/controller_persona.php');
                include_once (__DIR__ . '../../Controller/controller_auto.php');
                include_once (__DIR__ . '../../Util/funciones.php');

                echo "<br>----------------------------------------------------------------------------------<br><br>";
                echo "<h3>TEST DE AUTO</h3>";
                echo "<br>----------------------------------------------------------------------------------<br>";

                $objAuto = new Auto();
                $objAuto->setear('AB 054 NX', 'Renault', '2017', '46404056');

                ///////////////////////////////
                ///    PROBANDO INSERTAR   ///
                /////////////////////////////
                if ($objAuto->insertar()) {
                    echo "<br>Auto insertado correctamente.";
                    verEstructura($objAuto);
                } else {
                    echo "<br>Error al insertar: " . $objAuto->getMensajeOperacion();
                }

                echo "<br>----------------------------------------------------------------------------------<br>";

                ///////////////////////////////
                ///    PROBANDO MODIFICAR   ///
                /////////////////////////////
                $objAuto->setMarca("MarcaModificada");
                $objAuto->setModelo("ModeloModificado");

                if ($objAuto->modificar()) {
                    echo "<br>Auto modificado correctamente.";
                    verEstructura($objAuto);
                } else {
                    echo "<br>Error al modificar: " . $objAuto->getMensajeOperacion();
                }

                echo "<br>----------------------------------------------------------------------------------<br>";

                ///////////////////////////////
                ///    PROBANDO ELIMINAR   ///
                /////////////////////////////
                if ($objAuto->eliminar()) {
                    echo "<br>Auto eliminado correctamente.";
                    verEstructura($objAuto);
                } else {
                    echo "<br>Error al eliminar: " . $objAuto->getMensajeOperacion();
                }

                echo "<br>----------------------------------------------------------------------------------<br>";

                ///////////////////////////////
                ///    PROBANDO SELECT   ///
                /////////////////////////////
                $objAbmAuto = new AbmAuto();
                $lista = $objAbmAuto->buscar(null);

                if (count($lista) > 0) {
                    echo "<br>Se encontraron " . count($lista) . " autos:";
                    foreach ($lista as $a) {
                        echo "<pre>";
                        print_r($a);
                        echo "</pre>";
                    }
                } else {
                    echo "<br>No se encontraron autos.";
                }

                echo "<br>----------------------------------------------------------------------------------<br>";
                ?>
        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <h5>Integrantes del Grupo 8</h5>
            <ul class="list-unstyled mb-3">
                <li>Abril Gavilan - Legajo: FAI-5163 - abril.gavilan@est.fi.uncoma.edu.ar</li>
                <li>Lucas San Segundo - Legajo: FAI- - lucas.sansegundo@est.fi.uncoma.edu.ar</li>
                <li>Joaquín Castillo - Legajo: FAI- - joaquin.castillo@est.fi.uncoma.edu.ar</li>
            </ul>
            <small>TP4 PHP & MySQL | Facultad de Informática</small>
        </div>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
