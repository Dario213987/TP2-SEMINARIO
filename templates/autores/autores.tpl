{assign var="titulo" value="Autores"}
{include file="components/header.tpl"}
    {foreach from=$autores item=autor}
        {include file="components/tileAutor.tpl"}
    {/foreach}
{include file="components/footer.tpl"}