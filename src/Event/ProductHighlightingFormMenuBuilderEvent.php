<?php

namespace Dotit\SyliusHighlightingPlugin\Event;

use Dotit\SyliusHighlightingPlugin\Entity\ProductHighlightingInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

class ProductHighlightingFormMenuBuilderEvent extends MenuBuilderEvent
{
    private ProductHighlightingInterface $productHighlighting;

    public function __construct(FactoryInterface $factory, ItemInterface $menu, ProductHighlightingInterface $productHighlighting)
    {
        parent::__construct($factory, $menu);

        $this->productHighlighting = $productHighlighting;
    }

    public function getVendor(): ProductHighlightingInterface
    {
        return $this->productHighlighting;
    }
}