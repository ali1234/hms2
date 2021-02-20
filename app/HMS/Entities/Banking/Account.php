<?php

namespace HMS\Entities\Banking;

use Doctrine\Common\Collections\ArrayCollection;

class Account
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $paymentRef;

    /**
     * @var null|string
     */
    protected $natwestRef;

    /**
     * \HMS\Entities\User[].
     *
     * @var ArrayCollection
     */
    protected $users;

    /**
     * @param string $paymentRef
     */
    public function __construct($paymentRef)
    {
        $this->paymentRef = $paymentRef;
        $this->users = new ArrayCollection();
    }

    /**
     * Gets the value of id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the value of paymentRef.
     *
     * @return string
     */
    public function getPaymentRef(): string
    {
        return $this->paymentRef;
    }

    /**
     * Sets the value of paymentRef.
     *
     * @param string $paymentRef the payment ref
     *
     * @return self
     */
    protected function setPaymentRef(string $paymentRef): self
    {
        $this->paymentRef = $paymentRef;

        return $this;
    }

    /**
     * Gets the value of natwestRef.
     *
     * @return string|null
     */
    public function getNatwestRef(): ?string
    {
        return $this->natwestRef;
    }

    /**
     * Gets the value of users.
     *
     * @return ArrayCollection User[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Sets the value of users.
     *
     * @param ArrayCollection $users the users
     *
     * @return self
     */
    public function setUsers(ArrayCollection $users)
    {
        $this->users = $users;

        return $this;
    }
}
