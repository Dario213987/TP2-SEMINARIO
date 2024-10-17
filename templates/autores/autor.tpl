{assign var="titulo" value="Inicio"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-9 col-xl-9">
  <div class="d-flex flex-wrap align-content-center">
    <div class="position-relative flex-grow-0 flex-shrink-1 align-self-start mt-4">
      {if $autor->ruta_de_imagen|file_exists}
        <img src="{$autor->ruta_de_imagen}" style="object-fit: cover;">
      {else}
        <img src="/img/autores/not-found.png" style="object-fit: cover;">
      {/if}
      {if $gestion}
        <div class="position-absolute top-0 end-0 m-1">
            <a href="gestion/autores/editar/{$autor->id}"  class="text-center btn btn-primary rounded-circle m-1"><i class="fa-solid fa-pencil"></i></a>
            <a href="gestion/autores/eliminar/{$autor->id}" class="text-center btn btn-danger rounded-circle m-1"><i class="fa-solid fa-trash"></i></a>
        </div>
      {/if}
    </div>

    <div class="card flex-grow-1 border-0 mt-4" style="min-width: 150px;">
      <div class="card-body">
        <div class="card-title border-bottom mb-4" >
          <h2 class=>{$autor->nombre}</h2>
        </div>
        <p>{nl2br($autor->biografia)}</p>
      </div>
    </div>
  </div>
  <h3 class="py-4 ps-3 bg-light rounded">Obras</h3>
  <div class="d-flex flex-wrap align-items-center justify-content-center">
  {foreach from=$libros item=libro}
      {include file="components/tileLibroAnio.tpl"}
  {/foreach}
  </div>
</div>

{include file="components/footer.tpl"}