<?php
/**
 * High-level interface for email templates data that hides format from the client code
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Email\Model\Template;

class Config
{
    /**
     * @var \Magento\Email\Model\Template\Config\Data
     */
    protected $_dataStorage;

    /**
     * @var \Magento\Framework\Module\Dir\Reader
     */
    protected $_moduleReader;

    /**
     * @param \Magento\Email\Model\Template\Config\Data $dataStorage
     * @param \Magento\Framework\Module\Dir\Reader $moduleReader
     */
    public function __construct(
        \Magento\Email\Model\Template\Config\Data $dataStorage,
        \Magento\Framework\Module\Dir\Reader $moduleReader
    ) {
        $this->_dataStorage = $dataStorage;
        $this->_moduleReader = $moduleReader;
    }

    /**
     * Retrieve unique identifiers of all available email templates
     *
     * @return string[]
     */
    public function getAvailableTemplates()
    {
        return array_keys($this->_dataStorage->get());
    }

    /**
     * Retrieve translated label of an email template
     *
     * @param string $templateId
     * @return string
     */
    public function getTemplateLabel($templateId)
    {
        return __($this->_getInfo($templateId, 'label'));
    }

    /**
     * Retrieve type of an email template
     *
     * @param string $templateId
     * @return string
     */
    public function getTemplateType($templateId)
    {
        return $this->_getInfo($templateId, 'type');
    }

    /**
     * Retrieve fully-qualified name of a module an email template belongs to
     *
     * @param string $templateId
     * @return string
     */
    public function getTemplateModule($templateId)
    {
        return $this->_getInfo($templateId, 'module');
    }

    /**
     * Retrieve full path to an email template file
     *
     * @param string $templateId
     * @return string
     */
    public function getTemplateFilename($templateId)
    {
        $module = $this->getTemplateModule($templateId);
        $file = $this->_getInfo($templateId, 'file');
        return $this->_moduleReader->getModuleDir('view', $module) . '/email/' . $file;
    }

    /**
     * Retrieve value of a field of an email template
     *
     * @param string $templateId Name of an email template
     * @param string $fieldName Name of a field value of which to return
     * @return string
     * @throws \UnexpectedValueException
     */
    protected function _getInfo($templateId, $fieldName)
    {
        $data = $this->_dataStorage->get();
        if (!isset($data[$templateId])) {
            throw new \UnexpectedValueException("Email template '{$templateId}' is not defined.");
        }
        if (!isset($data[$templateId][$fieldName])) {
            throw new \UnexpectedValueException(
                "Field '{$fieldName}' is not defined for email template '{$templateId}'."
            );
        }
        return $data[$templateId][$fieldName];
    }
}
