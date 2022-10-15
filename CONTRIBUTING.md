# Guía de contribución

## Creacion de nuevo informe

Para crear un nuevo informe en la nueva version de safit, hay que seguir una serie de pasos, en su gran mayoria estan relacionados con la base de datos, ya que el desarrollo fue de tal forma, para que se creen los informes de manera generica, en funcion a los parametros que se explicaran a continuacion.

### Crear un registro en la DB

Para crear el informe hay que dar de alta un nuevo registro en la tabla informes_app, el mismo debe tener un formato similar al siguiente:

```json
    {
       "id":"4",
       "query":"call sp_informe_formularios_app('formulario_id','provincia_id','municipalidad_id','centro_emision_id','estado','fecha_venta_desde','fecha_venta_hasta','fecha_operacion_desde','fecha_operacion_hasta','fecha_tramite_desde','fecha_tramite_hasta')",
       "json_filtros":{
          "data":{
             "formulario_id":{
                "data":"",
                "hint":"",
                "type":"number",
                "label":"Nro. Formulario",
                "order":1,
                "value":"",
                "validate":"required",
                "depends_on":"",
                "placeholder":""
             },
             "fecha_venta_desde":{
                "data":"",
                "hint":"",
                "type":"date",
                "label":"Fecha Venta Desde",
                "order":6,
                "value":"",
                "validate":"",
                "depends_on":"",
                "placeholder":"",
                "required_group":"fecha_venta"
             },
             "fecha_venta_hasta":{
                "data":"",
                "hint":"",
                "type":"date",
                "label":"Fecha Venta Hasta",
                "order":7,
                "value":"",
                "validate":"",
                "depends_on":"fecha_venta_desde",
                "placeholder":"",
                "required_group":"fecha_venta"
             }
          }
       },
       "tipo":"Sistema",
       "nombre":"Informe de Formularios",
       "estado":"A",
       "json_data_props":{
          "formulario_id":{
             "label":"Nro. Formulario",
             "depends_on":"",
             "visibility":{
                "mobile":"true",
                "desktop":"true",
                "relevante":"true"
             }
          },
          "municipalidad":{
             "label":"Municipalidad",
             "depends_on":"",
             "visibility":{
                "mobile":"true",
                "desktop":"true",
                "relevante":"false"
             }
          },
          "centro_emision":{
             "label":"Centro Emisión",
             "depends_on":"",
             "visibility":{
                "mobile":"true",
                "desktop":"true",
                "relevante":"false"
             }
          },
          "municipalidad_id":{
             "label":"Municipalidad ID",
             "depends_on":"municipalidad",
             "visibility":{
                "mobile":"true",
                "desktop":"true",
                "relevante":"false"
             }
          },
          "centro_emision_id":{
             "label":"Centro Emisión ID",
             "depends_on":"centro_emision",
             "visibility":{
                "mobile":"true",
                "desktop":"true",
                "relevante":"false"
             }
          }
       },
       "json_row_actions":{
          "row_actions":[
             {
                "label":"Información adicional",
                "id":"api/v1/informes/info-adicional/",
                "icon":"",
                "params":{
                   "id":"29"
                }
             },
             {
                "id":"separator"
             },
             {
                "label":"",
                "id":"api/v1/informes/info-adicional/",
                "icon":"",
                "params":{
                   "id":"30"
                }
             }
          ]
       },
       "parent_id": null,
        "json_list_actions": {
          "list_actions": 
            [
              {
                "id": "informes-exportacion-excel", 
                "icon": "cloud_download", 
                "label": "Exportar Excel", 
                "params": {
                  "endpoint": "api/v1/informes/exportar-excel/{id}"
                  }
              }
            ]
        }
    }
```

