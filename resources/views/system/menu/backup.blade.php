function renderMenu($menu)
{
    echo '<li class="expandable">';
    echo '<div class="hitarea expandable-hitarea"></div>';
    echo '<strong><a href="?menuId=' .
        $menu->id .
        '" style="color:black">' .
        $menu->title_eng .
        '</a>
        <a href="" style="color: green; background:none"><i class="fa fa-pen"></i></a>
        <a href="" style="color: red; background:none"><i class="fa fa-trash"></i></a>
        </strong>';
    echo '</p>';
    if ($menu->children->isNotEmpty()) {
        echo '<ul style="display: none;">';
        foreach ($menu->children as $child) {
            renderMenu($child);
        }
        echo '</ul>';
    }
    echo '</li>';
}