<?php


namespace App\Security;


use App\Entity\Pomiary;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PomiaryVoter extends Voter
{

    CONST EDIT ='edit';
    CONST DELETE = 'delete';
    protected function supports(string $attribute, $subject)
    {
      if(!in_array($attribute,[self::EDIT,self::DELETE])){
          return false;
      }
      if(!$subject instanceof Pomiary){
          return false;
      }
      return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
       $authenUser=$token->getUser();
       if(!$authenUser instanceof User){
           return false;
       }
    }
}