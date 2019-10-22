<?php


namespace Tests;


use App\HtmlElement;

class HtmlElementTest extends TestCase
{
    /** @test **/
    function it_checks_if_a_element_is_void_or_not()
    {
        $this->assertTrue((new \App\HtmlElement('img'))->isVoid());

        $this->assertFalse((new \App\HtmlElement('p'))->isVoid());
    }
    
    /** @test **/
    function it_generate_attributes()
    {
        $element = new HtmlElement('span', null,  ['class' => 'blue', 'id' => 'my_span']);

        $this->assertSame(' class="blue" id="my_span"', $element->attributes());
    }

    /** @test **/
    function it_generates_a_paragraph_with_content()
    {
        $element =  new \App\HtmlElement('p', 'Hola mundo', []);

        $this->assertSame('<p>Hola mundo</p>' ,$element->render());
    }

    /** @test **/
    function it_generates_a_paragraph_with_content_and_attribute()
    {
        $element =  new \App\HtmlElement('p', 'Hola mundo ', ['id' => 'my_paragraph']);

        $this->assertSame('<p id="my_paragraph">Hola mundo </p>' ,$element->render());
    }

    /** @test **/
    function it_generates_a_paragraph_with_content_and_more_attributes()
    {
        $element =  new \App\HtmlElement('p', 'Hola mundo ', ['id' => 'my_paragraph', 'class' => 'paragraph']);

        $this->assertSame('<p id="my_paragraph" class="paragraph">Hola mundo </p>' ,$element->render());
    }

    /** @test **/
    function it_generates_a_image()
    {
        $element =  new \App\HtmlElement('img', null, ['src' => '/img/image.png']);

        $this->assertSame('<img src="/img/image.png">' ,$element->render());
    }

    /** @test **/
    function it_generates_a_image_with_attributes_and_escaped()
    {
        $element =  new \App\HtmlElement(
            'img', null, ['src' => '/img/image.png', 'title' => 'Curso de "Refactorización" en Styde']
        );

        $this->assertSame(
            '<img src="/img/image.png" title="Curso de &quot;Refactorizaci&oacute;n&quot; en Styde">' ,
            $element->render()
        );
    }

    /** @test **/
    function it_generates_a_input_and_required()
    {
        $element =  new \App\HtmlElement('input', null, ['required']);

        $this->assertSame('<input required>' , $element->render());
    }

    /** @test **/
    function it_method_close_tag_close_correctly()
    {
        $element =  new \App\HtmlElement('p','Hola mundo');

        $this->assertSame('<p>Hola mundo</p>' , '<p>Hola mundo'. $element->closeTag());
    }
}