{assign var="titulo" value="Inicio"}
{include file="components/header.tpl"}
    <div class="libros-feed">
    {foreach from=$libros item=libro}
        {include file="components/tileLibroAutor.tpl"}
    {/foreach}
    </div>
{include file="components/footer.tpl"}