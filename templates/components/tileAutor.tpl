{if $gestion}
    <a href="/gestion/autor/{$autor->id}">
{else}
    <a href="/libros/{$autor->id}">
{/if}
{if $autor->ruta_de_imagen|file_exists}
    <img src="{$autor->ruta_de_imagen}">
{else}
    <img src="/img/autores/not-found.png">
{/if}
    <h3>{$autor->nombre}</h3>
</a>