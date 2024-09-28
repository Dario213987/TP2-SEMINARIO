<a 
{if $gestion}
    href='/gestion/libros/{$libro->isbn}'
{else}
    href='/libros/{$libro->isbn}'
{/if}
class="tile-libro">
{if $libro->ruta_de_imagen|file_exists}
    <img src="{$libro->ruta_de_imagen}">
{else}
    <img src="/img/libros/not-found.png">
{/if}    
<h3>{$libro->titulo}</h3>
    <h4>{$libro->fecha_de_publicacion|date_format:"%Y"}</h4>
</a>