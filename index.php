<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="css/estilos.css">

    <title>CRUD con PHP, PDO, Ajax y Datatable.js</title>
  </head>
  <body>
    
    <div class="container fondo">
        <h1 class="text-center">CRUD con PHP, PDO, Ajax y Datatable.js</h1>
    </div>

    <div class="row">
        <div class="col-2 offset-10">
            <div class="text-center">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalUsuario" id="botonCrear">
              <i class="bi bi-plus-circle-fill"></i> Agregar
            </button>
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="table-responsive tbl">
      <table id="datos_productos" class="table table-bordered table-striped tbli">
        <thead>
          <tr>
            <th>Id</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Crear</th>
            <th>Borrar</th>
          </tr>
        </thead>
      </table>
    </div>

<!-- Modal -->
<div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Productos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
        <!-- enctype="multipart/form/data"  esto se usa para subir imagenes en un formulario -->
        <form method="post" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-body">
                <label for="nombre">Ingrese el Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control">
                <br>

                <label for="codigo">Ingrese el Codigo</label>
                <input type="text" name="codigo" id="codigo" class="form-control">
                <br>

                <label for="precio">Ingrese el Precio</label>
                <input type="text" name="precio" id="precio" class="form-control">
                <br>

                <label for="imagen_producto">Seleccione una Imagen</label>
                <input type="File" name="imagen_producto" id="imagen_producto" class="form-control">
                <span id="imagen-subida"></span>

              </div>
              <div class="modal-footer">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="operacion" id="operacion">
                <input type="submit" name="action" id="action" class="btn btn-success" value="Crear">
              </div>
          </div>
        </form>
      
      
    </div>
  </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-1.13.7/datatables.min.js"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#botonCrear").click(function(){
          $("#formulario")[0].reset();
          $(".modal-title").text("Crear Usuario");
          $("#action").val("Crear");
          $("#operacion").val("Crear");
          $("#imagen_subida").html();
        });

        var dataTable = $("#datos_productos").DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
            url: "obtener_registros.php",
            type: "POST"
          },
          "columnsDefs":[
            {
              "targets":[0, 2],
              "orderable":false,
              "searchable":false
            }
          ]
        });
      });

      $(document).on('submit', '#formulario', function(event){
        event.preventDefault();
        var codigos =$("#codigo").val();
        var nombres =$("#nombre").val();
        var precios =$("#precio").val();
        var extension =$("#imagen_producto").val().split('.').pop().toLowerCase();

        if (extension != ''){
          if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
            alert("Formato de imagen invalido");
          $("#imagen_producto").val('');
            return false;
        }
      
      if (codigos != '' && nombres != '' && precios != ''){
        $.ajax({
          url: "crear.php",
          method: "POST",
          data: new FormData(this),
          contentType:false,
          processData:false,
          success:function(data){
            alert(data);
            $('#formulario')[0].reset();
            $('#modalUsuario').modal('hide');
            dataTable.ajax.reload();
          }
        });
      }else{
        alert("Algunos campos son obligatorios")
      }
    })
      
    </script>
  </body>
</html>