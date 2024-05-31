<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use DB;
use Session;
use Exception;
use File;
use Illuminate\Support\Facades\Storage;

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

    public function guardar_empleados(Request $request){
        $accion = $request->accion;
        $id = $request->id;
        $primer_nombre = $request->primer_nombre;
        $segundo_nombre = $request->segundo_nombre;
        $primer_apellido = $request->primer_apellido;
        $segundo_apellido = $request->segundo_apellido;
        $telefono = $request->telefono;
        $identidad = $request->identidad;
        $check_seguro_vida = $request->check_seguro_vida;
        $numero_poliza = $request->numero_poliza;
        $tipo_sangre = $request->tipo_sangre;
        $talla_camisa = $request->talla_camisa;
        $talla_pantalon = $request->talla_pantalon;
        $check_seguro_social = ($request->check_seguro_social == 'true') ? 1 : 2;
        $check_rap =  ($request->check_rap == 'true') ? 1 : 2;
        $check_canon = ($request->check_canon == 'true') ? 1 : 2;
        $nombre_conyugue = $request->nombre_conyugue;
        $domicilio = $request->domicilio;
        $ubicacion_casa = $request->ubicacion_casa;
        $empleados_list = null;
        $msgError = null;
        $msgSuccess = null;

        if ($id == null && $accion == 2) {
            $accion = 1;
        }

        DB::beginTransaction();
        try {
            //throw new exception($check_seguro_social, true);
            if ($accion == 1) {
                $empleado = collect(\DB::select("INSERT INTO
                            PUBLIC.EMPLEADOS (
                                PRIMER_NOMBRE,
                                SEGUNDO_NOMBRE,
                                PRIMER_APELLIDO,
                                SEGUNDO_APELLIDO,
                                IDENTIDAD,
                                TELEFONO,
                                DIRECCION,
                                POLIZA_SEGURO,
                                SEGURO_SOCIAL,
                                RAP,
                                DECLARADO_CANON,
                                ID_TALLA_CAMISA,
                                ID_TALLA_PANTALON,
                                ID_TIPO_SANGRE,
                                NOMBRE_CONYUGUE,
                                UBICACION_CASA
                            )
                        VALUES
                            (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :identidad, 
                            :telefono, :domicilio, :numero_poliza, :check_seguro_social, :check_rap, :check_canon, 
                            :talla_camisa, :talla_pantalon, :tipo_sangre, :nombre_conyugue, :ubicacion_casa)
                    returning id;",
                    ["primer_nombre" => $primer_nombre,
                    "segundo_nombre" => $segundo_nombre,
                    "primer_apellido" => $primer_apellido,
                    "segundo_apellido" => $segundo_apellido,
                    "telefono" => $telefono,
                    "identidad" => $identidad,
                    "numero_poliza" => $numero_poliza,
                    "tipo_sangre" => $tipo_sangre,
                    "talla_camisa" => $talla_camisa,
                    "talla_pantalon" => $talla_pantalon,
                    "check_seguro_social" => $check_seguro_social,
                    "check_rap" => $check_rap,
                    "check_canon" => $check_canon,
                    "nombre_conyugue" => $nombre_conyugue,
                    "domicilio" => $domicilio,
                    "ubicacion_casa" => $ubicacion_casa]))->first();
                
                $msgSuccess = "Empleado '".$empleado->id."' Guardado Exitosamente.";
                $id = $empleado->id;
            }else if ($accion == 2) {
                //throw new exception($ubicacion_casa, true);
                DB::select("UPDATE PUBLIC.EMPLEADOS
                        SET
                            PRIMER_NOMBRE = :primer_nombre,
                            SEGUNDO_NOMBRE = :segundo_nombre,
                            PRIMER_APELLIDO = :primer_apellido,
                            SEGUNDO_APELLIDO = :segundo_apellido,
                            IDENTIDAD = :identidad,
                            TELEFONO = :telefono,
                            DIRECCION = :domicilio,
                            POLIZA_SEGURO = :numero_poliza,
                            SEGURO_SOCIAL = :check_seguro_social,
                            RAP = :check_rap,
                            DECLARADO_CANON = :check_canon,
                            ID_TALLA_CAMISA = :talla_camisa,
                            ID_TALLA_PANTALON = :talla_pantalon,
                            ID_TIPO_SANGRE = :tipo_sangre,
                            NOMBRE_CONYUGUE = :nombre_conyugue,
                            UBICACION_CASA = :ubicacion_casa,
                            UPDATED_AT = NOW()
                        WHERE
                            ID = :id;",
                    ["id" => $id,
                    "primer_nombre" => $primer_nombre,
                    "segundo_nombre" => $segundo_nombre,
                    "primer_apellido" => $primer_apellido,
                    "segundo_apellido" => $segundo_apellido,
                    "telefono" => $telefono,
                    "identidad" => $identidad,
                    "numero_poliza" => $numero_poliza,
                    "tipo_sangre" => $tipo_sangre,
                    "talla_camisa" => $talla_camisa,
                    "talla_pantalon" => $talla_pantalon,
                    "check_seguro_social" => $check_seguro_social,
                    "check_rap" => $check_rap,
                    "check_canon" => $check_canon,
                    "nombre_conyugue" => $nombre_conyugue,
                    "domicilio" => $domicilio,
                    "ubicacion_casa" => $ubicacion_casa]);
                $estatus = true;
                $msgSuccess = "Empleado " . $id . " Actualizado Exitosamente.";
            }else if ($accion == 3) {
                DB::select("UPDATE PUBLIC.EMPLEADOS
                        SET
                            DELETED_AT = NOW()
                        WHERE
                            ID =:id;", ["id" => $id]);
                $estatus = true;
                $msgSuccess = "Empleado " . $id . " Eliminado Exitosamente.";
            }else{
                $estatus = false;
                $msgError = "Acción inválida";
            }
            $empleados_list = collect(\DB::select("SELECT
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
                        CASE
                            WHEN E.SEGURO_SOCIAL = 1 THEN 'Inscrito'
                            ELSE 'No Inscrito'
                        END SEGURO_SOCIAL_INSCRIPCION,
                        E.RAP,
                        CASE
                            WHEN E.RAP = 1 THEN 'Inscrito'
                            ELSE 'No Inscrito'
                        END RAP_INSCRIPCION,
                        E.FOTO,
                        E.DECLARADO_CANON,
                        CASE
                            WHEN E.DECLARADO_CANON = 1 THEN 'Declarado'
                            ELSE 'No Declarado'
                        END DECLARADO_CANON_DECLARACION,
                        E.ID_TALLA_CAMISA,
                        TC.NOMBRE TALLA_CAMISA,
                        E.ID_TALLA_PANTALON,
                        TP.NOMBRE TALLA_PANTALON,
                        E.ID_TIPO_SANGRE,
                        TS.NOMBRE TIPO_SANGRE,
                        E.NOMBRE_CONYUGUE,
                        E.UBICACION_CASA,
                        E.CREATED_AT
                    FROM
                        PUBLIC.EMPLEADOS E
                        JOIN TALLAS_CAMISAS TC ON E.ID_TALLA_CAMISA = TC.ID
                        JOIN TALLAS_PANTALONES TP ON E.ID_TALLA_PANTALON = TP.ID
                        JOIN TIPOS_SANGRE TS ON E.ID_TIPO_SANGRE = TS.ID
                    WHERE
                        E.DELETED_AT IS NULL
                        AND E.ID = :id;", ["id" => $id]))->first();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $estatus = false;
            $msgError = $e->getMessage();
        }
        return response()->json(["msgSuccess"=>$msgSuccess,"msgError"=>$msgError, "empleados_list"=>$empleados_list]);
    }

    public function expediente_empleados($id_empleado){

        $empleado = collect(\DB::select("SELECT
                        E.ID,
                        E.PRIMER_NOMBRE,
                        E.SEGUNDO_NOMBRE,
                        E.PRIMER_APELLIDO,
                        E.SEGUNDO_APELLIDO,
                        E.IDENTIDAD,
                        E.TELEFONO,
                        E.DIRECCION,
                        CASE
                            WHEN E.POLIZA_SEGURO is not null THEN E.POLIZA_SEGURO::TEXT
                            ELSE 'No Aplica'
                        END POLIZA_SEGURO,
                        E.SEGURO_SOCIAL,
                        CASE
                            WHEN E.SEGURO_SOCIAL = 1 THEN 'Inscrito'
                            ELSE 'No Inscrito'
                        END SEGURO_SOCIAL_INSCRIPCION,
                        E.RAP,
                        CASE
                            WHEN E.RAP = 1 THEN 'Inscrito'
                            ELSE 'No Inscrito'
                        END RAP_INSCRIPCION,
                        E.FOTO,
                        E.DECLARADO_CANON,
                        CASE
                            WHEN E.DECLARADO_CANON = 1 THEN 'Declarado'
                            ELSE 'No Declarado'
                        END DECLARADO_CANON_DECLARACION,
                        E.ID_TALLA_CAMISA,
                        TC.NOMBRE TALLA_CAMISA,
                        E.ID_TALLA_PANTALON,
                        TP.NOMBRE TALLA_PANTALON,
                        E.ID_TIPO_SANGRE,
                        TS.NOMBRE TIPO_SANGRE,
                        E.NOMBRE_CONYUGUE,
                        E.UBICACION_CASA,
                        E.CREATED_AT
                    FROM
                        PUBLIC.EMPLEADOS E
                        JOIN TALLAS_CAMISAS TC ON E.ID_TALLA_CAMISA = TC.ID
                        JOIN TALLAS_PANTALONES TP ON E.ID_TALLA_PANTALON = TP.ID
                        JOIN TIPOS_SANGRE TS ON E.ID_TIPO_SANGRE = TS.ID
                    WHERE
                        E.DELETED_AT IS NULL
                        AND E.ID = :id;", ["id" => $id_empleado]))->first();
        return view('seprova.empleadosExpedientes')
                    ->with("empleado", $empleado);
        
    }

    public function guardar_fotos_empleados(Request $request){
        $id_empleado = $request->id_empleado;
        if($request->hasFile("profile_picture")){
            $file=$request->file("profile_picture");
            
            // $nombre = "examen_".time().".".$file->guessExtension();
            $nombre_archivo = "foto_empleado_".$id_empleado.".".$file->guessExtension();

            $ruta = public_path("img\\empleados\\".$nombre_archivo);
            //$ruta = $request->file('profile_picture')->store('build/assets/img_empleados', 'public');
            //$ruta = "/home/shfnuaro/public_html/pdf/examenes_laboratorio/".$nombre_archivo;

            // if($file->guessExtension()=="jpeg"){
            copy($file, $ruta);
                        
                DB::select("UPDATE PUBLIC.EMPLEADOS
                    SET
                        FOTO = :nombre_archivo,
                        UPDATED_AT = NOW()
                    WHERE
                        ID = :id_empleado;
                ", ["id_empleado" => $id_empleado, "nombre_archivo" => $nombre_archivo]);
            // }else{
            //     dd("NO ES UNA IMAGEN");
            // }

        }
        return redirect()->back();
    }
}
