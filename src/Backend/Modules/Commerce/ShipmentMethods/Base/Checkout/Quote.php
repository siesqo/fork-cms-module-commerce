<?php

namespace Backend\Modules\Commerce\ShipmentMethods\Base\Checkout;

use Backend\Modules\Commerce\Domain\Cart\Cart;
use Backend\Modules\Commerce\Domain\OrderAddress\OrderAddress;
use Backend\Modules\Commerce\Domain\Vat\VatRepository;
use Common\Core\Model;
use Common\ModulesSettings;
use Frontend\Core\Language\Language;
use Frontend\Core\Language\Locale;

abstract class Quote
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Cart
     */
    protected $cart;

    /**
     * @var OrderAddress
     */
    protected $address;

    /**
     * @var ModulesSettings
     */
    protected $settings;

    /**
     * @var Language
     */
    protected $language;

    /**
     * Quote constructor.
     *
     * @param string $name
     * @param Cart $cart
     * @param OrderAddress $address
     */
    public function __construct(string $name, Cart $cart, OrderAddress $address)
    {
        $this->name = $name;
        $this->cart = $cart;
        $this->address = $address;
        $this->settings = Model::get('fork.settings');
        $this->language = Locale::frontendLanguage();
    }

    /**
     * Get a setting
     *
     * @param string $key
     * @param mixed $defaultValue
     * @param boolean $includeLanguage
     *
     * @return mixed
     */
    protected function getSetting(string $key, $defaultValue = null, $includeLanguage = true)
    {
        $baseKey = $this->name;

        if ($includeLanguage) {
            $baseKey .= '_'. $this->language->getLocale();
        }

        return $this->settings->get('Commerce', $baseKey .'_'. $key, $defaultValue);
    }

    /**
     * Get the quote based on our shipment data. A quote can return multiple options.
     *
     * @return array
     */
    abstract public function getQuote(): array;

    /**
     * Calculate the vat price based on the given price
     *
     * @param float $price
     *
     * @return array
     */
    abstract protected function getVatPrice(float $price): array;

    /**
     * Get the vat repository
     *
     * @return VatRepository
     */
    protected function getVatRepository(): VatRepository
    {
        return Model::get('commerce.repository.vat');
    }
}
