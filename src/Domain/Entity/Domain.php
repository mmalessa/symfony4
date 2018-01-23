<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DomainRepository")
 */

class Domain
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=32, options={"fixed" = true})
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="domain")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
     **/
    private $Group;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Group
     */
    public function getGroup()
    {
        return $this->Group;
    }

    /**
     * @param $group
     */
    public function setGroup($group)
    {
        $this->Group = $group;
    }



}
