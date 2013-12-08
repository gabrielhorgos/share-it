<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CustomEmailValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (preg_match('/[,;:§%£=° »~«€²‘¤µ``è&é\'çàùû"\!\?\/\*\$\)\\\(\[\{\}\]\#\^]/', $value)) {
            $this->context->addViolation($constraint->invalidMessage);
        } elseif (preg_match('/((yopmail\.com)|(jetable\.org)|(link2mail\.net)|(0\-mail\.com)|(brefmail\.com)|(tempinbox\.com)|(yopmail\.fr)|(jetable\.fr)|(link2mail\.fr)|(0-mail\.fr)|(brefmail\.fr)|(tempinbox\.fr)|(yopmail\.net))$/', $value)) {
            $this->context->addViolation($constraint->notPermittedMessage);
        }
    }


}