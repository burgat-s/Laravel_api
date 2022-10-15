## BASE DE DATOS Y MIGRACIONES:
1- Las columnas que son dos palabras (numero_telefono) o 3 palabras (cuit_del_contribuyente)
2- Foreign Keys --> nombreTabla_campoTabla EJ: Si se vincula a la tabla Bocetos, sería boceto_id o boceto_{CampoVinculado}
3- Nombre tabla: Es en plural (organismos) y snake case (campos_plantillas, emision_config_pagos)
4- En las migra, por ahora dejamos los index que tenemos, despues los reemplazamos
5- En las migra, los default los charlamos en el momento
6- Los campos con vinculaciones con otras tablas son ->integer()
7- Los comments solo dejamos aquellos que son descriptivos (EJ: comment('ID de usuario') NO porque se entiende que ese campo es usuario_id)
8- Todos los campos fecha son de tipo dateTime
9- Las tablas pivot se crean en la carpeta database de raíz
10- Las tablas que aún no tiene modulo, se crean en migrasTemporales dentro de database de raíz
11- POR AHORA NO SE HACEN FOREIGN KEY
12- Eliminar del nombre de la tabla el 'imp'
13- Las tablas que no tienen relaciones a otras tablas, sus migraciones arrancan con 0000_00_00_000000_create_blabla
14- Las tablas pivot se crean por órden alfabetico (Permisos_usuarios NO! Usuario_permiso SI!)

## ROUTES 
1- Siempre en plural + verbo (
    Route::prefix('importaciones')group(function () {
)
2- Tratar de utilizar los group();
## CONTROLADORES
1- Siempre en plural + Controller
2- return response()->json($bocetos, Response::HTTP_OK);

## DTO
1- Siempre en singular + Dto.
2-

## SERVICE 
1- Siempre en plural.
2- Los metodos de los controladores deben tener el tipado de lo que recibe y de lo que manda:
    public function transformarPapaEnPure (Papa $laPapa) : PureDto { logica }

## REPOS
1- Siempre en singular.

## MODELS
1- Siempre en singular.
2- Todos los models que tengan fecha van con:
    protected $casts = [
        'fecha_impresion'  => 'datetime:d-m-Y',
    ];
    
    No así los campos timestamp.