- **id**: Identificador unico del registro.
- **query**: Aqui se debe poner la llamada al SP asignado al informe. En el mismo se deben declarar TODOS los filtros esperados, en caso de que no se marque alguno el front enviara un empty del mismo.
- **json_filtros**: Aqui debe ir un json que representara a los filtros que aceptara el informe. Se tomaron ciertas pautas para armar el mismo. Es por esto que luego se vera en detalle.
- **tipo**: Enum, Sistema o Usuario. En principio todos seran de sistema, pero cuando exista la posibilidad de que un usuario cree sus informes propios, se pondran como usuario.
- **nombre**: Nombre del informe
- **estado**: Enum con A o B. Alta o baja.
- **json_data_props**: Aqui debe ir un json que representara a los filtros que aceptara el informe. Se tomaron ciertas pautas para armar el mismo. Es por esto que luego se vera en detalle.
- **json_row_actions**: Aqui debe ir un json que representara a las acciones que tendran los row, en principio solo contaremos con los de info adicional, pero de la manera q esta armado, podria crecer indefinidamente. Se tomaron ciertas pautas para armar el mismo. Es por esto que luego se vera en detalle.
- **parent_id**: ID recursivo para marcar jerarquia.
- **json_list_actions**: Aqui debe ir un json que representara a las acciones que tendran el listado, en principio solo contaremos con los de exportar a excel, pero de la manera q esta armado, podria crecer indefinidamente. Se tomaron ciertas pautas para armar el mismo. Es por esto que luego se vera en detalle.

### **json_filtros:**
En el campo json_filtros es donde se construiran los filtros que estaran disponibles para los informes. Estos filtros deben tener la siguiente estructura:

```json
"formulario_id":{
                "data":"",
                "hint":"",
                "type":"number",
                "label":"Nro. Formulario",
                "order":1,
                "value":"",
                "validate":"",
                "depends_on":"",
                "placeholder":"",
                "required_group":null
             }
```

- El indice de cada filtro es el que nos hara referencia a que campo de la base de datos hace referencia, en este ejemplo "formulario_id".

- **data(opcional)**: Data se llenara cuando sea necesario enviar informacion al front para preparar el filtro, por ejemplo un select. Aqui debe ir el nombre del metodo correspondiente a la informacion que se quiere enviar. Los metodos disponibles se encuentran en Modules/Parametros/Services/V1/ParametrosService.php
- **hint(opcional)**: Hint del filtro.
- **type(required)**: Tipo de filtro. Actualmente se espera number, text, select, date y month-picker(selector de mes y año).
- **label(opcional)**: Label que tendra el campo, si bien es opcional, para hacer visible al campo debe estar, en caso de que no servira para una excepcion que se explicara en un apartado aparte.
- **order(required)**: Campo para definir el orden de los filtros.
- **value(required)**: Este campo debe estar, ya que es el que guardara el valor que fue seteado en el filtro.
- **validate(optional)**: Aqui deben ir validaciones de laravel. Ver https://laravel.com/docs/6.x/validation
- **depends_on(opcional)**: Este campo genera relacion entre 2 campos, como por ejemplo un codigo y un detalle (municipalidad_id y municipalidad_detalle)
- **placeholder(opcional)**: Placeholder
- **required_group(opcional)**: Esto es para agrupar distintos filtros, por ejemplo fecha desde y fecha hasta, esto nos servira para desde el front poder generar distinto tipo de validaciones teniendo en cuenta mas de un filtro.

### **json_data_props:**
En el campo json_data_props sirve para que se construyan las listas desde el lado front, aqui se le marcaran las pautas a tomar para cada campos. La estructura es la siguiente:


```json
"municipalidad_id":{
             "label":"Municipalidad ID",
             "depends_on":"municipalidad",
             "visibility":{
                "mobile":"true",
                "desktop":"true",
                "relevante":"false"
             }
          },
```

- **(indice de cada campo)**: El indice de cada campo debe ser el nombre del campo q devolvemos desde la base de datos.
- **label**: Label del campo.
- **depends_on(opcional)**: En caso de ser necesario, se hace referencia al indice del campo del cual depende, por ejemplo municipalidad_id dependera del campo de municipalidad.
- **visibility**: Aqui tendremos 3 distintos campos de visibilidad.
  - ***mobile(required)***: Booleano, determina si sera mostrado en el listado mobile.
  - ***desktop(required)***: Booleano, determina si sera mostrado en el listado desktop.
  - ***relevante(required)***: Booleano, determina si es un campo destacado o no (Debe haber solo uno).


### **json_row_actions:**

```json
{
  "row_actions": 
    [
      {
        "id": "informes/info-adicional", 
        "icon": "read_more", 
        "label": "Información adicional", 
        "params": {
                      "id": "29", 
                      "endpoint": "api/v1/informes/info-adicional"
                  }
      }
    ]
}
```

