<?php

require_once './app/Core/Core.php';

require_once './app/Controller/ErroController.php';
require_once './app/Controller/HomeController.php';

$template = file_get_contents('./app/Template/estrutura.html');

ob_start();
    $core = new Core;
    $core->start($_GET);

    // Pega o conteudo que retornou do GET
    $saida = ob_get_contents();
ob_end_clean();

// Carregar o conteudo da variavel template
$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

echo $tplPronto;