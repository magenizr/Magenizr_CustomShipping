<?php
/**
 * Magenizr CustomShipping
 *
 * @category  Magenizr
 * @copyright Copyright (c) 2018 - 2022 Magenizr (https://agency.magenizr.com)
 * @license   https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\CustomShipping\Model\Adminhtml\Shipping\Config\Source;

class AllMethods implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Framework\App\Config
     */
    private $shippingConfig;

    /**
     * @var \Magento\Shipping\Model\Config
     */
    private $scopeConfig;

    /**
     * Init Constructor
     *
     * @param \Magento\Framework\App\Config $scopeConfig
     * @param \Magento\Shipping\Model\Config $shippingConfig
     */
    public function __construct(
        \Magento\Framework\App\Config $scopeConfig,
        \Magento\Shipping\Model\Config $shippingConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->shippingConfig = $shippingConfig;
    }

    /**
     * Return array of options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $carriers = $this->shippingConfig->getActiveCarriers();
        $methods = [];

        foreach ($carriers as $carrierCode => $carrierModel) {
            if (!$carrierMethods = $carrierModel->getAllowedMethods()) {
                continue;
            }

            $title = $this->scopeConfig->getValue('carriers/' . $carrierCode . '/title');

            foreach ($carrierMethods as $methodCode => $method) {
                $code = $carrierCode . '_' . $methodCode;

                if ($code == 'magenizrcustomshipping_magenizrcustomshipping') {
                    continue;
                }

                $methods[] = [
                    'label' => $title,
                    'value' => $code
                ];
            }
        }

        return $methods;
    }
}
