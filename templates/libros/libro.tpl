{assign var="titulo" value="Inicio"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-9 col-xl-9">
  <div class="d-flex">
    <div class="sticky-top flex-grow-0 align-self-start mt-4" style="top:1.5rem">
      {if $libro->ruta_de_imagen|file_exists}
        <img src="{$libro->ruta_de_imagen}" style="object-fit: cover;">
      {else}
        <img src="/img/libros/not-found.png" style="object-fit: cover;">
      {/if}
      {if $gestion}
        <div class="position-absolute top-0 end-0 m-1">
            <a href="gestion/libros/editar/{$libro->isbn}"  class="text-center btn btn-primary rounded-circle m-1"><i class="fa-solid fa-pencil"></i></a>
            <button onclick="confirmarEliminacion('gestion/libros/eliminar/{$libro->isbn}')" class="text-center btn btn-danger rounded-circle m-1"><i class="fa-solid fa-trash"></i></button>
        </div>
      {/if}
    </div>

    <div class="card flex-grow-1 border-0 mt-4">
      <div class="card-body">
        <div class="card-title border-bottom mb-4" >
          <h2 class=>{$libro->titulo}</h2>
          <h4><a href='{if $gestion}gestion/{/if}autores/{$libro->autor->id}' class="text-decoration-none text-body">{$libro->autor->nombre}</a> - {$libro->fecha_de_publicacion|date_format:"%Y"}</h4>
        </div>
        <p>{nl2br($libro->sinopsis)}</p>

        <h3 class="py-4 ps-3 bg-light rounded">Detalles</h3>
        <table class="table">
          <tbody>
            <tr>
              <th scope="row">Título</th>
              <td>{$libro->titulo}</td>
            </tr>
            <tr>
              <th scope="row">Idioma</th>
              <td>{$libro->idioma->nombre}</td>
            </tr>
            <tr>
              <th scope="row">Autor</th>
              <td>{$libro->autor->nombre}</td>
            </tr>
            <tr>
              <th scope="row">Fecha de publicación</th>
              <td>{$libro->fecha_de_publicacion}</td>
            </tr>
            <tr>
              <th scope="row">ISBN</th>
              <td>{$libro->isbn}</td>
            </tr>
            <tr>
              <th scope="row">Dimensiones</th>
              <td>{$libro->alto}mm x {$libro->ancho}mm x {$libro->grosor}mm</td>
            </tr>
              <th scope="row">Peso</th>
              <td>{$libro->peso}g</td>
            </tr>
              <th scope="row">Encuadernado</th>
              <td>{$libro->encuadernado}</td>
            </tr>
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
{include file="components/footer.tpl"}