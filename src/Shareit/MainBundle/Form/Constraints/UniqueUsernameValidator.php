<?php

namespace Shareit\MainBundle\Form\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueUsernameValidator extends ConstraintValidator
{
    protected $em;

    function __construct($em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        $result = $this->em->getRepository('ShareitMainBundle:User')->findOneByUsername($value);

        if (!empty($result) && $result->getId() != $constraint->id) {
             $this->context->addViolation($constraint->message);
        }
    }

}