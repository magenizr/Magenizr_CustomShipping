<?php
/**
 * Magenizr CustomShipping
 *
 * @category  Magenizr
 * @copyright Copyright (c) 2018 - 2022 Magenizr (https://agency.magenizr.com)
 * @license   https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\CustomShipping\Block\Adminhtml\System\Config\Field;

class DatePicker extends \Magento\Config\Block\System\Config\Form\Field
{

    private const TEMPLATE_DATEPICKER = 'system/config/field/datepicker.phtml';

    /**
     * Set template
     *
     * @return mixed
     */
    protected function _prepareLayout()
    {
        $this->setTemplate(static::TEMPLATE_DATEPICKER);

        return parent::_prepareLayout();
    }

    /**
     * Return element html
     *
     * @param  \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $this->addData([
                'html_id' => $element->getHtmlId()
            ]);

        return $element->getElementHtml() . $this->toHtml();
    }
}
