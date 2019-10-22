<?php


namespace App;


class HtmlElement
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var null
     */
    private $content;
    /**
     * @var array
     */
    private $attributes;

    public function __construct($name , $content = null, array $attributes = [])
    {

        $this->name = $name;
        $this->content = $content;
        $this->attributes = $attributes;
    }

    public function render()
    {
        $result = $this->openTag();

        if ($this->isVoid()) {
            return $result;
        }

        $result .= $this->content();

        $result .= $this->closeTag();

        return $result;
    }

    protected function openTag()
    {
        if (! empty($this->attributes)) {
            $result = '<' .$this->name . $this->attributes() .'>';
        }else {
            $result = '<' .$this->name . '>';
        }

        return $result;
    }

    public function attributes()
    {
        $htmlAttributes = '' ;

        foreach ($this->attributes as $attribute => $value) {
            $htmlAttributes .= $this->renderAttributes($attribute, $value);
        }

        return $htmlAttributes;
    }

    /**
     * @return bool
     */
    public function isVoid()
    {
        return in_array($this->name, ['br', 'hr', 'img', 'input', 'meta']);
    }

    protected function renderAttributes( $attribute, $value)
    {
        if (is_numeric($attribute)) {
            $htmlAttributes = ' ' .$value;
        }else {
            $htmlAttributes = ' '.$attribute .'="' . htmlentities($value, ENT_QUOTES, 'UTF-8') . '"';
        }

        return $htmlAttributes;
    }

    /**
     * @return string
     */
    public function content()
    {
        return htmlentities($this->content, ENT_QUOTES, 'UTF-8');
    }

    /**
     * @return string
     */
    public function closeTag()
    {
        return '</' . $this->name . '>';
    }
}