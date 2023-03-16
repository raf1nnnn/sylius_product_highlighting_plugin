<?php

namespace Dotit\SyliusHighlightingPlugin\Menu;

use Dotit\SyliusHighlightingPlugin\Entity\ProductHighlightingInterface;
use Dotit\SyliusHighlightingPlugin\Event\ProductHighlightingFormMenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
class ProductHighlightingFormMenuBuilder
{
    private FactoryInterface $factory;
    private EventDispatcherInterface $eventDispatcher; public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher)
{
    $this->factory = $factory;
    $this->eventDispatcher = $eventDispatcher;
}

    public function createMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if (!array_key_exists('product_highlighting', $options) || !$options['product_highlighting'] instanceof ProductHighlightingInterface) {
            return $menu;
        }

        $menu
            ->addChild('details')
            ->setAttribute('template', '@DotitSyliusHighlightingPlugin/Admin/product_highlighting/Tab/_details.html.twig')
            ->setLabel('sylius.ui.details')
            ->setCurrent(true)
        ;




        $this->eventDispatcher->dispatch(
            new ProductHighlightingFormMenuBuilderEvent($this->factory, $menu, $options['product_highlighting'])
        );

        return $menu;
    }
}