<?php
/**
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

namespace Magento\Backend\Test\Block\Urlrewrite\Catalog\Product;

use Magento\Backend\Test\Block\Widget\Grid as GridInterface;

/**
 * Class Grid
 * Product grid
 *
 */
class Grid extends GridInterface
{
    /**
     * Filters array mapping
     *
     * @var array
     */
    protected $filters = array(
        'id' => array(
            'selector' => '[id=productGrid_product_filter_entity_id]',
        ),
        'sku' => array(
            'selector' => '[id=productGrid_product_filter_sku]',
        ),
    );

    /**
     * Initialize block elements
     */
    protected function _init()
    {
        parent::_init();
        $this->selectItem = 'tbody tr .col-entity_id';
    }
}
