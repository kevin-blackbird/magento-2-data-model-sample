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
namespace Blackbird\DataModelSample\Model;

use Magento\Framework\Model\AbstractModel;
use Blackbird\DataModelSample\Api\Data\TeacherInterface;

/**
 * Class Teacher
 * @package Blackbird\DataModelSample\Model
 */
class Teacher extends AbstractModel implements TeacherInterface
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(\Blackbird\DataModelSample\Model\ResourceModel\Teacher::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->_getData(self::ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function getAge()
    {
        return $this->_getData(self::AGE);
    }

    /**
     * {@inheritdoc}
     */
    public function getClasses()
    {
        return $this->_getData(self::CLASSES);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function setAge($age)
    {
        return $this->setData(self::AGE, $age);
    }

    /**
     * {@inheritdoc}
     */
    public function setClasses($classes)
    {
        return $this->setData(self::CLASSES, $classes);
    }
}
