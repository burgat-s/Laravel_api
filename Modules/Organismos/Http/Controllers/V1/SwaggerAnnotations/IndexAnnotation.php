<?php
/**
 * @OA\Get(
 *     path="/api/v1/bocetos",
 *     tags={"Boletas"},
 *     summary="Acreditacion de Boletas de Provincia Net",
 *     description=" Acredita la boleta de Provincia Net ",
 *     operationId="index",
 *     security={
 *             {"bearer": {}},
 *              },
 *     @OA\Parameter(
 *         name="bop_cb",
 *         in="query",
 *         description="Id de la boleta",
 *         required=true,
 *         explode=true,
 *         @OA\Schema(
 *              type="integer",
 *              format="int64"

 *         )
 *     ),
 *     @OA\Parameter(
 *         name="monto_pagado",
 *         in="query",
 *         description="Monto pagado en la boleta",
 *         required=true,
 *         explode=true,
 *         @OA\Schema(
 *              type="string",

 *         )
 *     ),
 *     @OA\Parameter(
 *         name="fecha_pago",
 *         in="query",
 *         description="fecha de pago de la boleta",
 *         required=true,
 *         explode=true,
 *         @OA\Schema(
 *             type="string",

 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid status value"
 *     ),
 *
 * )
 */
