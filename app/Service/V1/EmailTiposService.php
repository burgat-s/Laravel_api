<?php
/*
 *
 * Project: Safit
 * File:    EmailService.php
 * Date:   2/8/21 10:04
 * Time:   10 : 4
 *
 * @author           Nelson Gerardo Palacios <npalacios@sugit.com.ar>
 * @version         2021
 */

namespace App\Service\V1;

use App\Repository\EmailTiposRepository;
use App\Service\BaseService;



class EmailTiposService extends BaseService
{
    private $emailTiposRepository;

    public function __construct(EmailTiposRepository $emailTiposRepository){

        $this->emailTiposRepository = $emailTiposRepository;
    }

    public function find($id)
    {
        return $this->emailTiposRepository->find($id);
    }
}
