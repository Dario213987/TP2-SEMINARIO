{assign var="titulo" value="Autores"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-9 col-xl-9">
    <div class="d-flex flex-wrap align-items-center justify-content-center">
        {foreach from=$autores item=autor}
            {include file="components/tileAutor.tpl"}
        {/foreach}
    </div>
</div>
{include file="components/footer.tpl"}