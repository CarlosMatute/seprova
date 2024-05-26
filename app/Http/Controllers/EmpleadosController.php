<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use Session;
use Exception;

class EmpleadosController extends Controller
{
    public function ver_empleados(){
        $empleados = DB::select("SELECT
                E.ID,
                E.PRIMER_NOMBRE,
                E.SEGUNDO_NOMBRE,
                E.PRIMER_APELLIDO,
                E.SEGUNDO_APELLIDO,
                E.IDENTIDAD,
                E.TELEFONO,
                E.DIRECCION,
                E.POLIZA_SEGURO,
                E.SEGURO_SOCIAL,
                case when E.SEGURO_SOCIAL = 1 then 'Inscrito' else 'No Inscrito' end SEGURO_SOCIAL_inscripcion,
                E.RAP,
                case when E.RAP = 1 then 'Inscrito' else 'No Inscrito' end RAP_inscripcion,
                E.FOTO,
                E.DECLARADO_CANON,
                case when E.DECLARADO_CANON = 1 then 'Declarado' else 'No Declarado' end DECLARADO_CANON_declaracion,
                E.ID_TALLA_CAMISA,
                tc.nombre talla_camisa,
                E.ID_TALLA_PANTALON,
                tp.nombre talla_pantalon,
                E.ID_TIPO_SANGRE,
                ts.nombre tipo_sangre,
                E.NOMBRE_CONYUGUE,
                E.UBICACION_CASA,
                E.CREATED_AT
            FROM
                PUBLIC.EMPLEADOS E
                join TALLAS_CAMISAS tc on e.ID_TALLA_CAMISA = tc.id
                join TALLAS_PANTALONES tp on e.ID_TALLA_PANTALON = tp.id
                join TIPOS_SANGRE ts on e.ID_TIPO_SANGRE = ts.id
            WHERE
                E.DELETED_AT IS NULL;");

        $tallas_camisas = DB::select("SELECT
                ID,
                NOMBRE
            FROM
                TALLAS_CAMISAS
            WHERE
                DELETED_AT IS NULL");

        $tallas_pantalones = DB::select("SELECT
                ID,
                NOMBRE
            FROM
                TALLAS_PANTALONES
            WHERE
                DELETED_AT IS NULL");

        $tipo_sangre = DB::select("SELECT
                ID,
                NOMBRE
            FROM
                TIPOS_SANGRE
            WHERE
                DELETED_AT IS NULL
            ORDER BY
                NOMBRE");

        return view('seprova.empleados')
                ->with('empleados', $empleados)
                ->with('tallas_camisas', $tallas_camisas)
                ->with('tallas_pantalones', $tallas_pantalones)
                ->with('tipo_sangre', $tipo_sangre);
    }
}
