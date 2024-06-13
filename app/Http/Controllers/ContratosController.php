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

class ContratosController extends Controller
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
                CC.ID_UBICACION_CONTRATO,
                UC.NOMBRE UBICACION,
                CC.CREATED_AT
            FROM
                PUBLIC.CONFIGURACIONES_CONTRATOS CC
                JOIN TIPOS_CONTRATOS TP ON CC.ID_TIPO_CONTRATO = TP.ID
                JOIN UBICACIONES_CONTRATOS UC ON CC.ID_UBICACION_CONTRATO = UC.ID
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
}
