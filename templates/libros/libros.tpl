{assign var="titulo" value="Inicio"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-9 col-xl-9">
<div class="d-inline-flex flex-wrap justify-content-center">
{if $gestion}
        <div class="tile-libro card">
        <a href='/gestion/libros/crear' class="text-decoration-none d-flex justify-content-center align-items-center" style="width: 18rem; height:32rem; font-size:6rem">
            <i class="fa-solid fa-circle-plus"></i>
        </a>
    </div>    
{/if}
{foreach from=$libros item=libro}
    {include file="components/tileLibroAutor.tpl"}
{/foreach}
</div>
</div>
{include file="components/footer.tpl"}