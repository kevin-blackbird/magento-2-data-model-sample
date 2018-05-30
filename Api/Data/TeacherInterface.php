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
namespace Blackbird\DataModelSample\Api\Data;

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
     * @return \Blackbird\DataModelSample\Api\Data\TeacherInterface
     */
    public function setId($id);

    /**
     * Set the Teacher Name
     *
     * @param string $name
     * @return \Blackbird\DataModelSample\Api\Data\TeacherInterface
     */
    public function setName($name);

    /**
     * Set the Teacher Age
     *
     * @param int $age
     * @return \Blackbird\DataModelSample\Api\Data\TeacherInterface
     */
    public function setAge($age);

    /**
     * Set the Teacher Classes
     *
     * @param string $classes
     * @return \Blackbird\DataModelSample\Api\Data\TeacherInterface
     */
    public function setClasses($classes);
}
