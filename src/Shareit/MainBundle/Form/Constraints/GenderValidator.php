<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class GenderValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!in_array($value, array(0,1,2))) {
            $this->context->addViolation($constraint->message);
        }
    }

}