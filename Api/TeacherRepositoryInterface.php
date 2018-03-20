<?php

namespace Blackbird\TeacherStudents\Api;

/**
 * Interface TeacherRepositoryInterface
 * @package Blackbird\TeacherStudents\Api
 */
interface TeacherRepositoryInterface
{
    /**
     * Save a Teacher
     *
     * @param Data\TeacherInterface $teacher
     * @return mixed
     */
    public function save(Data\TeacherInterface $teacher);

    /**
     * Get Teacher by an Id
     *
     * @param int $teacherId
     * @return mixed
     */
    public function getById($teacherId);

    /**
     * Delete a Teacher
     *
     * @param Data\TeacherInterface $teacher
     * @return mixed
     */
    public function delete(Data\TeacherInterface $teacher);

    /**
     * Delete a Teacher by an Id
     *
     * @param $teacherId
     * @return mixed
     */
    public function deleteById($teacherId);
}