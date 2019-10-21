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
        //Si el elemento tiene atributes:
        if (! empty($this->attributes)) {
            $htmlAttributes = '';

            foreach ($this->attributes as $attribute => $value) {
                if (is_numeric($attribute)) {
                    $htmlAttributes .= ' ' .$value;
                }else {
                    $htmlAttributes .= ' '.$attribute .'="' . htmlentities($value, ENT_QUOTES, 'UTF-8') . '"';
                }
            }
            //Abrir la etiqueta con atributos
            $result = '<' .$this->name . $htmlAttributes .'>';
        }else {

            //Abrir la etiqueta sin atributos
            $result = '<' .$this->name . '>';
        }


        //Si el elemento es void
        if (in_array($this->name, ['br','hr', 'img' , 'input' , 'meta'])) {
            return $result;
        }

        //Imprimir el contenido
        $result .= htmlentities($this->content, ENT_QUOTES, 'UTF-8');
        //Cerrar etiqueta
        $result .= '</' . $this->name . '>';


        return $result;
    }
}