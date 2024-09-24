{if $gestion}
    <a href='/gestion/libros/{$libro->isbn}'>
{else}
    <a href='/libros/{$libro->isbn}'>
{/if}
{if $document_root|cat:'/img/libros/'|cat:$libro->isbn|cat:'.png'|file_exists} 
    <img src='/img/libros/{$libro->isbn}.png'>
{else}
    <img src='/img/libros/not-found.png'>
{/if}
    <h3>{$libro->titulo}</h3>
    <h4>{$libro->autor->nombre}</h4>
</a>