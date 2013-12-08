<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MobileValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!empty($value)) {
            if (!preg_match('/^0[67]{1}[0-9]{8}$/', $value)) {
                $this->context->addViolation($constraint->message);
            }
        }

    }


}