{assign var="titulo" value="Inicio"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-9 col-xl-9">
    <div class="d-flex flex-wrap align-items-center justify-content-center">
    {foreach from=$libros item=libro}
        {include file="components/tileLibroAutor.tpl"}
    {/foreach}
    </div>
</div>
{include file="components/footer.tpl"}