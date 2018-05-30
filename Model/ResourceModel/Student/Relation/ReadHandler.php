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
namespace Blackbird\DataModelSample\Model\ResourceModel\Student\Relation;

use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use Blackbird\DataModelSample\Model\ResourceModel\Student;

/**
 * Class ReadHandler
 * @package Blackbird\DataModelSample\Model\ResourceModel\Student\Relation
 */
class ReadHandler implements ExtensionInterface
{
    /**
     * @var \Magento\Framework\EntityManager\MetadataPool
     */
    private $metadataPool;

    /**
     * @var Student
     */
    private $resourceStudent;

    /**
     * ReadHandler constructor.
     * @param MetadataPool $metadataPool
     * @param Student $resourceStudent
     */
    public function __construct(
        MetadataPool $metadataPool,
        Student $resourceStudent
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceStudent = $resourceStudent;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getIdStudent()) {
            $studentTeacherId = $this->resourceStudent->lookupTeacherIds((int)$entity->getIdStudent());
            $entity->setData('id_teacher', $studentTeacherId);
        }
        return $entity;
    }
}
