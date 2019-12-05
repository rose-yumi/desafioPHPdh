<?php

// validacoes.php

function checarNome($str)
{
    // Verificando se string tem pelo menos 3 caracteres (strlen)
    if (strlen($str) < 3) {
        return false;
    }

    // Verif se string tem menos de 10 carac
    if (strlen($str) > 10) {
        return false;
    }

    // Se chegar até aqui, retorne true
    return true;

}
