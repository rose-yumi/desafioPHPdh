<?php

// validacoes.php

function checarNome($str)
{
    // Verificando se string tem pelo menos 3 caracteres (strlen)
    if (strlen($str) < 3) {
        return false;
    }

    // Verif se string tem mais de 10 carac
    if (strlen($str) > 10) {
        return false;
    }

    // Se chegar até aqui, retorne true
    return true;
}

function checarPreco($num)
{
    // Verificando se é número

    if (is_numeric($num)) {
        return false;
    }

    if ($num < 0) {
        return false;
    }

    // Se chegar até aqui, retorne true
    return true;
}