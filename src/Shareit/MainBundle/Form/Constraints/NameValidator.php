<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NameValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {

        if (!preg_match('/(*UTF8)[²&«»_=:;,\/0123456789><§µ%£¨°€¤¡—@~\(\)\$\^\*\!\.\?\+\]\[\{\}\\\|\#]/', $value)) {
            if (preg_match('/^[^\' -]+([\' -]{1}[^\' -]+)*$/', $value)) {
                return $value;
            }
        }
        $this->context->addViolation($constraint->invalidFormatMessage);
    }

}

