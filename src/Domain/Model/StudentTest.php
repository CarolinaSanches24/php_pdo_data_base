<?php
namespace Carolinasanches24\PhpPdo\Domain\Model;

class StudentTest
{
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birthDate;

    public function __set($name, $value)
    {
        if ($name === 'id') {
            $this->id = (int) $value;
        } elseif ($name === 'name') {
            $this->name = (string) $value;
        } elseif ($name === 'birth_date') {
            $this->birthDate = new \DateTimeImmutable($value);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBirthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function getBirthDateAsString(): string
    {
        return $this->birthDate->format('Y-m-d');
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }
}

