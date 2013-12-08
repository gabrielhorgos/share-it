<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CustomEmail extends Constraint
{

    public $invalidMessage = 'assert.user.email.invalid';
    public $notPermittedMessage = 'assert.user.email.not_permitted';

}