<?php

namespace MixCode;

use Illuminate\Database\Eloquent\Relations\Pivot;
use MixCode\Utils\UsingUuid;

class PortfolioCategory extends Pivot
{
    use UsingUuid;
}
