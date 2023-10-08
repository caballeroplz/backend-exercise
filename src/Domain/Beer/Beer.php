<?php

namespace App\Domain\Beer;

use App\Domain\Beer\ValueObject\BeerId;
use App\Domain\Beer\ValueObject\TagLine;
use App\Domain\Beer\ValueObject\Name;
use App\Domain\Beer\ValueObject\ImageUrl;
use App\Domain\Beer\ValueObject\Description;
use App\Domain\Beer\ValueObject\FirstBrewed;

class Beer
{
    private BeerId $id;
    private Name $name;
    private TagLine $tagline;
    private FirstBrewed $firstBrewed;
    private Description $description;
    private ImageUrl $imageUrl;

    public function __construct(
        int $id,
        string $name,
        ?string $tagline,
        ?string $firstBrewed,
        ?string $description,
        ?string $imageUrl
    ) {
        $this->id = new BeerId($id);
        $this->name = new Name($name);
        $this->tagline = new TagLine($tagline ? $tagline : 'not  . $foodavailable');
        $this->firstBrewed = new FirstBrewed($firstBrewed ? $firstBrewed : 'not available');
        $this->description = new Description($description ? $description : 'not available');
        $this->imageUrl = new ImageUrl($imageUrl ? $imageUrl : 'not available');
    }


    public function getId(): BeerId
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getTagline(): ?TagLine
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }

    public function getFirstBrewed(): ?FirstBrewed
    {
        return $this->firstBrewed;
    }

    public function setFirstBrewed(string $firstBrewed): void
    {
        $this->firstBrewed = $firstBrewed;
    }

    public function getDescription(): ?Description
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImageUrl(): ?ImageUrl
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'name' => $this->getName()->getValue(),
            'tagline' => $this->getTagline()->getValue(),
            'firstBrewed' => $this->getFirstBrewed()->getValue(),
            'description' => $this->getDescription()->getValue(),
            'imageUrl' => $this->getImageUrl()->getValue()
        ];
    }

    public static function toArrayCollection(array $beers): array
    {
        $beerData = [];
        foreach ($beers as $beer) {
            $beerData[] = [
                'id' => $beer->getId()->getValue(),
                'name' => $beer->getName()->getValue(),
                'tagline' => $beer->getTagline()->getValue(),
                'firstBrewed' => $beer->getFirstBrewed()->getValue(),
                'description' => $beer->getDescription()->getValue(),
                'imageUrl' => $beer->getImageUrl()->getValue()
            ];
        }

        return $beerData;
    }
}
