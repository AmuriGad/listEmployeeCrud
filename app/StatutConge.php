<?php

namespace App;

enum StatutConge: string
{
    case EN_ATTENTE = 'en_attente';

    case ACCEPTE = 'accepte';

    case REFUSE = 'refuse';
}

