<?php

require '../vendor/autoload.php';

$element =  new \App\HtmlElement('p', 'Hola mundo', []);

echo htmlentities($element->render(), ENT_QUOTES, 'UTF-8');

echo '<br><br>';

$element1 =  new \App\HtmlElement('p', 'Hola mundo ', ['id' => 'my_paragraph']);

echo htmlentities($element1->render(), ENT_QUOTES, 'UTF-8');

echo '<br><br>';

$element2 =  new \App\HtmlElement('p', 'Hola mundo ', ['id' => 'my_paragraph', 'class' => 'paragraph']);

echo htmlentities($element2->render(), ENT_QUOTES, 'UTF-8');

echo '<br><br>';

$element2 =  new \App\HtmlElement('img', null, ['src' => '/img/image.png']);

echo htmlentities($element2->render(), ENT_QUOTES, 'UTF-8');

echo '<br><br>';

$element2 =  new \App\HtmlElement('img', null, ['src' => '/img/image.png', 'title' => 'Curso de "Refactorización" en Styde']);

echo htmlentities($element2->render(), ENT_QUOTES, 'UTF-8');

echo '<br><br>';

$element2 =  new \App\HtmlElement('input', null, ['required']);

echo htmlentities($element2->render(), ENT_QUOTES, 'UTF-8');