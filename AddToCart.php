<?php

namespace Ahmed\Bundle\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\View\Element\Template;

class AddToCart extends Template
{
    protected $productRepository;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function getProduct()
    {
        $productId = $this->getData('product_id');
        if ($productId) {
            return $this->productRepository->getById($productId);
        }
        return null;
    }
}
