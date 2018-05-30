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
namespace Blackbird\DataModelSample\Api;

/**
 * Interface TeacherRepositoryInterface
 * @package Blackbird\DataModelSample\Api
 */
interface TeacherRepositoryInterface
{
    /**
     * Save a Teacher
     *
     * @param \Blackbird\DataModelSample\Api\Data\TeacherInterface $teacher
     * @return \Blackbird\DataModelSample\Api\Data\TeacherInterface
     */
    public function save(Data\TeacherInterface $teacher);

    /**
     * Get Teacher by an Id
     *
     * @param int $teacherId
     * @return \Blackbird\DataModelSample\Api\Data\TeacherInterface
     */
    public function getById($teacherId);

    /**
     * Delete a Teacher
     *
     * @param \Blackbird\DataModelSample\Api\Data\TeacherInterface $teacher
     * @return bool
     */
    public function delete(Data\TeacherInterface $teacher);

    /**
     * Delete a Teacher by an Id
     *
     * @param int $teacherId
     * @return bool
     */
    public function deleteById($teacherId);
}
