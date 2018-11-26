<?php
/**
 * Created by PhpStorm.
 * User: Brahim
 * Date: 25/11/2018
 * Time: 12:38
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string | null
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     */
    private $firstName;
    /**
     * @var string | null
     * @Assert\NotBlank()
     * @Assert\Length(min="2", max="100")
     */
    private $lastName;

    /**
     * @var string | null
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/[0-9]{10}/"
     * )
     */
    private $phone;


    /**
     * @var string | null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string | null
     * @Assert\NotBlank()
     * @Assert\Length(min="10", minMessage="le message doit depasser les 10 carectere")
     */
    private $message;

    /**
     * @var Property | null
     */
    private $property;

    /**
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param null|string $firstName
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param null|string $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param null|string $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return Property|null
     */
    public function getProperty(): ?Property
    {
        return $this->property;
    }

    /**
     * @param Property|null $property
     */
    public function setProperty(?Property $property): void
    {
        $this->property = $property;
    }

}