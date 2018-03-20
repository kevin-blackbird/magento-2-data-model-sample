<?php

namespace Blackbird\TeacherStudents\Model\ResourceModel\Student;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Blackbird\TeacherStudents\Model;

/**
 * Class Collection
 * @package Blackbird\TeacherStudents\Model\ResourceModel\Student
 */
class Collection extends AbstractCollection
{
    /**
     * Link student model to student resource model
     */
    protected function _construct()
    {
        $this->_init(Model\Student::class, Model\ResourceModel\Student::class);
    }
}