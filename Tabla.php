<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php

$curl = curl_init(); //inicia la sesión cURL

curl_setopt_array($curl, array(
	CURLOPT_URL => "http://localhost/apieventos/getclientes.php", //url a la que se conecta
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


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" data-bs-whatever="@mdo"><i class="fa-solid fa-user-plus"></i></button>

<?php
    include("add.php");
?>
<?php include("Edit.php");?>




<table class="table table-striped table-hover" id="TablaClientes">
    <thead>
        <th>ID</th>
        <th>NOMBRES</th>
        <th>TELEFONO</th>
        <th>CORREO</th>
        <th>ACCION</th>
    </thead>
    <tbody>

    <?php
        foreach ($objeto as $reg){
            ?>

            <tr>
                <td> <?=$reg->id?> </td>
                <td> <?=$reg->nombres." ".$reg->apellidos?> </td>
                <td> <?=$reg->telefono?> </td>
                <td> <?=$reg->correo?> </td>
                <td> 
                    <button type="button" class="btn btn-danger" onclick="Eliminar(<?=$reg->id?>);"> <i class="fa-solid fa-user-minus"></i></button>
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-whatever="@mdo"
                        onclick="Editar(<?=$reg->id?>, '<?=$reg->nombres?>', '<?=$reg->apellidos?>', '<?=$reg->telefono?>', '<?=$reg->direccion?>', '<?=$reg->correo?>');">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                </td>
            </tr>

            <?php
        }

    ?>

    

    </tbody>
    <tfoot>
        <th>ID</th>
        <th>NOMBRES</th>
        <th>TELEFONO</th>
        <th>CORREO</th>
    </tfoot>
</table>


<script>
    async function Eliminar(id){

        Swal.fire({
            title: "¿¿Seguro que quieres eliminar?? a "+id+" O.o",
            text: "No podras recuperarlo",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si eliminar"
        }).then((result) => {
                if (result.isConfirmed) {


                    const response = fetch("http://localhost/apieventos/deleteCliente.php", {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body:  JSON.stringify({"id": id})})
                    .then(()=>{
                        
                        Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"})
                    .then(()=>{
                        location.reload();
                    })
                })
            }});
    }

    function Editar(id, noms, aps, tels,dir, corr){

        document.getElementById("editid").value = id;
        document.getElementById("editnombres").value = noms;
        document.getElementById("editapellidos").value = aps;
        document.getElementById("editcorreo").value = corr;
        document.getElementById("edittelefono").value = tels;
        document.getElementById("editdireccion").value = dir;

    }
</script>


<script>
   $(document).ready( function () {
        $('#TablaClientes').DataTable();
    } );
</script>  


