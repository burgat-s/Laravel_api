<?php

namespace Modules\Organismos\Tests\Feature;

use App\Dto\ApiResponseDto;
use App\Dto\PaginateDto;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Modules\Organismos\Dto\V1\OrganismoDto;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Organismos\Entities\Organismo;
use Modules\Zonas\Entities\Zona;

class OrganismosModuleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $apiResponseDtoOkStructure =  ApiResponseDto::okStructure();
        $paginateDtoStructure= (new PaginateDto())->structure();
        $organismoDtoStructure= (new OrganismoDto())->structure();
        $paginateDto = $this->prepareArray(
                    $paginateDtoStructure,
                    ['*'=> $organismoDtoStructure],
                    'data'
                );
        $this->apiResponsePaginateOk =
            $this->prepareArray(
                $apiResponseDtoOkStructure,
                $paginateDto,
                "result"
            );
        $this->apiResponseOk =
            $this->prepareArray(
                $apiResponseDtoOkStructure,
                $organismoDtoStructure,
                "result"
            );
    }

    /** @dataProvider cantidadOrganismosProvider */
    public function test_index_organismo_trae_estructura_correcta($cantidad)
    {
        $zona = Zona::factory()->create();
        Organismo::factory()
            ->count($cantidad)
            ->state(new Sequence(
                fn () => ['zona_id' => $zona->id]
            ))
            ->create();

        $this->getJson(route('organismos.index'))
            ->assertOk()
            ->assertJsonStructure($this->apiResponsePaginateOk);
    }

    /** @dataProvider cantidadOrganismosProvider */
    public function test_show_organismo_trae_estructura_correcta($cantidad)
    {
        $zona = Zona::factory()->create();
        Organismo::factory()
            ->count($cantidad)
            ->state(new Sequence(
                fn () => ['zona_id' => $zona->id]
            ))
            ->create();

        $response = $this->getJson(route('organismos.show',['id'=>$cantidad]));

        $response->assertOk()
            ->assertJsonStructure($this->apiResponseOk);
    }

    public function cantidadOrganismosProvider()
    {
        return [
            "1 organismos" => [
                1
            ],
            "10 organismos" => [
                10
            ],
            "24 organismos" => [
                24
            ],
            "30 organismos" => [
                30
            ],
        ];
    }
}
