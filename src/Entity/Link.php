<?php


namespace Scrirock\Links\Entity;


class Link{

    private ?int $id;
    private string $link;
    private string $title;
    private string $target;

    /**
     * Link constructor.
     * @param string $link
     * @param string $title
     * @param string $target
     * @param int|null $id
     */
    public function __construct(string $link, string $title, string $target, int $id = null)
    {
        $this->link = $link;
        $this->title = $title;
        $this->target = $target;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Return the link
     * @return string
     */
    public function getLink(): string{
        return $this->link;
    }

    /**
     * Set the link
     * @param string $link
     */
    public function setLink(string $link): void{
        $this->link = $link;
    }

    /**
     * Return the title
     * @return string
     */
    public function getTitle(): string{
        return $this->title;
    }

    /**
     * Set the title
     * @param string $title
     */
    public function setTitle(string $title): void{
        $this->title = $title;
    }

    /**
     * Return the target
     * @return string
     */
    public function getTarget(): string{
        return $this->target;
    }

    /**
     * Set the target
     * @param string $target
     */
    public function setTarget(string $target): void{
        $this->target = $target;
    }


}