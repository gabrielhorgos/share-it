<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueUsername extends Constraint
{

    public $message = 'This username is already taken.';
    public $id;

    function __construct($id = null)
    {
        $this->id = $id;
    }

    public function validatedBy()
    {
        return 'unique_username';
    }

}
