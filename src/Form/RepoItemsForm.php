<?php
declare(strict_types=1);

namespace App\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

final class RepoItemsForm
{
    /**
     * @var Collection<int, RepoForm>
     * @Assert\Valid
     * @Assert\Count(min = 2, max = 2)
     */
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return Collection<int, RepoForm>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Collection<int, RepoForm> $items
     *
     * @return $this
     */
    public function setItems(Collection $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @phpstan-param array<int, string> $data
     */
    public function mapFromArray(array $data): self
    {
        foreach ($data as $item) {
            $this->items->add((new RepoForm())->setName($item));
        }
        return $this;
    }
}