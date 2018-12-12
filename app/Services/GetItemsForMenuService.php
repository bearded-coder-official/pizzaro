<?php

namespace App\Services;

use App\Menu;

final class GetItemsForMenuService
{
    public function getMenus()
    {
        return Menu::all();
    }
}