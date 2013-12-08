<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Gender extends Constraint
{

    public $message = 'assert.profile.gender';

}
