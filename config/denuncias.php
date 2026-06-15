<?php

return [
    /*
    |--------------------------------------------------------------------------
    | E-mails do comitê responsável
    |--------------------------------------------------------------------------
    |
    | Informe um ou mais e-mails separados por vírgula no .env.
    | Exemplo:
    | DENUNCIAS_EMAIL_DESTINO="rh@empresa.com.br,diretoria@empresa.com.br"
    |
    */

    'emails_destino' => array_filter(
        array_map(
            'trim',
            explode(',', env('DENUNCIAS_EMAIL_DESTINO', ''))
        )
    ),
];
