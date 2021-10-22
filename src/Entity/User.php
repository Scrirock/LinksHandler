<?php

namespace Scrirock\Links\Entity;

class User{

    private ?int $id;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $mail;
    private ?string $password;

    /**
     * User constructor.
     * @param string|null $firstName
     * @param string|null $lastName
     * @param string|null $mail
     * @param string|null $password
     * @param int|null $id
     */
    public function __construct(string $firstName = null, string $lastName = null, string $mail = null, string $password = null, int $id = null){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
        $this->password = $password;
    }

    /**
     * Return the user's ID
     * @return int|null
     */
    public function getId(): ?int{
        return $this->id;
    }

    /**
     * Set the user's ID
     * @param int|null $id
     */
    public function setId(?int $id): void{
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }


    /**
     * Return the user's mail
     * @return string|null
     */
    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * Set the user's mail
     * @param string|null $mail
     */
    public function setMail(?string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * Return the user's password
     * @return string
     */
    public function getPassword(): string{
        return $this->password;
    }

    /**
     * Set the user's password
     * @param string $password
     */
    public function setPassword(string $password): void{
        $this->password = $password;
    }

}