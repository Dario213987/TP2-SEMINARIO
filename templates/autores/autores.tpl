{assign var="titulo" value="Autores"}
{include file="components/header.tpl"}
<div class="col-12 col-md-10 col-lg-9 col-xl-9">
    <div class="d-flex flex-wrap align-items-center justify-content-center">
        {if $gestion}
            <div class="tile-autor card">
                <a href='/gestion/autores/crear' class="text-decoration-none d-flex justify-content-center align-items-center" style="width: 18rem; height:18rem; font-size:6rem">
                    <i class="fa-solid fa-circle-plus"></i>
                </a>
            </div>    
        {/if}
        {foreach from=$autores item=autor}
            {include file="components/tileAutor.tpl"}
        {/foreach}
    </div>
</div>
{include file="components/footer.tpl"}