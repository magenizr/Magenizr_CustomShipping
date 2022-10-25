<?php
/**
 * Magenizr CustomShipping
 *
 * @category  Magenizr
 * @copyright Copyright (c) 2018 - 2022 Magenizr (https://agency.magenizr.com)
 * @license   https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\CustomShipping\Model\Plugin\Shipping\Rate\Result;

class FilteredRates
{

    /**
     * Remove flagged shipping method
     *
     * @param \Magento\Shipping\Model\Rate\Result $subject
     * @param array $result
     * @return array
     */
    public function afterGetAllRates($subject, $result)
    {
        foreach ($result as $key => $rate) {
            if ($rate->getIsDisabled()) {
                unset($result[$key]);
            }
        }

        return $result;
    }
}
