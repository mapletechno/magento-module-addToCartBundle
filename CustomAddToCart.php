<?php
// app/code/Ahmed/Bundle/Block/CustomAddToCart.php
namespace Ahmed\Bundle\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Cart;

class CustomAddToCart extends Template
{
    protected $_productRepository;
    protected $_cart;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        Cart $cart,
        array $data = []
    ) {
        $this->_productRepository = $productRepository;
        $this->_cart = $cart;
        parent::__construct($context, $data);
    }

    public function getAddToCartUrl($product)
    {
        return $this->getUrl('checkout/cart/add', ['product' => $product->getId()]);
    }

    public function isBundleProduct($product)
    {
        return $product->getTypeId() === 'bundle';
    }
}
