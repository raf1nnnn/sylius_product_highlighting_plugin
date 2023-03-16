<?php

namespace Dotit\SyliusHighlightingPlugin\Block;
use Sonata\BlockBundle\Event\BlockEvent;
use Sonata\BlockBundle\Model\Block;
class ProductHighlightingJsBlockListener
{
    public function onBlockEvent(BlockEvent $event): void
    {
        $template = '@DotitSyliusHighlightingPlugin/Admin/product_highlighting/_product_highlighting_js.html.twig';

        $block = new Block();
        $block->setId(uniqid('', true));
        $block->setSettings(array_replace($event->getSettings(), [
            'template' => $template,
        ]));
        $block->setType('sonata.block.service.template');

        $event->addBlock($block);
    }
}