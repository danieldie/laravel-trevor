<?php
/**
 * Laravel-SirTrevorJs
 *
 * @link https://github.com/caouecs/Laravel-SirTrevorJs
 */

namespace Caouecs\Sirtrevorjs\Converter;

use ParsedownExtra;
use Caouecs\Sirtrevorjs\Contracts\ConverterInterface;

/**
 * Text for Sir Trevor Js by Markdown
 *
 * @package Caouecs\Sirtrevorjs\Converter
 */
class TextConverter extends BaseConverter implements ConverterInterface
{
    /**
     * Markdown
     *
     * @access protected
     * @var Markdown
     */
    protected $markdown;

    /**
     * List of types for text
     *
     * @access protected
     * @var array
     */
    protected $types = array(
        "text",
        "markdown",
        "quote",
        "blockquote",
        "heading"
    );

    /**
     * Construct
     *
     * @access public
     * @param array $config Config of Sir Trevor Js
     * @param array $data Array of data
     */
    public function __construct($config, $data)
    {
        $this->markdown = new ParsedownExtra();

        parent::__construct($config, $data);
    }

    /**
     * Convert text from markdown or html
     *
     * @access public
     * @return string
     */
    public function textToHtml()
    {
        if (isset($this->data['isHtml']) && $this->data['isHtml']) {
            $text = $this->data['text'];
        } else {
            $text = $this->markdown->text($this->data['text']);
        }

        return $this->view("text.text", array(
            "text" => $text
        ));
    }

    /**
     * Convert text from markdown
     *
     * @access public
     * @return string
     */
    public function markdownToHtml()
    {
        return $this->textToHtml();
    }

    /**
     * Convert heading
     *
     * @access public
     * @return string
     */
    public function headingToHtml()
    {
        return $this->view("text.heading", array(
            "text" => $this->data['text']
        ));
    }

    /**
     * Converts block quotes to html
     *
     * @access public
     * @return string
     */
    public function blockquoteToHtml()
    {
        // remove the indent thats added by Sir Trevor
        return $this->view("text.blockquote", array(
            "cite" => $this->data['cite'],
            "text" => $this->markdown->text(ltrim($this->data['text'], '>'))
        ));
    }

    /**
     * Converts quote to html
     *
     * @access public
     * @return string
     */
    public function quoteToHtml()
    {
        return $this->blockquoteToHtml();
    }
}