- **id**: Identificador unico para la accion.
- **icon**: Icono para mostrar.
- **label**: Label del campo.
- **params**: Conjunto de parametros que necesitara
    - ***id***: identificador unico.
    - ***endpoint***: Path donde debe pegar la accion.


### **json_list_actions:**

```json
{
  "list_actions": 
    [
      {
        "id": "informes-exportacion-excel", 
        "icon": "cloud_download", 
        "label": "Exportar Excel", 
        "params": {
                      "endpoint": "api/v1/informes/exportar-excel/{id}"
                  }
      }
    ]
}
```

- **id**: Identificador unico para la accion.
- **icon**: Icono para mostrar.
- **label**: Label del campo.
- **params**: Conjunto de parametros que necesitara
    - ***endpoint***: Path donde debe pegar la accion.

 Luego de tener cargado el informe en la tabla informes_app hay que crear el Stored Procedure que se corresponda con el que fue agregado al registro:
 
 ## Stored Procedure
 
 Siguiendo el ejemplo que se expone en este readme, el SP que deberia ser creado tiene que llamarse sp_informe_formularios_app y esperar los siguientes parametros: 'formulario_id','fecha_venta_desde','fecha_venta_hasta'.
 Es importante recalcar que los parametros siempre deben ser enviados, en caso de no ser seteados se envia un string vacio.
 
 
 # Armado de Filtros
 
 Para armar los filtros desde el back debemos utilizar el servicio ParametrosService, el mismo a traves del modulo de mismo nombre nos brindara toda la info necesaria para que desde el front sea construido cada filtro necesario. A continuacion se entrara en detalle.
 
 ## Obtencion de datos parametrizados para armar filtros
 
 Para construir filtros con datos se creo ParametrosService, el cual cuenta con un metodo 'makeFiltros', el mismo espera un json del tipo 'json_filtros' que fue detallado en puntos anteriores, este servicio tiene la capacidad de reconocer la informacion enviada y devolvernos los datos que nos son necesarios a traves del modulo parametros service.
 A continuacion un ejemplo con el modulo de operadores:
 
 #### Controller
 
 En nuestro controller deberiamos tener un metodo parecido al siguiente:
 
 ```php
public function getFiltros()
{
    return response()->success($this->operadoresService->getFiltros());
}
```
 
 #### Service
   ```php
  public function getFiltros()
  {
      $result = Cache::remember($this->getCacheKey(config('safit.cache.filtros_operadores'),[]), now()->addDay(),
          function()
          {
              $query = Helper::getFiltrosOperadores();
          });
      $filtros = $this->parametrosService->makeFiltros($result);
      return $filtros;
  }
```

#### Helper
```php
public static function getFiltrosOperadores()
{
    return config('filtros.filtrosOperadores');
}
```
#### Archivo de configuraciones

```php
return [
'filtrosOperadores' => [
    "data"=>[
      "provincia_id"=>[
         "data"=>"provincias",
         "hint"=>"",
         "type"=>"select",
         "label"=>"Provincia",
         "order"=>2,
         "value"=>"",
         "validate"=>"",
         "depends_on"=>"",
         "placeholder"=>""
        ],
  "municipalidad_id"=>[
      "data"=>"municipalidades",
         "hint"=>"",
         "type"=>"select",
         "label"=>"Municipalidad",
         "order"=>3,
         "value"=>"",
         "validate"=>"required",
         "depends_on"=>"provincia_id",
         "placeholder"=>""
        ]
     ]
],
    ];
```

 ## Alta de nuevo set de datos parametrizados

Si al momento de armar los filtros nos encontramos frente a la situacion de que no tenemos el metodo requerido, podemos agregarlo de la siguiente manera:

 #### ParametrosService

En parametros service generaremos un metodo que nos devolvera una coleccion con la info que sea necesaria, para lograr esto pueden darse dos casos, a traves de una consulta a la base de datos o por medio de un helper.


 ##### Base de datos

Usaremos como ejemplo Provincias:

