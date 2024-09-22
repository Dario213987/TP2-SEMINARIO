{assign var="titulo" value="Autores"}
{include file="components/header.tpl"}
    {foreach from=$autores item=autor}
        {assign var="libro" value=$autor}
        {assign var="gestion" value=$gestion}
        {include file="components/tileAutor.tpl"}
    {/foreach}
{include file="components/footer.tpl"}