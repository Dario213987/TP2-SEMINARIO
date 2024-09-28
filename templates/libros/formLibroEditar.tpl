{assign var="titulo" value="Editar libro"}
{include file="components/header.tpl"}
<form id="form-editar-libro" method="post" enctype="multipart/form-data" action="/gestion/libros/modificar">
    <div>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" placeholder="Título del libro" value="{$oldValues["titulo"]|default:$libro->titulo}">
        {if $errors&&!empty($errors["titulo"])}
            <p class="error">*{$errors["titulo"]}</p>    
        {/if}
    </div>
    <div>
        <label for="autor">Autor:</label>
        <select name="autor" >
            {foreach from=$autores item=autor}
                <option value='{$autor->id}'
                    {if !isset($oldValues["autor"])&&$autor->id==$libro->autor->id}
                        selected
                    {elseif $oldValues["autor"]&&$autor->id==$oldValues["autor"]}
                        selected
                    {/if}
                >{$autor->nombre}</option>
            {/foreach}
        </select>
        {if $errors&&!empty($errors["autor"])}
            <p class="error">*{$errors["autor"]}</p>    
        {/if}
    </div>
    <div>
        <label for="fecha_de_publicacion">Fecha de publicación:</label>
        <input type="date" name="fecha_de_publicacion" value="{$oldValues['fecha_de_publicacion']|default:$libro->fecha_de_publicacion}">
        {if $errors&&!empty($errors["fecha_de_publicacion"])}
            <p class="error">*{$errors["fecha_de_publicacion"]}</p>    
        {/if}
    </div>
    <div>
        <label for="editorial">Editorial:</label>
        <input type="text" name="editorial" placeholder="Editorial del libro" value="{$oldValues['editorial']|default:$libro->editorial}">
        {if $errors&&!empty($errors["editorial"])}
            <p class="error">*{$errors["editorial"]}</p>    
        {/if}
    </div>
    <div>
        <label for="isbn">ISBN:</label>
        <input type="number" name="isbn" placeholder="ISBN del libro" value="{$oldValues["isbn"]|default:$libro->isbn}">
        {if $errors&&!empty($errors["isbn"])}
            <p class="error">*{$errors["isbn"]}</p>    
        {/if}
    </div>
    <div>
        <label for="idioma">Idioma:</label>
        <select name="idioma" >
            {foreach from=$idiomas item=idioma}
                <option value='{$idioma->id}'
                {if !isset($oldValues["idioma"])&&$idioma->id==$libro->idioma->id}
                    selected
                {elseif $oldValues["idioma"]&&$idioma->id==$oldValues["idioma"]}
                    selected
                {/if}
                >{$idioma->nombre}</option>
            {/foreach}
        </select>
        {if $errors&&!empty($errors["idioma"])}
            <p class="error">*{$errors["idioma"]}</p>    
        {/if}
    </div>
    <div>
        <label for="">Dimensiones:</label>
        <input type="number" name="alto" value="{$oldValues["alto"]|default:$libro->alto}">
        x
        <input type="number" name="ancho" value="{$oldValues["ancho"]|default:$libro->ancho}">
        x
        <input type="number" name="grosor" value="{$oldValues["grosor"]|default:$libro->grosor}">
        mm
        {if $errors&&!empty($errors["alto"])}
            <p class="error">*{$errors["alto"]}</p>    
        {elseif $errors&&!empty($errors["ancho"])}
            <p class="error">*{$errors["ancho"]}</p>    
        {elseif $errors&&!empty($errors["grosor"])}
            <p class="error">*{$errors["grosor"]}</p>    
        {/if}
    </div>
    <div>
        <label for="peso">Peso:</label>
        <input type="number" name="peso" placeholder="Peso del libro" value="{$oldValues["peso"]|default:$libro->peso}">g
        {if $errors&&!empty($errors["peso"])}
            <p class="error">*{$errors["peso"]}</p>    
        {/if}
    </div>
    <div>
        <label for="encuadernado">Encuadernado:</label>
        <select name="encuadernado" >
            <option value="Tapa dura">Tapa dura</option>
            <option value="Tapa blanda">Tapa blanda</option>
        </select>
        {if $errors&&!empty($errors["encuadernado"])}
            <p class="error">*{$errors["encuadernado"]}</p>    
        {/if}
    </div>
    <div>
        <label for="portada">Portada:</label>
        <input type="file" name="portada"  accept=".png, image/png, .jpg, image/jpg, .webp, image/webp">
        {if $errors&&!empty($errors["portada"])}
            <p class="error">*{$errors["portada"]}</p>    
        {/if}
    </div>
    <div>
        <label for="sinopsis">Sinopsis:</label>
        <textarea name="sinopsis" placeholder="Introduzca la sinopsis de la obra...">
            {$oldValues["sinopsis"]|default:$libro->sinopsis}">
        </textarea>
        {if $errors&&!empty($errors["sinopsis"])}
            <p class="error">*{$errors["sinopsis"]}</p>    
        {/if}
    </div>
    <div>
        <button type="submit">Guardar</button>
    </div>
</form>
{include file="components/footer.tpl"}