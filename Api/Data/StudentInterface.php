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
     * @return int
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
     * @return \Blackbird\DataModelSample\Api\Data\StudentInterface
     */
    public function setId($id);

    /**
     * Set Student Name
     *
     * @param string $name
     * @return \Blackbird\DataModelSample\Api\Data\StudentInterface
     */
    public function setName($name);

    /**
     * Set Student Age
     *
     * @param int $age
     * @return \Blackbird\DataModelSample\Api\Data\StudentInterface
     */
    public function setAge($age);
}
