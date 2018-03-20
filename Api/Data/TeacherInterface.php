<?php

namespace Blackbird\TeacherStudents\Api\Data;

/**
 * Interface TeacherInterface
 * @api
 */
interface TeacherInterface
{
    const ID      = 'id_teacher';
    const NAME    = 'name';
    const AGE     = 'age';
    const CLASSES = 'classes';

    /**
     * Get the Teacher ID
     *
     * @return int
     */
    public function getId();

    /**
     * Get the Teacher Name
     *
     * @return string
     */
    public function getName();

    /**
     * Get the Teacher Age
     *
     * @return int
     */
    public function getAge();

    /**
     * Get the Teacher Classes
     *
     * @return string
     */
    public function getClasses();

    /**
     * Set the Teacher Id
     *
     * @param int $id
     * @return mixed
     */
    public function setId($id);

    /**
     * Set the Teacher Name
     *
     * @param string $name
     * @return mixed
     */
    public function setName($name);

    /**
     * Set the Teacher Age
     *
     * @param int $age
     * @return mixed
     */
    public function setAge($age);

    /**
     * Set the Teacher Classes
     *
     * @param string $classes
     * @return mixed
     */
    public function setClasses($classes);
}