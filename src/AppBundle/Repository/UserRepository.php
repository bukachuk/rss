<?php
namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(User::class));
    }
}
