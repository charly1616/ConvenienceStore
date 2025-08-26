<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.rtl.min.css" integrity="sha384-Xbg45MqvDIk1e563NLpGEulpX6AvL404DP+/iCgW9eFa2BqztiwTexswJo2jLMue" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
 <body>
    <ul class="nav justify-content-center fs-5">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ConvenienceStore/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Listado.php">Listado</a>
        </li>
      </ul>
 </body>
<?php

$curl = curl_init(); //inicia la sesión cURL

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://fakestoreapi.com/products", //url a la que se conecta
	CURLOPT_RETURNTRANSFER => true, //devuelve el resultado como una cadena del tipo curl_exec
	CURLOPT_FOLLOWLOCATION => true, //sigue el encabezado que le envíe el servidor
	CURLOPT_ENCODING => "", // permite decodificar la respuesta y puede ser"identity", "deflate", y "gzip", si está vacío recibe todos los disponibles.
	CURLOPT_MAXREDIRS => 10, // Si usamos CURLOPT_FOLLOWLOCATION le dice el máximo de encabezados a seguir
	CURLOPT_TIMEOUT => 30, // Tiempo máximo para ejecutar
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, // usa la versión declarada
	CURLOPT_CUSTOMREQUEST => "GET", // el tipo de petición, puede ser PUT, POST, GET o Delete dependiendo del servicio
)); //curl_setopt_array configura las opciones para una transferencia cURL

$response = curl_exec($curl);// respuesta generada
$err = curl_error($curl); // muestra errores en caso de existir

curl_close($curl); // termina la sesión 

if ($err) {
	echo "cURL Error #:" . $err;
    exit(1);
}

$objeto = json_decode($response);
?>


<h1>Listado de Productos</h1>


<table class="table table-striped table-hover" id="TablaClientes">
    <thead>
        <th>ID</th>
        <th>TITULO</th>
        <th>PRECIO</th>
        <th>CATEGORIA</th>
        <th>VER MAS</th>
    </thead>
    <tbody>
<?php foreach ($objeto as $reg): ?>
    <tr>
        <td><?=$reg->id?></td>
        <td><?=$reg->title?></td>
        <td>$<?=$reg->price?></td>
        <td><?=$reg->category?></td>
        <td>
            <!-- Botón que abre el modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto<?=$reg->id?>">
                <i class="fa-solid fa-eye"></i> Ver Detalles
            </button>
        </td>
    </tr>

    <!-- Modal dinámico -->
    <div class="modal fade" id="modalProducto<?=$reg->id?>" tabindex="-1" aria-labelledby="modalProductoLabel<?=$reg->id?>" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
          <!-- Header -->
          <div class="modal-header">
            <h5 class="modal-title" id="modalProductoLabel<?=$reg->id?>"><?=$reg->title?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          
          <!-- Body -->
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4 text-center">
                <img src="<?=$reg->image?>" alt="<?=$reg->title?>" class="img-fluid">
              </div>
              <div class="col-md-8">
                <p><strong>Precio:</strong> $<?=$reg->price?></p>
                <p><strong>Categoría:</strong> <?=$reg->category?></p>
                <p><strong>Descripción:</strong> <?=$reg->description?></p>
                <p><strong>Rating:</strong> ⭐ <?=$reg->rating->rate?> (<?=$reg->rating->count?> reseñas)</p>
              </div>
            </div>
          </div>
          
          <!-- Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
<?php endforeach; ?>
</tbody>

</table>



<script>
   $(document).ready( function () {
        $('#TablaClientes').DataTable();
    } );
</script>  


