{assign var="titulo" value="Inicio"}
{include file="components/header.tpl"}
{if $document_root|cat:'/img/libros/'|cat:$libro->isbn|cat:'.png'|file_exists} 
     <img src='/img/libros/{$libro->isbn}.png'>
{else}
    <img src='/img/libros/not-found.jpg'>
{/if}
<div>
    <h2>{$libro->titulo}</h2>
    <h4> <a href='{if $gestion}/gestion{/if}/autores/{$libro->autor->id}'>{$libro->autor->nombre}</a> - {$libro->fecha_de_publicacion|date_format:"%Y"}</h4>
    <p>{$libro->sinopsis}</p>
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
{include file="components/footer.tpl"}