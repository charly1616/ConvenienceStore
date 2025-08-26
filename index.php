
<!doctype html>
<html lang="es">

  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- Referencias para Datatables -->
      <script src= "https://code.jquery.com/jquery-3.7.1.js"></script>
      <script src= "https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.rtl.min.css" integrity="sha384-Xbg45MqvDIk1e563NLpGEulpX6AvL404DP+/iCgW9eFa2BqztiwTexswJo2jLMue" crossorigin="anonymous">
      
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <title>Taller Front</title>
  </head>

  <?php
    // Generar número aleatorio entre 1 y 20
    $randomNumber = rand(1, 20);

    $curl = curl_init(); 

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://fakestoreapi.com/products/" . $randomNumber, 
      CURLOPT_RETURNTRANSFER => true, 
      CURLOPT_FOLLOWLOCATION => true, 
      CURLOPT_ENCODING => "", 
      CURLOPT_MAXREDIRS => 10, 
      CURLOPT_TIMEOUT => 30, 
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, 
      CURLOPT_CUSTOMREQUEST => "GET", 
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl); 

    curl_close($curl); 

    if ($err) {
      echo "cURL Error #:" . $err;
      exit(1);
    }

    $objeto = json_decode($response);

?>


    <body>

      <ul class="nav justify-content-center fs-5">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ConvenienceStore/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Listado.php">Listado</a>
        </li>
      </ul>
      
      <p class="text-center fs-4">Producto Recomendado del Día</p>


          <div class="d-flex justify-content-center">
        <div class="card mb-3" style="max-width: 940px;">
          <div class="row g-0">
            <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
              <!-- image -->
              <img src="<?=$objeto->image?>" 
                  class="img-fluid rounded-start" 
                  alt="Imagen del producto">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <!-- title -->
                <h5 class="card-title"><?=$objeto->title?></h5>
                <!-- price -->
                <p class="card-text">
                  Precio: $<?=$objeto->price?>
                </p>
                <a href="Tabla.php" class="btn btn-primary">
                  <i class="fa-solid fa-eye"></i> Ver Detalles
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
    <div class="container text-center" style="width: 70%;">
        <h1>Categorias Destacadas</h1>
        <br><br>
        <div class="row align-items-center justify-content-between">

            <div class="card" style="width: 12rem;">
                
                <img src="Images/MenIcon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title">Men's clothing</h4>
                </div>
            </div>
            <div class="card" style="width: 12rem;">
                <img src="Images/WomIcon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title">Women's clothing</h4>
                </div>
            </div>
            <div class="card" style="width: 12rem;">
                <img src="Images/JewIcon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title">Jewelery and Rings</h4>
                </div>
            </div>
            <div class="card" style="width: 12rem;">
                <img src="Images/EleIcon.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title">Electronics and Devices</h4>
                </div>
            </div>
            
        </div>
    </div>
</div>


    </body>

</html>