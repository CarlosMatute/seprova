<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use Session;
use Exception;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class contratosController extends Controller
{
    public function ver_contratos(){
        $contratos = DB::select("SELECT
                CC.ID,
                CC.NOMBRE,
                CC.SALARIO,
                'L.' ||TO_CHAR(CC.SALARIO, 'FM999,999,999.00') SALARIO_FORMATO,
                CC.LIQUIDACION,
                'L.' ||TO_CHAR(CC.LIQUIDACION, 'FM999,999,999.00') LIQUIDACION_FORMATO,
                CC.ID_TIPO_CONTRATO,
                TP.DESCRIPCION,
                --CC.ID_UBICACION_CONTRATO,
                --UC.NOMBRE UBICACION,
                CC.CREATED_AT
            FROM
                PUBLIC.CONFIGURACIONES_CONTRATOS CC
                JOIN TIPOS_CONTRATOS TP ON CC.ID_TIPO_CONTRATO = TP.ID
                --JOIN UBICACIONES_CONTRATOS UC ON CC.ID_UBICACION_CONTRATO = UC.ID
            WHERE
                CC.DELETED_AT IS NULL;");

        $tipos_contratos = DB::select("SELECT
                ID,
                NOMBRE,
                DESCRIPCION
            FROM
                TIPOS_CONTRATOS
            WHERE
                DELETED_AT IS NULL
            ORDER BY
	            ID");

        $ubicaciones = DB::select("SELECT
                ID,
                NOMBRE,
                DESCRIPCION
            FROM
                UBICACIONES_CONTRATOS
            WHERE
                DELETED_AT IS NULL
            ORDER BY
	            NOMBRE");

        return view('seprova.contratos')
                ->with('contratos', $contratos)
                ->with('tipos_contratos', $tipos_contratos)
                ->with('ubicaciones', $ubicaciones);
    }

    public function guardar_contratos(Request $request){
        $accion = $request->accion;
        $id = $request->id;
        $nombre_contrato = $request->nombre_contrato;
        $salario_contrato = $request->salario_contrato;
        $liquidacion_contrato = $request->liquidacion_contrato;
        $tipo_contrato = $request->tipo_contrato;
        $ubicacion_contrato = $request->ubicacion_contrato;
        $contratos_list = null;
        $msgError = null;
        $msgSuccess = null;

        if ($id == null && $accion == 2) {
            $accion = 1;
        }

        DB::beginTransaction();
        try {
            //throw new exception($check_seguro_social, true);
            if ($accion == 1) {
                $contrato = collect(\DB::select("INSERT INTO
                        PUBLIC.CONFIGURACIONES_cONTRATOS (
                            NOMBRE,
                            SALARIO,
                            LIQUIDACION,
                            ID_TIPO_cONTRATO
                        )
                    VALUES
                        (:nombre_contrato, :salario_contrato, :liquidacion_contrato, :tipo_contrato)
                        returning id;",
                    ["nombre_contrato" => $nombre_contrato,
                    "salario_contrato" => $salario_contrato,
                    "liquidacion_contrato" => $liquidacion_contrato,
                    "tipo_contrato" => $tipo_contrato]))->first();
                
                $msgSuccess = "contrato '".$contrato->id."' Guardado Exitosamente.";
                $id = $contrato->id;
            }else if ($accion == 2) {
                //throw new exception($ubicacion_casa, true);
                DB::select("UPDATE PUBLIC.CONFIGURACIONES_CONTRATOS
                        SET
                            NOMBRE = :nombre_contrato,
                            SALARIO = :salario_contrato,
                            LIQUIDACION = :liquidacion_contrato,
                            ID_TIPO_CONTRATO = :tipo_contrato,
                            UPDATED_AT = NOW()
                        WHERE
                            ID = :id;",
                    ["id" => $id,
                    "nombre_contrato" => $nombre_contrato,
                    "salario_contrato" => $salario_contrato,
                    "liquidacion_contrato" => $liquidacion_contrato,
                    "tipo_contrato" => $tipo_contrato]);
                $estatus = true;
                $msgSuccess = "Contrato " . $id . " Actualizado Exitosamente.";
            }else if ($accion == 3) {
                DB::select("UPDATE PUBLIC.CONFIGURACIONES_CONTRATOS
                        SET
                            DELETED_AT = NOW()
                        WHERE
                            ID =:id;", ["id" => $id]);
                $estatus = true;
                $msgSuccess = "Contrato " . $id . " Eliminado Exitosamente.";
            }else{
                $estatus = false;
                $msgError = "Acción inválida";
            }
            $contratos_list = collect(\DB::select("SELECT
                            CC.ID,
                            CC.NOMBRE,
                            CC.SALARIO,
                            'L.' ||TO_CHAR(CC.SALARIO, 'FM999,999,999.00') SALARIO_FORMATO,
                            CC.LIQUIDACION,
                            'L.' ||TO_CHAR(CC.LIQUIDACION, 'FM999,999,999.00') LIQUIDACION_FORMATO,
                            CC.ID_TIPO_cONTRATO,
                            TP.DESCRIPCION,
                            CC.CREATED_AT
                        FROM
                            PUBLIC.CONFIGURACIONES_CONTRATOS CC
                            JOIN TIPOS_CONTRATOS TP ON CC.ID_TIPO_CONTRATO = TP.ID
                            --JOIN UBICACIONES_CONTRATOS UC ON CC.ID_UBICACION_CONTRATO = UC.ID
                        WHERE
                            CC.DELETED_AT IS NULL
                        AND CC.ID = :id;", ["id" => $id]))->first();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $estatus = false;
            $msgError = $e->getMessage();
        }
        return response()->json(["msgSuccess"=>$msgSuccess,"msgError"=>$msgError, "contratos_list"=>$contratos_list]);
    }
}
