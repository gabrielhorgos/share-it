<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ZipValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!empty($value)) {
            if (!preg_match('/^[0-9]{1,5}$/', $value)) {
                $this->context->addViolation($constraint->message);
            }
        }
    }


}