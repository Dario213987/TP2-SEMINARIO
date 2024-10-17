
<div class="tile-libro position-relarive">
    <a href='{if $gestion}gestion/{/if}libros/{$libro->isbn}' class="text-decoration-none">
        <div class="card" style="width: 18rem; height:32rem">
            {if $libro->ruta_de_imagen|file_exists}
                <img src="{$libro->ruta_de_imagen}" class="card-img-top" style="object-fit: cover; min-height:27rem; width:100%">
            {else}
                <img src="/img/libros/not-found.png" class="card-img-top" style="object-fit: cover; min-height:27rem; width:100%">
            {/if}
        <div class="card-body">
            <h5 class="card-title text-truncate">{$libro->titulo}</h5>
            <p class="card-text text-truncate">{$libro->autor->nombre}</p>
        </div>
        </div>
    </a>
    {if $gestion}
        <div class="position-absolute top-0 end-0 m-1">
            <a href="gestion/libros/editar/{$libro->isbn}"  class="text-center btn btn-primary rounded-circle me-1 mt-1"><i class="fa-solid fa-pencil"></i></a>
            <a href="gestion/libros/eliminar/{$libro->isbn}" class="text-center btn btn-danger rounded-circle me-1 mt-1"><i class="fa-solid fa-trash"></i></a>
        </div>
    {/if}
</div>