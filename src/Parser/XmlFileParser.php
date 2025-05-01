<?php

namespace Siarko\FileParserXml\Parser;

use Siarko\FileParserXml\Api\Parser\ParserOptionsInterface;
use Siarko\FileParserXml\Api\Parser\Result\NodeInterface;
use Siarko\FileParserXml\Api\Parser\Result\NodeInterfaceFactory;
use Siarko\FileParserXml\Api\Parser\XmlParserInterface;
use Siarko\FileParserXml\Exception\XmlParseException;
use Siarko\Files\Api\FileInterface;

class XmlFileParser implements \Siarko\Files\Api\Parse\FileParserInterface, XmlParserInterface
{


    public function __construct(
        private readonly NodeInterfaceFactory $nodeFactory,
        private readonly ParserOptionsInterface $options
    )
    {
    }

    /**
     * @param FileInterface $file
     * @return mixed
     * @throws XmlParseException
     */
    function parse(FileInterface $file): NodeInterface
    {
        libxml_use_internal_errors(true);
        $xml = simplexml_load_file(
            $file->getPath(),
            \SimpleXMLElement::class,
            $this->options->getLibxmlOptions(),
            $this->options->getNamespacePrefix(),
            $this->options->isPrefix()
        );
        if(!empty(($errors = libxml_get_errors()))) {
            throw new XmlParseException($errors);
        }
        return $this->parseXmlElement($xml);
    }

    /**
     * @param \SimpleXMLElement|false $xml
     * @param NodeInterface|null $parent
     * @return array
     */
    private function parseXmlChildren(\SimpleXMLElement|false $xml, ?NodeInterface $parent = null): array
    {
        if($xml === false){
            return [];
        }
        $result = [];
        foreach ($xml->children() as $child) {
            $childNode = $this->parseXmlElement($child);
            if($parent){
                $childNode->setParent($parent);
            }
            $result[] = $childNode;
        }
        return $result;
    }

    /**
     * @param \SimpleXMLElement $child
     * @return NodeInterface
     */
    private function parseXmlElement(\SimpleXMLElement $child): NodeInterface
    {
        $node = $this->nodeFactory->createNamed(name:$child->getName());
        $node->setAttributes($this->parseAttributes($child));
        $node->setChildren($this->parseXmlChildren($child, $node));
        $node->setText(($this->options->getTrimText()) ? trim($child->__toString()) : $child->__toString());
        return $node;
    }

    /**
     * @param \SimpleXMLElement $child
     * @return array
     */
    private function parseAttributes(\SimpleXMLElement $child): array
    {
        $attributes = [];
        foreach ($child->attributes() as $key => $value) {
            $attributes[$key] = $value->__toString();
        }
        return $attributes;
    }

}