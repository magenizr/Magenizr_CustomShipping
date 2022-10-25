<?php
/**
 * Magenizr CustomShipping
 *
 * @category  Magenizr
 * @copyright Copyright (c) 2018 - 2022 Magenizr (https://agency.magenizr.com)
 * @license   https://www.magenizr.com/license Magenizr EULA
 */

namespace Magenizr\CustomShipping\Helper;

class Config extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $timezone;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $session;

    /**
     * @param \Magento\Customer\Model\Session $session
     * @var String
     */
    private $tab = 'carriers';

    /**
     * Init Constructor
     *
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone
     * @param \Magento\Customer\Model\Session $session
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Customer\Model\Session $session,
        \Magento\Framework\App\Helper\Context $context
    ) {
    
        $this->timezone = $timezone;
        $this->session = $session;

        parent::__construct($context);
    }

    /**
     * Get module configuration values from core_config_data
     *
     * @param string $setting
     * @return mixed
     */
    public function getConfig($setting)
    {
        return $this->scopeConfig->getValue(
            $this->tab . '/magenizrcustomshipping/' . $setting,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get different values from core_config_data and decide if custom shipping method is available.
     *
     * @return boolean
     */
    public function isAvailable()
    {
        $timezone = $this->timezone->getConfigTimezone();

        $date_current = date_create('now', new \DateTimeZone($timezone))
            ->getTimestamp();
        $date_start = date_create($this->getConfig('date_start'), new \DateTimeZone($timezone))
            ->getTimestamp();
        $date_end = date_create($this->getConfig('date_end'), new \DateTimeZone($timezone))
            ->getTimestamp();

        $frequency = $this->getConfig('frequency');
        $day = strtolower(date('D', $date_current));

        /**
         * Check if shipping method is actually enabled
         */
        if (!$this->getConfig('active')) {
            return false;
        }

        /**
         * Check if shipping method should be available for logged in users only
         */
        if ($this->getConfig('customer') && !$this->isCustomerLoggedIn()) {
            return false;
        }

        /**
         * Check if shipping method should be visible in backend, frontend or both
         */
        if ($this->getConfig('availability') == 'backend' && !$this->isAdmin()
            || $this->getConfig('availability') == 'frontend' && $this->isAdmin()) {
            return false;
        }

        /**
         * Check if scheduler is enabled
         */
        if ($this->getConfig('scheduler_enabled')) {

            /**
             * Check if shipping method should be visible at current name of day
             */
            if (strpos($frequency, $day) === false) {
                return false;
            }

            /**
             * Check if start date is in range
             */
            if ($date_start && $date_start > $date_current) {
                return false;
            }

            /**
             * Check if start end is in range
             */
            if ($date_end && $date_end < $date_current) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if current user logged in as admin
     *
     * @return bool
     */
    private function isAdmin()
    {
        return 'adminhtml' === $this->session->getAreaCode();
    }

    /**
     * Check if current user logged in
     *
     * @return bool
     */
    private function isCustomerLoggedIn()
    {
        return $this->session->isLoggedIn();
    }
}
