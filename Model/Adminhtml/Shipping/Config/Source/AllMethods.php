<?php
/**
 * Magenizr CustomShipping
 *
 * @category    Magenizr
 * @package     Magenizr_CustomShipping
 * @copyright   Copyright (c) 2018 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
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
