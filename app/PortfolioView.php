<?php

namespace MixCode;

use Illuminate\Database\Eloquent\Relations\Pivot;
use MixCode\Utils\UsingUuid;

class PortfolioView extends Pivot
{
    use UsingUuid;

    protected $table = 'portfolio_views';
}
