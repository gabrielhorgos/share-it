<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Name extends Constraint
{
    public $invalidFormatMessage = 'assert.profile.name';
    public $invalidMessage = 'assert.profile.name';

}
