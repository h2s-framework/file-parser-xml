<?php

namespace Siarko\FileParserXml\Api\Parser\Result;

interface NodeInterface
{

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @param string $text
     * @return void
     */
    public function setText(string $text): void;

    /**
     * @return array
     */
    public function getAttributes(): array;

    /**
     * @param string $name
     * @param string|null $default
     * @return string|null
     */
    public function getAttribute(string $name, ?string $default = null): ?string;

    /**
     * @param string $name
     * @param string $value
     * @return void
     */
    public function setAttribute(string $name, string $value): void;

    /**
     * @param array $attributes
     * @return void
     */
    public function setAttributes(array $attributes): void;

    /**
     * @return array
     */
    public function getChildren(): array;

    /**
     * @param NodeInterface $node
     * @return void
     */
    public function addChild(NodeInterface $node): void;

    /**
     * @param NodeInterface[] $children
     * @return void
     */
    public function setChildren(array $children): void;

    /**
     * @return NodeInterface|null
     */
    public function getParent(): ?NodeInterface;

    /**
     * @param NodeInterface|null $parent
     * @return void
     */
    public function setParent(?NodeInterface $parent): void;

}