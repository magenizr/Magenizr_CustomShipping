<?php
/**
 * Magenizr CustomShipping
 *
 * @category    Magenizr
 * @package     Magenizr_CustomShipping
 * @copyright   Copyright (c) 2018 Magenizr (http://www.magenizr.com)
 * @license     http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

namespace Magenizr\CustomShipping\Model\Plugin\Shipping\Rate\Result;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Rate\Result;

class Remove
{

    /**
     * @var \Magenizr\CustomShipping\Helper\Config
     */
    private $helper;

    /**
     * @param Helper $helper
     */
    public function __construct(
        \Magenizr\CustomShipping\Helper\Config $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Validate each shipping method before append and apply the rules action if validation was successful.
     *
     * @param \Magento\Shipping\Model\Rate\Result $subject
     * @param \Magento\Quote\Model\Quote\Address\RateResult\AbstractResult|\Magento\Shipping\Model\Rate\Result $result
     * @return array
     */
    public function beforeAppend($subject, $result)
    {
        if (!$result instanceof \Magento\Quote\Model\Quote\Address\RateResult\Method) {
            return [$result];
        }

        // Only if feature is enabled and custom shipping available
        if ($this->helper->getConfig('hide_enabled') && $this->helper->isAvailable()) {
            $hideMethods = explode(',', $this->helper->getConfig('hide_carriers'));

            $code = $result->getCarrier() . '_' . $result->getMethod();

            if (in_array($code, $hideMethods)) {
                $result->setIsDisabled(true);
            }
        }

        return [$result];
    }
}
