<?php

namespace Siarko\FileParserXml\Parser\Result;

use Siarko\FileParserXml\Api\Parser\Result\NodeInterface;

class Node implements NodeInterface
{

    /**
     * @param string $name
     * @param string $text
     * @param array $attributes
     * @param array $children
     * @param NodeInterface|null $parent
     */
    public function __construct(
        private readonly string $name,
        private string $text = '',
        private array $attributes = [],
        private array $children = [],
        private ?NodeInterface $parent = null
    )
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @param string|null $default
     * @return string|null
     */
    public function getAttribute(string $name, ?string $default = null): ?string
    {
        return $this->attributes[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setAttribute(string $name, string $value): void
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @param array $attributes
     * @return void
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param Node $node
     * @return void
     */
    public function addChild(NodeInterface $node): void
    {
        $this->children[] = $node;
    }

    /**
     * @param array $children
     * @return void
     */
    public function setChildren(array $children): void
    {
        $this->children = $children;
    }

    /**
     * @param string $name
     * @return array
     */
    public function getChildrenByName(string $name): array
    {
        return array_filter($this->children, fn(Node $node) => $node->getName() === $name);
    }

    /**
     * @return NodeInterface|null
     */
    public function getParent(): ?NodeInterface
    {
        return $this->parent;
    }

    /**
     * @param NodeInterface|null $parent
     * @return void
     */
    public function setParent(?NodeInterface $parent): void
    {
        $this->parent = $parent;
    }


}