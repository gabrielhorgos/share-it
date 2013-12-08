<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CityValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!empty($value)) {
            if (!preg_match('^[a-zA-Zàâçéèêëîïôûùüÿñæœ]+(?:[\s-][a-zA-Z]+)*$^', $value)) {
                $this->context->addViolation($constraint->message);
            }
        }
    }

}

