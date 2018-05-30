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
 * Interface StudentRepositoryInterface
 * @package Blackbird\DataModelSample\Api
 */
interface StudentRepositoryInterface
{
    /**
     * Save a Student
     *
     * @param \Blackbird\DataModelSample\Api\Data\StudentInterface $student
     * @return \Blackbird\DataModelSample\Api\Data\StudentInterface
     */
    public function save(Data\StudentInterface $student);

    /**
     * Get Student by an Id
     *
     * @param int $studentId
     * @return \Blackbird\DataModelSample\Api\Data\StudentInterface
     */
    public function getById($studentId);

    /**
     * Delete a Student
     *
     * @param \Blackbird\DataModelSample\Api\Data\StudentInterface $student
     * @return bool
     */
    public function delete(Data\StudentInterface $student);

    /**
     * Delete a Student by an Id
     *
     * @param int $studentId
     * @return bool
     */
    public function deleteById($studentId);
}
