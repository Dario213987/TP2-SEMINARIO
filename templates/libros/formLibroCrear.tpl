{assign var="titulo" value="Nuevo libro"}
{include file="components/header.tpl"}
<form id="form-crear-libro" method="post" enctype="multipart/form-data" action="/gestion/libros/guardar">
    <div>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" maxlength="128" required placeholder="Título del libro">
    </div>
    <div>
        <label for="autor">Autor:</label>
        <select name="autor" required>
            {foreach from=$autores item=autor}
                <option value='{$autor->id}'>{$autor->nombre}</option>
            {/foreach}
        </select>
    </div>
    <div>
        <label for="fecha_de_publicacion">Fecha de publicación:</label>
        <input type="date" name="fecha_de_publicacion" required>
    </div>
    <div>
        <label for="editorial">Editorial:</label>
        <input type="text" name="editorial" required maxlength="32" placeholder="Editorial del libro">
    </div>
    <div>
        <label for="isbn">ISBN:</label>
        <input type="number" name="isbn" minlength="10" maxlength="13" required placeholder="ISBN del libro">
    </div>
    <div>
        <label for="idioma">Idioma:</label>
        <select name="autor" required>
            {foreach from=$idiomas item=idioma}
                <option value='{$idioma->id}'>{$idioma->nombre}</option>
            {/foreach}
        </select>
    </div>
    <div>
        <label for="">Dimensiones:</label>
        <input type="number" name="alto" min="1" max="4000" required>
        mm x
        <input type="number" name="ancho" min="1" max="4000" required>
        mm x
        <input type="number" name="grosor" min="1" max="4000" required>
        mm
    </div>
    <div>
        <label for="peso">Peso:</label>
        <input type="number" name="peso" min="1" max="10000" required placeholder="Peso del libro">g
    </div>
    <div>
        <label for="encuadernado">Encuadernado:</label>
        <select name="encuadernado" required>
            <option value="Tapa dura">Tapa dura</option>
            <option value="Tapa blanda">Tapa blanda</option>
        </select>
    </div>
    <div>
        <label for="portada">Portada:</label>
        <input type="file" name="portada" required accept=".png, image/png">
    </div>
    <div>
        <label for="sinopsis">Sinopsis:</label>
        <textarea name="sinopsis" maxlength="2000" placeholder="Introduzca la sinopsis de la obra..."></textarea>
    </div>
</form>
{include file="components/footer.tpl"}