<?php
/**
 * This file is part of GitterBot package.
 *
 * @author Serafim <nesk@xakep.ru>
 * @date 11.10.2015 6:07
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace App\Subscribers\Achievements;

use App\Karma;
use App\Gitter\Achieve\AbstractAchieve;

/**
 * Class Thanks10Karma0Achieve
 * @package App\Achieve
 */
class Thanks10Karma0Achieve extends AbstractAchieve
{
    /**
     * @var string
     */
    public $title = 'Полный паразец!';

    /**
     * @var string
     */
    public $description = 'Сказать 10 раз "спасибо" не имея ни единой благодарности.';

    /**
     * @var string
     */
    public $image = '//karma.laravel.su/img/achievements/thanks-10-karma-0.gif';

    /**
     * @throws \LogicException
     */
    public function handle()
    {
        Karma::created(function (Karma $karma) {
            $thanks = $karma->user->thanks->count();
            $karma = $karma->target->karma->count();

            if ($thanks === 10 && $karma === 0) {
                $this->create($karma->user, $karma->created_at);
            }
        });
    }
}