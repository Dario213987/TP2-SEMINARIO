{assign var="titulo" value="Nuevo autor"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-7 col-xl-6 my-5">
    <div class="card shadow-lg rounded-4">
        <h2 class="text-center pt-3">Nuevo autor</h2>
        <form id="form-crear-autor" class="p-4" method="POST" enctype="multipart/form-data" action="/gestion/autores/guardar">
            <div class="mb-3">
                <label class="form-label" for="nombre">Nombre completo:</label>
                <input type="text" class="form-control {if $errors&&!empty($errors["nombre"])}is-invalid{/if}" name="nombre" placeholder="Nombre completo del autor" value="{$oldValues['titulo']|default:''}">
                {if $errors&&!empty($errors["nombre"])}
                    <p class="invalid-feedback">*{$errors["nombre"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="portada">Foto:</label>
                <input type="file" class="form-control {if $errors&&!empty($errors["foto"])}is-invalid{/if}" name="foto" accept=".png, image/png, .jpg, image/jpg, .webp, image/webp">
                {if $errors&&!empty($errors["foto"])}
                    <p class="invalid-feedback">*{$errors["foto"]}</p>    
                {/if}
            </div>
            <div class="mb-3">
                <label class="form-label" for="biografia">Biografia:</label>
                <textarea class="form-control {if $errors&&!empty($errors["biografia"])}is-invalid{/if}" name="biografia" placeholder="Introduzca la biografia del autor...">{$oldValues["sinopsis"]|default:''}</textarea>
                {if $errors&&!empty($errors["biografia"])}
                    <p class="invalid-feedback">*{$errors["biografia"]}</p>    
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