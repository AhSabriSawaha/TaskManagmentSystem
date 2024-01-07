<?php declare(strict_types=1);

namespace Modules\TaskManagmentSystem\app\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TaskStatusEnum extends Enum
{
    const TO_DO = 0;
    const IN_PROGRESS = 1;
    const DONE = 2;
}
