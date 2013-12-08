<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Address extends Constraint
{

    public $message = 'The address in invalid.';

}
