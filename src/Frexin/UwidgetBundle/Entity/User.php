<?php

namespace Frexin\UwidgetBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Frexin\UwidgetBundle\Entity\UserRepository")
 */
class User
{
    const USER_ACTIVE = 1;
    const USER_INACTIVE = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var guid
     *
     * @ORM\Column(name="hash", type="guid")
     */
    private $hash;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint", options={"default":1})
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="user")
     */
    protected $reviews;

    public function __construct() {
        $this->reviews = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set hash
     *
     * @param guid $hash
     * @return User
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return guid 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return User
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add reviews
     *
     * @param \Frexin\UwidgetBundle\Entity\Review $reviews
     * @return User
     */
    public function addReview(\Frexin\UwidgetBundle\Entity\Review $reviews)
    {
        $this->reviews[] = $reviews;

        return $this;
    }

    /**
     * Remove reviews
     *
     * @param \Frexin\UwidgetBundle\Entity\Review $reviews
     */
    public function removeReview(\Frexin\UwidgetBundle\Entity\Review $reviews)
    {
        $this->reviews->removeElement($reviews);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}
