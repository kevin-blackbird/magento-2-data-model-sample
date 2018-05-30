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

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Blackbird\DataModelSample\Api\Data;
use Blackbird\DataModelSample\Api\TeacherRepositoryInterface;

/**
 * Class TeacherRepository
 * @package Blackbird\DataModelSample\Model
 */
class TeacherRepository implements TeacherRepositoryInterface
{
    /**
     * @var \Blackbird\DataModelSample\Model\ResourceModel\Teacher
     */
    private $resourceTeacher;

    /**
     * @var \Blackbird\DataModelSample\Api\Data\TeacherInterfaceFactory
     */
    private $teacherFactory;

    /**
     * @param \Blackbird\DataModelSample\Model\ResourceModel\Teacher $resourceTeacher
     * @param \Blackbird\DataModelSample\Api\Data\TeacherInterfaceFactory $teacherFactory
     */
    public function __construct(
        ResourceModel\Teacher $resourceTeacher,
        Data\TeacherInterfaceFactory $teacherFactory
    ) {
        $this->resourceTeacher = $resourceTeacher;
        $this->teacherFactory = $teacherFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Data\TeacherInterface $teacher)
    {
        try {
            $this->resourceTeacher->save($teacher);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $teacher;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($teacherId)
    {
        $teacher = $this->teacherFactory->create();
        $this->resourceTeacher->load($teacher, $teacherId);
        if (!$teacher->getId()) {
            throw new NoSuchEntityException(__('Teacher with id "%1" does not exist', $teacherId));
        }
        return $teacher;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Data\TeacherInterface $teacher)
    {
        try {
            $this->resourceTeacher->delete($teacher);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }

        return $teacher;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($teacherId)
    {
        return $this->delete($this->getById($teacherId));
    }
}
