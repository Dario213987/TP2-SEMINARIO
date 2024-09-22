{if $gestion}
    <a href="/gestion/autor/{$autor->id}">
{else}
    <a href="/libros/{$autor->id}">
{/if}
{if $document_root|cat:'/img/libros/'|cat:$autor->id|cat:'.png'|file_exists} 
    <img src='/img/autores/{$autor->id}.png'>
{else}
    <img src='/img/autores/not-found.png'>
{/if}
    <h3>{$autor->nombre}</h3>
</a>