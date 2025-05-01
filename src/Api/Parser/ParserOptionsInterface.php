<?php

namespace Siarko\FileParserXml\Api\Parser;

interface ParserOptionsInterface
{

    /**
     * If text inside text nodes should be trimmed
     * @param bool $trimText
     * @return void
     */
    public function setTrimText(bool $trimText): void;

    /**
     * @return bool
     */
    public function getTrimText(): bool;

    /**
     * @param int[] $options https://www.php.net/manual/en/libxml.constants.php
     * @return void
     */
    public function setLibxmlOptions(array $options): void;

    /**
     * @param int $option https://www.php.net/manual/en/libxml.constants.php
     * @return void
     */
    public function addLibxmlOption(int $option): void;

    /**
     * @param int $option
     * @return void
     */
    public function removeLibxmlOption(int $option): void;

    /**
     * Return Options for libxml https://www.php.net/manual/en/libxml.constants.php
     * @return int
     */
    public function getLibxmlOptions(): int;

    /**
     * @param string $namespace
     * @return void
     */
    public function setNamespace(string $namespace): void;

    /**
     * @return string
     */
    public function getNamespace(): string;

    /**
     * @param string $prefix
     * @return void
     */
    public function setPrefix(string $prefix): void;

    /**
     * @return string
     */
    public function getPrefix(): string;

    /**
     * @return string
     */
    public function getNamespacePrefix(): string;

    /**
     * @return bool
     */
    public function isPrefix(): bool;
}