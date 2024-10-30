{assign var="titulo" value="Editar libro"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-7 col-xl-6 my-5">
    <div class="card shadow-lg rounded-4">
        <h2 class="text-center pt-3">Editar libro</h2>
        <form id="form-editar-libro" class="p-4" method="POST" enctype="multipart/form-data" action="/gestion/libros/modificar">
            <input type="hidden" name="old_isbn" value="{$libro->isbn}">
            <div class="mb-3">
                <label class="form-label" for="titulo">Título:</label>
                <input type="text" class="form-control {if $errors&&!empty($errors["titulo"])}is-invalid{/if}" name="titulo" placeholder="Título del libro" value="{$oldValues['titulo']|default:$libro->titulo}">
                {if $errors&&!empty($errors["titulo"])}
                    <p class="invalid-feedback">*{$errors["titulo"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label {if $errors&&!empty($errors["autor"])}is-invalid{/if}" for="autor">Autor:</label>
                <select class="form-select" name="autor">
                <option value=''>Seleccione el autor</option>
                    {foreach from=$autores item=autor}
                        <option value='{$autor->id}'
                            {if isset($oldValues["autor"])&&$autor->id==$oldValues["autor"]}
                                selected
                            {elseif $autor->id==$libro->autor->id}
                                selected
                            {/if}
                        >{$autor->nombre}</option>
                    {/foreach}
                </select>
                {if $errors&&!empty($errors["autor"])}
                    <p class="invalid-feedback">*{$errors["autor"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="fecha_de_publicacion">Fecha de publicación:</label>
                <input type="date" class="form-control {if $errors&&!empty($errors["fecha_de_publicacion"])}is-invalid{/if}" name="fecha_de_publicacion" value="{$oldValues['fecha_de_publicacion']|default:$libro->fecha_de_publicacion}">
                {if $errors&&!empty($errors["fecha_de_publicacion"])}
                    <p class="invalid-feedback">*{$errors["fecha_de_publicacion"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="editorial">Editorial:</label>
                <input type="text" class="form-control {if $errors&&!empty($errors["editorial"])}is-invalid{/if}" name="editorial" placeholder="Editorial del libro" value="{$oldValues['editorial']|default:$libro->editorial}">
                {if $errors&&!empty($errors["editorial"])}
                    <p class="invalid-feedback">*{$errors["editorial"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="isbn">ISBN:</label>
                <input type="number" class="form-control {if $errors&&!empty($errors["isbn"])}is-invalid{/if}" name="isbn" placeholder="ISBN del libro" value="{$oldValues["isbn"]|default:$libro->isbn}">
                {if $errors&&!empty($errors["isbn"])}
                    <p class="invalid-feedback">*{$errors["isbn"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="idioma">Idioma:</label>
                <select class="form-select {if $errors&&!empty($errors["idioma"])}is-invalid{/if}" name="idioma">
                    <option value=''>Seleccione el idioma</option>
                    {foreach from=$idiomas item=idioma}
                        <option value='{$idioma->id}' 
                        {if !isset($oldValues["idioma"])&&$idioma->id==$libro->idioma->id}
                            selected
                        {elseif isset($oldValues["idioma"])&&$idioma->id==$oldValues["idioma"]}
                            selected
                        {/if}
                        >{$idioma->nombre}</option>
                    {/foreach}
                </select>
                {if $errors&&!empty($errors["idioma"])}
                    <p class="invalid-feedback">*{$errors["idioma"]}</p>    
                {/if}
            </div>
            <div class="mb-3 row">
                <label class="form-label" for="">Dimensiones:</label>
                <div class="d-flex align-items-center">
                    <input type="number" class="form-control mx-1 {if $errors&&!empty($errors["alto"])}is-invalid{/if}" name="alto" value="{$oldValues["alto"]|default:$libro->alto}">
                    x
                    <input type="number" class="form-control mx-1 {if $errors&&!empty($errors["ancho"])}is-invalid{/if}" name="ancho" value="{$oldValues["ancho"]|default:$libro->ancho}">
                    x
                    <input type="number" class="form-control mx-1 {if $errors&&!empty($errors["grosor"])}is-invalid{/if}" name="grosor" value="{$oldValues["grosor"]|default:$libro->grosor}">
                    mm
                </div>
                {if $errors&&!empty($errors["alto"])}
                    <p class="invalid-feedback">*{$errors["alto"]}</p>    
                {elseif $errors&&!empty($errors["ancho"])}
                    <p class="invalid-feedback">*{$errors["ancho"]}</p>    
                {elseif $errors&&!empty($errors["grosor"])}
                    <p class="invalid-feedback">*{$errors["grosor"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="peso">Peso:</label>
                <input type="number" class="form-control {if $errors&&!empty($errors["peso"])}is-invalid{/if}" name="peso" placeholder="Peso del libro" value="{$oldValues["peso"]|default:$libro->peso}">g
                {if $errors&&!empty($errors["peso"])}
                    <p class="invalid-feedback">*{$errors["peso"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="encuadernado">Encuadernado:</label>
                <select class="form-control {if $errors&&!empty($errors["encuadernado"])}is-invalid{/if}" name="encuadernado">
                    <option value=''>Seleccione el encuadernado</option>
                    <option value="Tapa dura" {if $libro->encuadernado == "Tapa dura"}selected{/if}>Tapa dura</option>
                    <option value="Tapa blanda" {if $libro->encuadernado == "Tapa blanda"}selected{/if}>Tapa blanda</option>
                </select>
                {if $errors&&!empty($errors["encuadernado"])}
                    <p class="invalid-feedback">*{$errors["encuadernado"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="portada">Portada:</label>
                <input type="file" class="form-control {if $errors&&!empty($errors["portada"])}is-invalid{/if}" name="portada" accept=".png, image/png, .jpg, image/jpg, .webp, image/webp">
                {if $errors&&!empty($errors["portada"])}
                    <p class="invalid-feedback">*{$errors["portada"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="sinopsis">Sinopsis:</label>
                <textarea class="form-control {if $errors&&!empty($errors["sinopsis"])}is-invalid{/if}" name="sinopsis" placeholder="Introduzca la sinopsis de la obra...">{$oldValues["sinopsis"]|default:$libro->sinopsis}</textarea>
                {if $errors&&!empty($errors["sinopsis"])}
                    <p class="invalid-feedback">*{$errors["sinopsis"]}</p>    
                {/if}
            </div>
            <div class="d-flex justify-content-evenly">
                <button class="btn btn-secondary">Cancelar</button>
                <button type="submit" class="btn btn-primary ms-5">Guardar</button>
            </div>
        </form>
    </div>
</div>
{include file="components/footer.tpl"}