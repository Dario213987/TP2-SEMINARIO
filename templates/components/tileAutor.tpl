<div class="tile-autor position-relative">
    <a href='{if $gestion}gestion/{/if}autores/{$autor->id}' class="text-decoration-none">
        <div class="card" style="width: 18rem; height:18rem;">
            {if $autor->ruta_de_imagen|file_exists}
                <img src="{$autor->ruta_de_imagen}" class="card-img-top" style="object-fit: cover; min-height:14rem; width:100%">
            {else}
                <img src="/img/autores/not-found.png" class="card-img-top" style="object-fit: cover; min-height:14rem; width:100%">
            {/if}
        <div class="card-body">
            <h5 class="card-title text-truncate">{$autor->nombre}</h5>
        </div>
        </div>
    </a>
    {if $gestion}
        <div class="position-absolute top-0 end-0 m-1">
            <a href="gestion/autores/editar/{$autor->id}" class="text-center btn btn-primary rounded-circle m-1"><i class="fa-solid fa-pencil"></i></a>
            <button onclick="confirmarEliminacion('gestion/autores/eliminar/{$autor->id}')" class="text-center btn btn-danger rounded-circle m-1"><i class="fa-solid fa-trash"></i></button>
        </div>
    {/if}
</div>

