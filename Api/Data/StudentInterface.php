<?php

namespace Blackbird\TeacherStudents\Api\Data;

/**
 * Interface StudentInterface
 * @api
 */
interface StudentInterface
{
    const ID    = 'id_student';
    const NAME  = 'name';
    const AGE  = 'age';

    /**
     * Get Student ID
     *
     * @return int mixed
     */
    public function getId();

    /**
     * Get Student Name
     *
     * @return string
     */
    public function getName();

    /**
     * Get Student Age
     *
     * @return int
     */
    public function getAge();

    /**
     * Set Student ID
     *
     * @param int $id
     * @return mixed
     */
    public function setId($id);

    /**
     * Set Student Name
     *
     * @param string $name
     * @return mixed
     */
    public function setName($name);

    /**
     * Set Student Age
     *
     * @param int $age
     * @return mixed
     */
    public function setAge($age);
}