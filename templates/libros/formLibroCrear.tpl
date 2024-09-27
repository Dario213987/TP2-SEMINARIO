{assign var="titulo" value="Nuevo libro"}
{include file="components/header.tpl"}
<form id="form-crear-libro" method="post" enctype="multipart/form-data" action="/gestion/libros/guardar">
    <div>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" maxlength="128"  placeholder="Título del libro">
        {if $errors&&!empty($errors["titulo"])}
            <p>*{$errors["titulo"]}</p>    
        {/if}
    </div>
    <div>
        <label for="autor">Autor:</label>
        <select name="autor" >
            {foreach from=$autores item=autor}
                <option value='{$autor->id}'>{$autor->nombre}</option>
            {/foreach}
        </select>
        {if $errors&&!empty($errors["autor"])}
            <p>*{$errors["autor"]}</p>    
        {/if}
    </div>
    <div>
        <label for="fecha_de_publicacion">Fecha de publicación:</label>
        <input type="date" name="fecha_de_publicacion" >
        {if $errors&&!empty($errors["fecha_de_publicacion"])}
            <p>*{$errors["fecha_de_publicacion"]}</p>    
        {/if}
    </div>
    <div>
        <label for="editorial">Editorial:</label>
        <input type="text" name="editorial"  maxlength="32" placeholder="Editorial del libro">
        {if $errors&&!empty($errors["editorial"])}
            <p>*{$errors["editorial"]}</p>    
        {/if}
    </div>
    <div>
        <label for="isbn">ISBN:</label>
        <input type="number" name="isbn" minlength="10" maxlength="13"  placeholder="ISBN del libro">
        {if $errors&&!empty($errors["isbn"])}
            <p>*{$errors["isbn"]}</p>    
        {/if}
    </div>
    <div>
        <label for="idioma">Idioma:</label>
        <select name="idioma" >
            {foreach from=$idiomas item=idioma}
                <option value='{$idioma->id}'>{$idioma->nombre}</option>
            {/foreach}
        </select>
        {if $errors&&!empty($errors["idioma"])}
            <p>*{$errors["idioma"]}</p>    
        {/if}
    </div>
    <div>
        <label for="">Dimensiones:</label>
        <input type="number" name="alto" min="1" max="4000" >
        mm x
        <input type="number" name="ancho" min="1" max="4000" >
        mm x
        <input type="number" name="grosor" min="1" max="4000" >
        mm

    </div>
    <div>
        <label for="peso">Peso:</label>
        <input type="number" name="peso" min="1" max="10000"  placeholder="Peso del libro">g
        {if $errors&&!empty($errors["peso"])}
            <p>*{$errors["peso"]}</p>    
        {/if}
    </div>
    <div>
        <label for="encuadernado">Encuadernado:</label>
        <select name="encuadernado" >
            <option value="Tapa dura">Tapa dura</option>
            <option value="Tapa blanda">Tapa blanda</option>
        </select>
        {if $errors&&!empty($errors["encuadernado"])}
            <p>*{$errors["encuadernado"]}</p>    
        {/if}
    </div>
    <div>
        <label for="portada">Portada:</label>
        <input type="file" name="portada"  accept=".png, image/png">
        {if $errors&&!empty($errors["portada"])}
            <p>*{$errors["portada"]}</p>    
        {/if}
    </div>
    <div>
        <label for="sinopsis">Sinopsis:</label>
        <textarea name="sinopsis" maxlength="2000" placeholder="Introduzca la sinopsis de la obra..."></textarea>
        {if $errors&&!empty($errors["sinopsis"])}
            <p>*{$errors["sinopsis"]}</p>    
        {/if}
    </div>
    <div>
        <button type="submit">Guardar</button>
    </div>
</form>
{print_r( $errors)}
{include file="components/footer.tpl"}