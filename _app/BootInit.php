<?php

// CONFIGRAÇÕES DO BANCO ####################
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'alfa8888');
define('DBSA', 'ni_php');

// DEFINE SERVIDOR DE E-MAIL ################
define('MAILUSER', 'email');
define('MAILPASS', 'senhadoseuemail');
define('MAILPORT', '465');
define('MAILHOST', 'smtp.gmail.com');

// DEFINE IDENTIDADE DO SITE ################
define('SITENAME', 'Constante Title, troque no INC');
define('SITEDESC', 'Esta constante encontra-se no INC da aplicacao e fornece a tag description para o template');

// DEFINE A BASE DO SITE ####################
define('HOME', 'http://www.nimicro.com.br');
define('THEME', 'padrao');

define('INCLUDE_PATH', HOME . '/themes/' . THEME);
define('REQUIRE_PATH', 'themes' . DIRECTORY_SEPARATOR . THEME);

// AUTO LOAD DE CLASSES ####################
function __autoload($Class) {

    $cDir = ['Model', 'Helpers', 'Class'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php') && !is_dir(__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php')):
            include_once (__DIR__ . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.class.php", E_USER_ERROR);
        die;
    endif;
}

// TRATAMENTO DE ERROS #####################
//CSS constantes :: Mensagens de Erro
define('NI_ACCEPT', 'accept');
define('NI_INFOR', 'infor');
define('NI_ALERT', 'alert');
define('NI_ERROR', 'error');

//NIErro :: Exibe erros lançados :: Front
function NIErro($ErrMsg, $ErrNo, $ErrDie = null) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NI_INFOR : ($ErrNo == E_USER_WARNING ? NI_ALERT : ($ErrNo == E_USER_ERROR ? NI_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">{$ErrMsg}<span class=\"ajax_close\"></span></p>";

    if ($ErrDie):
        die;
    endif;
}

//PHPErro :: personaliza o gatilho do PHP
function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine) {
    $CssClass = ($ErrNo == E_USER_NOTICE ? NI_INFOR : ($ErrNo == E_USER_WARNING ? NI_ALERT : ($ErrNo == E_USER_ERROR ? NI_ERROR : $ErrNo)));
    echo "<p class=\"trigger {$CssClass}\">";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class=\"ajax_close\"></span></p>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');

