<?php

namespace HMS\Repositories\Doctrine;

use HMS\Entities\User;
use Doctrine\ORM\EntityRepository;
use HMS\Repositories\UserRepository;
use LaravelDoctrine\ORM\Pagination\Paginatable;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    use Paginatable;

    /**
     * @param  $id
     * @return array
     */
    public function find($id)
    {
        return parent::find($id);
    }

    /**
     * @param  string $username
     * @return array
     */
    public function findByUsername(string $username)
    {
        return parent::findByUsername($username);
    }

    /**
     * @param  string $email
     * @return array
     */
    public function findByEmail(string $email)
    {
        return parent::findByEmail($email);
    }

    /**
     * @param  string $email
     * @return User|null
     */
    public function findOneByEmail(string $email)
    {
        return parent::findOneByEmail($email);
    }

    /**
     * @param  string $searchQuery
     * @param  bool $hasAccount limit to users with associated accounts
     * @return array
     */
    public function searchLike(string $searchQuery, ?bool $hasAccount = false)
    {
        $q = parent::createQueryBuilder('user')
            ->leftJoin('user.profile', 'profile')->addSelect('profile')
            ->leftJoin('user.account', 'account')->addSelect('account')
            ->where('user.name LIKE :keyword')
            ->orWhere('user.lastname LIKE :keyword')
            ->orWhere('user.username LIKE :keyword')
            ->orWhere('user.email LIKE :keyword')
            ->orWhere('profile.addressPostcode LIKE :keyword')
            ->orWhere('account.paymentRef LIKE :keyword');

        if ($hasAccount) {
            $q = $q->andWhere('user.account IS NOT NULL');
        }

        $q = $q->setParameter('keyword', '%'.$searchQuery.'%')
            ->getQuery();

        return $q->getResult();
    }

    /**
     * save User to the DB.
     * @param  User $user
     */
    public function save(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
}
