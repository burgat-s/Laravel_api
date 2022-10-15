<?php
/*
 *
 * Project: Safit
 * File:    Email.php
 * Date:   3/8/21 15:42
 * Time:   15 : 42
 *
 * @author           Nelson Gerardo Palacios <npalacios@sugit.com.ar>
 * @version         2021
 */

namespace App\Entities\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    const EMAIL_ENVIADO = "EN";
    const EMAIL_PENDIENTE = "P";
    const EMAIL_ERROR = "ER";
    public $timestamps = false;

    protected $table = "emails";

    protected $fillable = [
        "body",
        "subject",
        "attempts",
        "status",
        "err_no",
        "err_msg",
        "attach",
        "sent_date",
        "creation_date",
        "to_email",
        "email_tipo_id",
        "modification_date",
        "usuario_id",
        "microservice_response",
    ];
}
