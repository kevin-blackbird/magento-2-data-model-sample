<?php

namespace Blackbird\TeacherStudents\Api;

/**
 * Interface StudentRepositoryInterface
 * @package Blackbird\TeacherStudents\Api
 */
interface StudentRepositoryInterface
{
    /**
     * Save a Student
     *
     * @param Data\StudentInterface $student
     * @return mixed
     */
    public function save(Data\StudentInterface $student);

    /**
     * Get Student by an Id
     *
     * @param int $studentId
     * @return mixed
     */
    public function getById($studentId);

    /**
     * Delete a Student
     *
     * @param Data\StudentInterface $student
     * @return mixed
     */
    public function delete(Data\StudentInterface $student);

    /**
     * Delete a Student by an Id
     *
     * @param $studentId
     * @return mixed
     */
    public function deleteById($studentId);
}