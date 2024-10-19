<link rel="stylesheet" href="{$module_dir}views/css/homecategories.css">
<div class="home-categories">
    {foreach from=$categories item=category}
        <div class="category">
            <a href="{$link->getCategoryLink($category.id_category, $category.link_rewrite)}">
                <img src="{$link->getBaseLink()}img/c/{$category.id_category}.jpg" alt="{$category.name}">
                <h3>{$category.name}</h3>
            </a>
        </div>
    {/foreach}
</div>
