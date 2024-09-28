{assign var="titulo" value="Nuevo autor"}
{include file="components/header.tpl"}
<form id="form-crear-autor" method="post" enctype="multipart/form-data" action="/gestion/autores/guardar">
    <div>
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" maxlength="64" placeholder="Nombre del autor"
        {if $oldValues && !empty($oldValues["nombre"])}
        value="{$oldValues['nombre']}"
        {/if}
        >
        {if $errors&&!empty($errors["nombre"])}
            <p>*{$errors["nombre"]}</p>    
        {/if}
    </div>
    <div>
        <label for="biografia">Biografia:</label>
        <textarea name="biografia" maxlength="2000" placeholder="Introduzca una breve biografia del autor..."></textarea>
        {if $errors&&!empty($errors["biografia"])}
            <p>*{$errors["biografia"]}</p>    
        {/if}
    </div>
    <div>
        <label for="foto">Foto:</label>
        <input type="file" name="foto"  accept=".png, image/png">
        {if $errors&&!empty($errors["foto"])}
            <p>*{$errors["foto"]}</p>    
        {/if}
    </div>
    <div>
        <button type="submit">Guardar</button>
    </div>
</form>
{print_r( $errors)}
{include file="components/footer.tpl"}