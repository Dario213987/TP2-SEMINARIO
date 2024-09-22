{assign var="titulo" value="Inicio"}
{include file="components/header.tpl"}
    {foreach from=$libros item=libro}
        {assign var="libro" value=$libro}
        {assign var="gestion" value=$gestion}
        {include file="components/tileLibroAutor.tpl"}
    {/foreach}
{include file="components/footer.tpl"}