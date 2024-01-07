<?php declare(strict_types=1);

namespace Modules\TaskManagmentSystem\app\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RoleEnum extends Enum
{
    const ADMIN = 0;
    const USER = 1;
}
