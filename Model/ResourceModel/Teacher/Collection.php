<?php
/**
 * Blackbird Data Model Sample Module
 *
 * NOTICE OF LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@bird.eu so we can send you a copy immediately.
 *
 * @category    Blackbird
 * @package     Blackbird_DataModelSample
 * @copyright   Copyright (c) 2018 Blackbird (https://black.bird.eu)
 * @author      Blackbird Team
 * @license     MIT
 * @support     help@bird.eu
 */
namespace Blackbird\DataModelSample\Model\ResourceModel\Teacher;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Blackbird\DataModelSample\Model;

/**
 * Class Collection
 * @package Blackbird\DataModelSample\Model\ResourceModel\Teacher
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(Model\Teacher::class, Model\ResourceModel\Teacher::class);
    }
}
