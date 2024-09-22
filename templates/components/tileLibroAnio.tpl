{if $gestion}
    <a href='/gestion/libros/{$libro->isbn}'>
{else}
    <a href='/libros/{$libro->isbn}'>
{/if}
{if $document_root|cat:'/img/libros/'|cat:$libro->isbn|cat:'.png'|file_exists} 
    <img src='/img/libros/{$libro->isbn}.png'>
{else}
    <img src='/img/libros/not-found.jpg'>
{/if}
    <h3>{$libro->titulo}</h3>
    <h4>{$libro->fecha_de_publicacion|date_format:"%Y"}</h4>
</a>