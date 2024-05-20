<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Core\Acl\Exceptions;


class PermissionNotFoundException extends \Exception
{

    public function __construct($permission)
    {
        parent::__construct(sprintf('Permission %s not found.', $permission));
    }
}
