<?php

namespace Blackbird\TeacherStudents\Model\ResourceModel\Teacher;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Blackbird\TeacherStudents\Model;

/**
 * Class Collection
 * @package Blackbird\TeacherStudents\Model\ResourceModel\Teacher
 */
class Collection extends AbstractCollection
{
    /**
     * Link student model to student resource model
     */
    protected function _construct()
    {
        $this->_init(Model\Teacher::class, Model\ResourceModel\Teacher::class);
    }
}