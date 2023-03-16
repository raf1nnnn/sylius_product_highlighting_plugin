<?php

namespace Dotit\SyliusHighlightingPlugin\Repository;
use Sylius\Component\Core\Repository\ProductRepositoryInterface as BaseProductRepositoryInterface;

interface ProductRepositoryInterface extends BaseProductRepositoryInterface
{
    /**
     * Find products by name.
     *
     * @param string $phrase
     * @param int|null $limit
     * @return array
     */
    public function findByNamePart(string $phrase, ?int $limit = null): array;
}