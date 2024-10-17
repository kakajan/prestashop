<div class="home-categories">
    {foreach from=$categories item=category}
        <div class="category">
            <a href="{$link->getCategoryLink($category.id_category, $category.link_rewrite)}">
                <img src="{$link->getCatImageLink($category.link_rewrite, $category.id_image)}" alt="{$category.name}">
                <h3>{$category.name}</h3>
            </a>
        </div>
    {/foreach}
</div>
