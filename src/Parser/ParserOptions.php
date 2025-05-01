<?php

namespace Siarko\FileParserXml\Parser;

use Siarko\FileParserXml\Api\Parser\ParserOptionsInterface;

class ParserOptions implements ParserOptionsInterface
{

    /**
     * @param bool $trimText
     * @param array $libxmlOptions
     * @param string $namespace
     * @param string $prefix
     */
    public function __construct(
        private bool $trimText = true,
        private array $libxmlOptions = [],
        private string $namespace = '',
        private string $prefix = ''
    )
    {
    }

    /**
     * If text inside text nodes should be trimmed
     * @param bool $trimText
     * @return void
     */
    public function setTrimText(bool $trimText): void
    {
        $this->trimText = $trimText;
    }

    /**
     * @return bool
     */
    public function getTrimText(): bool
    {
        return $this->trimText;
    }

    /**
     * @param int[] $options
     * @return void
     */
    public function setLibxmlOptions(array $options): void
    {
        $this->libxmlOptions[] = $options;
    }

    /**
     * @param int $option
     * @return void
     */
    public function addLibxmlOption(int $option): void
    {
        $this->libxmlOptions[] = $option;
    }

    /**
     * @param int $option
     * @return void
     */
    public function removeLibxmlOption(int $option): void
    {
        $this->libxmlOptions = array_filter($this->libxmlOptions, fn($item) => $item !== $option);
    }


    /**
     * Return Options for libxml https://www.php.net/manual/en/libxml.constants.php
     * @return int
     */
    public function getLibxmlOptions(): int
    {
        return array_reduce($this->libxmlOptions, fn($carry, $item) => $carry | $item, 0);
    }

    /**
     * @param string $namespace
     * @return void
     */
    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * @param string $prefix
     * @return void
     */
    public function setPrefix(string $prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getNamespacePrefix(): string
    {
        return ($this->isPrefix()) ? $this->prefix : $this->namespace;
    }

    /**
     * @return bool
     */
    public function isPrefix(): bool
    {
        return !empty($this->prefix);
    }


}