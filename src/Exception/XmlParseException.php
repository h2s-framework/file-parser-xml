<?php

namespace Siarko\FileParserXml\Exception;

use JetBrains\PhpStorm\Pure;

class XmlParseException extends \Exception
{
    /**
     * Construct the exception. Note: The message is NOT binary safe.
     * @link https://php.net/manual/en/exception.construct.php
     * @param \LibXMLError[] $messages
     */
    #[Pure] public function __construct(public readonly array $messages = [])
    {
        parent::__construct('Exception occured when parsing XML file');
    }

    /**
     * String representation of the exception
     * @link https://php.net/manual/en/exception.tostring.php
     * @return string the string representation of the exception.
     */
    public function __toString(): string
    {
        $result = parent::__toString();
        foreach ($this->messages as $message) {
            $result .= "\n\t - " . $message->message.' File: '.$message->file.' Line: '.$message->line.' Column: '.$message->column;
        }
        return $result;
    }
}