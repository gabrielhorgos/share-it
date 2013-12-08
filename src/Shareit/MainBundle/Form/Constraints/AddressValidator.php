<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AddressValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (preg_match('/(*UTF8)[²&«»_=:;,><§µ%£¨°€¤¡—@~\\\|\#\(\)\$\^\*\!\/\.\.\?\+\]\[\{\}]/', $value)) {
            $this->context->addViolation($constraint->message);
        }
    }


}