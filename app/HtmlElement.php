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
        $this->attributes = new HtmlAttribute($attributes);
    }

    public function render()
    {
        if ($this->isVoid()) {
            return $this->openTag();
        }

        return $this->openTag() . $this->content() . $this->closeTag();
    }

    protected function openTag()
    {
        if ($this->hasAttributes() ) {
            return '<' .$this->name . $this->attributes() .'>';
        }else {
            return '<' .$this->name . '>';
        }
    }

    public function hasAttributes()
    {
        return ! empty($this->attributes);
    }

    public function attributes()
    {
        return array_reduce(array_keys($this->attributes), function ($result, $key){
            return $result. $this->renderAttributes($key);
        }, '');
    }

    /**
     * @return bool
     */
    public function isVoid()
    {
        return in_array($this->name, ['br', 'hr', 'img', 'input', 'meta']);
    }

    protected function renderAttributes( $attribute)
    {
        if (is_numeric($attribute)) {
            return ' ' . $this->attributes[$attribute];
        }

        return ' ' . $attribute . '="' . htmlentities($this->attributes[$attribute], ENT_QUOTES, 'UTF-8') . '"';
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