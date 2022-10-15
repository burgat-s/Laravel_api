<?php

namespace Modules\Organismos\Services\V1;

use App\Service\BaseService;
use Modules\Organismos\Dto\V1\OrganismoDto;
use Modules\Organismos\Repositories\V1\OrganismoRepository;

class OrganismosService extends BaseService
{
    /**
     * @var OrganismoRepository
     */

    public function __construct()
    {
        $this->modelRepository = new OrganismoRepository();
        $this->modelDto = 'Modules\Organismos\Dto\V1\OrganismoDto';
    }

    public function editEstado($id): OrganismoDto
    {
        $organismo = $this->modelRepository->findOrFail($id);
        $organismo->estado = $organismo->estado === 'A' ? 'B' : 'A';
        $organismo->save();
        return  new OrganismoDto($organismo->toArray());
    }

    public function showFolders($id): array
    {
        return  $this->modelRepository->showFolders($id);
    }
}
