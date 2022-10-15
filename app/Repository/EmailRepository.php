<?php
/*
 *
 * Project: Safit
 * File:    EmailTiposRepository.php
 * Date:   3/8/21 15:31
 * Time:   15 : 31
 *
 * @author           Nelson Gerardo Palacios <npalacios@sugit.com.ar>
 * @version         2021
 */

namespace App\Repository;

use App\Entities\Eloquent\Email;


class EmailRepository extends EloquentRepository
{
    public function __construct()
    {
        parent::__construct(new Email());
    }
}
