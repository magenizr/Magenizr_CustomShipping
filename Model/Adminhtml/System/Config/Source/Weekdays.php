<?php
/**
 * Magenizr CustomShipping
 *
 * @category  Magenizr
 * @copyright Copyright (c) 2018 - 2022 Magenizr (https://agency.magenizr.com)
 * @license   https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\CustomShipping\Model\Adminhtml\System\Config\Source;

class Weekdays implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var Array
     */
    private $data = [];

    /**
     * Get weekdays
     *
     * @return array
     */
    public function getWeekdays()
    {
        return $this->data = [
            'mon' => __('Monday'),
            'tue' => __('Tuesday'),
            'wed' => __('Wednesday'),
            'thu' => __('Thursday'),
            'fri' => __('Friday'),
            'sat' => __('Saturday'),
            'sun' => __('Sunday')
        ];
    }

    /**
     * Return array of options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $data = [];

        foreach ($this->getWeekdays() as $key => $value) {
            $data[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        return $data;
    }
}
