<?php

namespace Paulkudr\LaravelUuid;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Grammars\MySqlGrammar as BaseMySqlGrammar;

class MySqlGrammar extends BaseMySqlGrammar
{
    protected function typeUuid(Fluent $column)
    {
        return 'binary(16)';
    }
}