```php

public function provincias()
    {
        $list = Cache::remember($this->getCacheKey(config('safit.cache.provincias'),["provincias"]), now()->addMonths(6),
            function(){
                $query = $this->provinciasRepository->findAll(new ProvinciasRequestDto());

                $query->transform(function ($provincia) {
                    $dto = new DataSelectDto();
                    $dto->setValue($provincia->zonID_A);
                    $dto->setLabel($provincia->zonDescrip);

                    return $dto;
                });

                return $query;
            });

        return $list;
    }

```
Como se observa, se realiza una consulta a un repo para obtener todas las provincias, se guardan dentro de un DTO y se cachea.

 ##### Helper

En caso de que los datos no requieran ser consultados en la base de datos tenemos la posibilidad de crear algun helper para obtener esto.

ParametrosService:
```php

public function sexo()
    {
        return Helper::getEnumFiltrosSexo();
    }

```

App/Helper/Helper.php:

```php

public static function getEnumFiltrosSexo()
    {
        return config('enum.filtros.sexo');
    }

```

config/enum.php:

```php

return
[
'filtros' => [
        'sexo' => [
            [
                'value' => 'M',
                'label' => 'Masculino'
            ],
            [
                'value' => 'F',
                'label' => 'Femenino'
            ],
            [
                'value' => 'X',
                'label' => 'No Binario'
            ]
        ],
]

```


## Creacion de rutas para modulos:

Para crear rutas de modulos del tipo crud y tener una homogeneidad entre los modulos, como asi tambien con el front, y con lo que propone laravel, se empezaran a manejar de la siguiente manera:

**(ejemplo con modulo juzgados)** 


```
+----------+-----------------------------------+--------------------------------------------------------------------+
| Method   | URI                               | Action                                                             |
+----------+-----------------------------------+--------------------------------------------------------------------+
| GET|HEAD | api/v1/juzgados                   | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@index      |
| POST     | api/v1/juzgados                   | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@store      |
| GET|HEAD | api/v1/juzgados/create            | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@create     |
| GET|HEAD | api/v1/juzgados/get-filtros       | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@getFiltros |
| GET|HEAD | api/v1/juzgados/{juzgado_id}      | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@show       |
| PUT      | api/v1/juzgados/{juzgado_id}      | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@update     |
| PATCH    | api/v1/juzgados/{juzgado_id}      | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@stateChange|
| GET|HEAD | api/v1/juzgados/{juzgado_id}/edit | Modules\Juzgados\Http\Controllers\V1\JuzgadosController@edit       |
+----------+-----------------------------------+--------------------------------------------------------------------+
```
- **index**: Metodo para consultar el listado inicial. (de tipo GET)
- **store**: Metodo para insertar en la base de datos un nuevo recurso. (de tipo POST)
- **create**: Metodo para obtener formulario de alta. (de tipo GET)
- **getFiltros**: Metodo para obtener los filtros de busqueda. (de tipo GET)
- **show**: Metodo para obtener los datos de un recurso. (de tipo GET)
- **update**: Metodo para editar un recurso. (de tipo PUT)
- **stateChange**: Metodo para modificar parcialmente un recurso, en este caso el estado. (de tipo PATCH)
- **edit**: Metodo para obtener formulario de edicion. (de tipo GET)


# Swagger

## Archivo de configuración
### path :  config/l5-swagger.php
En este archivo se puede configurar el nombre de la aplicación, el servidor, la ruta, los modulos los cuales se van a 
incluir y la serguraridad entre otras cosas.

## Nombre de la aplicación
Esto se puede modificar desde:
```php

'api' => [
/*
|--------------------------------------------------------------------------
| Edit to set the api's title
|--------------------------------------------------------------------------
*/

        'title' => 'SAFIT APIS',
    ],

```
### El servidor
Este se puede configurar en el archivo de configuración .env(), con la variable L5_SWAGGER_CONST_HOST, o directamente el el archivo
de configuración de swagger

```php

 'constants' => [
        'L5_SWAGGER_CONST_HOST' => env('L5_SWAGGER_CONST_HOST', 'http://localhost:8000'),
    ],

```

## La ruta

La ruta donde se va a poder ver los diferentes enpoints se puede consfigurar, por defecto esta configurada en
http://localhost:8000/api/docs, pero se puede modificar en:

```php
 'routes' => [
        /*
        |--------------------------------------------------------------------------
        | Route for accessing api documentation interface
        |--------------------------------------------------------------------------
        */

        'api' => 'api/docs',

```
## Los modulos
Por defecto Swagger solo toma el modulo App, si se quiere agregar otros modulos para generar los enpoints esto hay que agregarlo en el archivo de configuracion de Swagger (config/l5-swagger.php).

