<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueUserEmail extends Constraint
{

    public $message = 'This email is already used.';
    public $id;

    function __construct($id = null)
    {
        $this->id = $id;
    }

    public function validatedBy()
    {
        return 'unique_email';
    }

}
