<?php

namespace Dotit\SyliusHighlightingPlugin\Menu;

use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        /** @var ItemInterface $item */
        $item = $menu->getChild('catalog');
        if (null == $item) {
            $item = $menu;
        }

        $item->addChild('product highlights', ['route' => 'dotit_sylius_highlighting_plugin_admin_product_highlighting_index'])
            ->setLabel('dotit_sylius_highlighting_plugin.menu.admin.products_highlighting')
            ->setLabelAttribute('icon', 'bullhorn');
    }
}