```php
  'annotations' => [
            base_path('Modules/Faqs'),
            base_path('Modules/Juzgados'),
            base_path('Modules/CentrosEmision'),
            base_path('Modules/Boletas'),
            base_path('Modules/ExencionesRenaper'),
            base_path('Modules/Informes'),
            base_path('Modules/Operadores'),
            base_path('Modules/Auth'),
            base_path('app'),
        ],

```

## La seguridad
Para configurar que metodo de seguridad se va a implementar, hay que modificar el archivo de configuracion 
de Swagger (config/l5-swagger.php), en este momento esta implementado la seguridad a traves de Beare Token
para los enpoints que implementen el middleware de seguridad, para realizar esto se implemento el enpoint
de login (/api/v1/auth/login), el cual nos va a devolver un Beare Token una vez logueado con nuestro usuario 
y pass, este token que nos devuelve hay que copiarlo , entrar donde dice Authoriza y pegar el token , darle al boton authorize
Al realizar esto se configuro en (config/l5-swagger.php). que le agregue al header de las APIS que estan protegidas ese token
Para modiifacar la key de ese header o generar otro mecanismo de autenticacion, tendriamos que modificar el 
archi de configuracion de Swagger:

```php
    /*
    |--------------------------------------------------------------------------
    | API security definitions. Will be generated into documentation file.
    |--------------------------------------------------------------------------
    */
    'security' => [
        /*
        |--------------------------------------------------------------------------
        | Examples of Security definitions
        |--------------------------------------------------------------------------
        */
        'bearer' => [
            'type' => 'http',
            'description' => 'Authorization token obtained from logging in.',
            'name' => 'TOKEN',
            'in' => 'header',
            'scheme' => 'bearer',
        ],

//        'api_key_security_example' => [ // Unique name of security
//            'type' => 'apiKey', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
//            'description' => 'A short description for security scheme',
//            'name' => 'token', // The name of the header or query parameter to be used.
//            'in' => 'header', // The location of the API key. Valid values are "query" or "header".
//        ],
        /*
    'oauth2_security_example' => [ // Unique name of security
        'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
        'description' => 'A short description for oauth2 security scheme.',
        'flow' => 'implicit', // The flow used by the OAuth2 security scheme. Valid values are "implicit", "password", "application" or "accessCode".
        'authorizationUrl' => 'http://example.com/auth', // The authorization URL to be used for (implicit/accessCode)
        //'tokenUrl' => 'http://example.com/auth' // The authorization URL to be used for (password/application/accessCode)
        'scopes' => [
            'read:projects' => 'read your projects',
            'write:projects' => 'modify projects in your account',
        ]
    ],
    */

        /* Open API 3.0 support*/
//        'passport' => [ // Unique name of security
//            'type' => 'oauth2', // The type of the security scheme. Valid values are "basic", "apiKey" or "oauth2".
//            'description' => 'Laravel passport oauth2 security.',
//            'in' => 'header',
//            'scheme' => 'https',
//            'flows' => [
//                "password" => [
//                    "authorizationUrl" => config('app.url') . '/oauth/authorize',
////                    "authorizationUrl" =>  config('app.url').'/api/v1/auth/user',
//                    "tokenUrl" => config('app.url') . '/api/v1/auth/login',
//                    "refreshUrl" => config('app.url') . '/token/refresh',
//                    "scopes" => []
//                ],
//            ],
//        ],

    ],

```

Para este caso hay que tener en cuenta que a los enpoints que esten protegidos por este token van a tener que tener en
su anotacion:

```php
/**
 *
 * @OA\Post(
 *
 *    security={
 *             {"bearer": {}},
 *              },
 *
```
Siendo que el nombre bearer es el que se configuro en el schema del archivo de configuracion.


## Comandos
Por cada modulo que se agregue hay que borrar la cache:

```shell
php artisan config:cache
```

Y por cada archivo nuevo que se agregue o modificacion que se haga en los mismos, hay que generar el archivo `api-docs`, que es el que utiliza Swagger para levantar la  configuracion de los diferentes enpoints, para realizar esto hay correr el siguiente comando:

```shell
php artisan l5-swagger:generate
```
