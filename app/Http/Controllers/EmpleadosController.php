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
use Illuminate\Support\Facades\Response;

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
                    EC.ID ID_ESTADO_CIVIL,
                    EC.NOMBRE ESTADO_CIVIL,
                    E.NOMBRE_CONYUGUE,
                    E.UBICACION_CASA,
                    E.CREATED_AT
                FROM
                    PUBLIC.EMPLEADOS E
                    JOIN TALLAS_CAMISAS TC ON E.ID_TALLA_CAMISA = TC.ID
                    JOIN TALLAS_PANTALONES TP ON E.ID_TALLA_PANTALON = TP.ID
                    JOIN TIPOS_SANGRE TS ON E.ID_TIPO_SANGRE = TS.ID
                    LEFT JOIN ESTADO_CIVIL EC ON E.ID_ESTADO_CIVIL = EC.ID
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

        $estado_civil = DB::select("SELECT
                ID,
                NOMBRE
            FROM
                ESTADO_CIVIL
            WHERE
                DELETED_AT IS NULL
            ORDER BY
                NOMBRE");

        $contratos = DB::select("SELECT
                CC.ID,
                CASE
                    WHEN TP.NOMBRE = 'Indefinido' THEN 0
                    ELSE TP.NOMBRE::NUMERIC
                END MESES,
                CC.NOMBRE || ' (Sal: ' || 'L.' || TO_CHAR(CC.SALARIO, 'FM999,999,999.00') || ' | Liq: ' || 'L.' || TO_CHAR(CC.LIQUIDACION, 'FM999,999,999.00') || ' | ' || CASE
                    WHEN TP.NOMBRE != '1'
                    AND TP.NOMBRE != 'Indefinido' THEN TP.NOMBRE || ' meses'
                    WHEN TP.NOMBRE = 'Indefinido' THEN TP.NOMBRE
                    ELSE TP.NOMBRE || ' mes'
                END || ')' CONTRATO
            FROM
                PUBLIC.CONFIGURACIONES_CONTRATOS CC
                JOIN TIPOS_CONTRATOS TP ON CC.ID_TIPO_CONTRATO = TP.ID
            WHERE
                CC.DELETED_AT IS NULL
            ORDER BY
                CONTRATO");
            
        $ubicaciones_contratos = DB::select("SELECT
                ID,
                NOMBRE
            FROM
                UBICACIONES_CONTRATOS
            WHERE
                DELETED_AT IS NULL");

        return view('seprova.empleados')
                ->with('empleados', $empleados)
                ->with('tallas_camisas', $tallas_camisas)
                ->with('tallas_pantalones', $tallas_pantalones)
                ->with('tipo_sangre', $tipo_sangre)
                ->with('estado_civil', $estado_civil)
                ->with('contratos', $contratos)
                ->with('ubicaciones_contratos', $ubicaciones_contratos);
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
        $check_seguro_social = ($request->check_seguro_social == '1') ? 1 : 2;
        $check_rap =  ($request->check_rap == '1') ? 1 : 2;
        $check_canon = ($request->check_canon == '1') ? 1 : 2;
        $estado_civil = $request->estado_civil;
        $nombre_conyugue = $request->nombre_conyugue;
        $identidad_conyugue = $request->identidad_conyugue;
        $domicilio = $request->domicilio;
        $ubicacion_casa = $request->ubicacion_casa;
        $id_contrato = $request->id_contrato;
        $ubicacion_contrato = $request->ubicacion_contrato;
        $fecha_inicio_contrato = $request->fecha_inicio_contrato;
        $fecha_finalizacion_contrato = $request->fecha_finalizacion_contrato;
        $empleados_list = null;
        $msgError = null;
        $msgSuccess = null;
        //return redirect()->back();
        //dd($request->all());
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
                                UBICACION_CASA,
                                ID_ESTADO_CIVIL,
                                IDENTIDAD_CONYUGUE
                            )
                        VALUES
                            (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :identidad, 
                            :telefono, :domicilio, :numero_poliza, :check_seguro_social, :check_rap, :check_canon, 
                            :talla_camisa, :talla_pantalon, :tipo_sangre, :nombre_conyugue, :ubicacion_casa,
                            :estado_civil, :identidad_conyugue)
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
                    "ubicacion_casa" => $ubicacion_casa,
                    "estado_civil" => $estado_civil,
                    "identidad_conyugue" => $identidad_conyugue]))->first();
                
                $msgSuccess = "Empleado ".$empleado->id." Guardado Exitosamente.";
                $id = $empleado->id;
                
                //if(($id_contrato != null || $id_contrato != '') && ($fecha_inicio_contrato != null || $fecha_inicio_contrato != '')){
                    DB::select("INSERT INTO
                        PUBLIC.EMPLEADOS_CONTRATOS (
                            ID_EMPLEADO,
                            ID_CONFIGURACION_CONTRATO,
                            FECHA_INICIO,
                            FECHA_FINALIZACION,
                            ID_UBICACION_CONTRATO
                        )
                    VALUES
                        (:id, :id_contrato, :fecha_inicio_contrato, :fecha_finalizacion_contrato, :ubicacion_contrato);", 
                        ["id" => $id, "id_contrato" => $id_contrato,
                        "fecha_inicio_contrato" => $fecha_inicio_contrato,
                        "fecha_finalizacion_contrato" => $fecha_finalizacion_contrato,
                        "ubicacion_contrato" => $ubicacion_contrato]);
            //}

                if($request->hasFile("curriculum") && $request->hasFile("contrato")){
                    //dd("NO ES UNA IMAGEN");
                    $file_curriculum=$request->file("curriculum");
                    $file_contrato=$request->file("contrato");
                    
                    // $nombre = "examen_".time().".".$file->guessExtension();
                    $nombre_archivo_curriculum = "curriculum_empleado_".$id.".".$file_curriculum->guessExtension();
                    $nombre_archivo_contrato = "contrato_empleado_".$id.".".$file_contrato->guessExtension();
                    
                    //$ruta = $request->file('profile_picture')->store('build/assets/img_empleados', 'public');
                    //$ruta = "/home/shfnuaro/public_html/pdf/examenes_laboratorio/".$nombre_archivo;
                    $ruta = null;
                    if(env('PRODUCCION') == 'true'){
                        $ruta_curriculum = "/home/ntbflekg/public_html/documentos/curriculums/".$nombre_archivo_curriculum;
                        $ruta_contrato = "/home/ntbflekg/public_html/documentos/contratos/".$nombre_archivo_contrato;
                    }else{
                        $ruta_curriculum = public_path("documentos\\curriculums\\".$nombre_archivo_curriculum);
                        $ruta_contrato = public_path("documentos\\contratos\\".$nombre_archivo_contrato);
                    }
                    copy($file_curriculum, $ruta_curriculum);
                    copy($file_contrato, $ruta_contrato);        
                    DB::select("UPDATE EMPLEADOS
                            SET
                                CURRICULUM = :nombre_archivo_curriculum,
                                CONTRATO = :nombre_archivo_contrato
                            WHERE
                                ID = :id_empleado
                            RETURNING id
                        ", ["id_empleado" => $id, 
                            "nombre_archivo_curriculum" => $nombre_archivo_curriculum,
                            "nombre_archivo_contrato" => $nombre_archivo_contrato]);
                }
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
                            ID_ESTADO_CIVIL = :estado_civil,
                            IDENTIDAD_CONYUGUE = :identidad_conyugue,
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
                    "ubicacion_casa" => $ubicacion_casa,
                    "estado_civil" => $estado_civil,
                    "identidad_conyugue" => $identidad_conyugue]);
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
                        EC.ID ID_ESTADO_CIVIL,
                        EC.NOMBRE ESTADO_CIVIL,
                        E.NOMBRE_CONYUGUE,
                        E.UBICACION_CASA,
                        E.CREATED_AT
                    FROM
                        PUBLIC.EMPLEADOS E
                        JOIN TALLAS_CAMISAS TC ON E.ID_TALLA_CAMISA = TC.ID
                        JOIN TALLAS_PANTALONES TP ON E.ID_TALLA_PANTALON = TP.ID
                        JOIN TIPOS_SANGRE TS ON E.ID_TIPO_SANGRE = TS.ID
                        LEFT JOIN ESTADO_CIVIL EC ON E.ID_ESTADO_CIVIL = EC.ID
                    WHERE
                        E.DELETED_AT IS NULL
                        AND E.ID = :id;", ["id" => $id]))->first();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $estatus = false;
            $msgError = $e->getMessage();
        }
        if($accion == 1 || $accion == 2){   
            return Redirect::back()->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
        }else{
            return response()->json(["msgSuccess"=>$msgSuccess,"msgError"=>$msgError, "empleados_list"=>$empleados_list]);
        }
        
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
                            WHEN E.POLIZA_SEGURO IS NOT NULL THEN E.POLIZA_SEGURO::TEXT
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
                        E.IDENTIDAD_CONYUGUE,
                        E.CURRICULUM,
                        E.CONTRATO,
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

        $contratos_empleado = DB::select("SELECT
                    CC.ID,
                    CC.NOMBRE,
                    CC.SALARIO,
                    'L.' || TO_CHAR(CC.SALARIO, 'FM999,999,999.00') SALARIO_FORMATO,
                    CC.LIQUIDACION,
                    'L.' || TO_CHAR(CC.LIQUIDACION, 'FM999,999,999.00') LIQUIDACION_FORMATO,
                    CC.ID_TIPO_CONTRATO,
                    TP.DESCRIPCION,
                    EC.ID_UBICACION_CONTRATO,
                    UC.NOMBRE UBICACION,
                    EC.FECHA_INICIO,
                    EC.FECHA_FINALIZACION,
                    CASE
                        WHEN NOW() < EC.FECHA_INICIO THEN 'Pendiente'
                        WHEN NOW() > EC.FECHA_FINALIZACION THEN 'Vencido'
                        WHEN (
                            NOW() BETWEEN EC.FECHA_INICIO AND EC.FECHA_FINALIZACION
                        )
                        OR (
                            NOW() >= EC.FECHA_INICIO
                            AND EC.FECHA_FINALIZACION IS NULL
                        ) THEN 'Activo'
                        ELSE NULL
                    END ESTADO
                FROM
                    PUBLIC.CONFIGURACIONES_CONTRATOS CC
                    JOIN TIPOS_CONTRATOS TP ON CC.ID_TIPO_CONTRATO = TP.ID
                    JOIN EMPLEADOS_CONTRATOS EC ON CC.ID = EC.ID_CONFIGURACION_CONTRATO
                    JOIN UBICACIONES_CONTRATOS UC ON EC.ID_UBICACION_CONTRATO = UC.ID
                    AND EC.ID_EMPLEADO = :id
                WHERE
                    CC.DELETED_AT IS NULL
                    ORDER BY
	                    ESTADO;", ["id" => $id_empleado]);
        return view('seprova.empleadosExpedientes')
                    ->with("empleado", $empleado)
                    ->with("contratos_empleado", $contratos_empleado);
        
    }

    public function guardar_fotos_empleados(Request $request){
        $id_empleado = $request->id_empleado;
        if($request->hasFile("profile_picture")){
            $file=$request->file("profile_picture");
            
            // $nombre = "examen_".time().".".$file->guessExtension();
            $nombre_archivo = "foto_empleado_".$id_empleado.".".$file->guessExtension();

            //$ruta = public_path("img\\empleados\\".$nombre_archivo);
            //$ruta = $request->file('profile_picture')->store('build/assets/img_empleados', 'public');
            $ruta = null;
            if(env('PRODUCCION') == 'true'){
                $ruta = "/home/ntbflekg/public_html/img/empleados/".$nombre_archivo;
            }else{
                $ruta = public_path("img\\empleados\\".$nombre_archivo);
            }
            
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
        return Redirect::back()->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    public function descargar_archivo_cv($archivo){
        //$fileName = basename('archivo_1152_1667065694.jpeg');
        //$file="";
        //$file= public_path(). "/archivos/".$archivo;
        //throw new exception($archivo, true);
        if(env('PRODUCCION') == 'true'){
            $file = "/home/ntbflekg/public_html/documentos/curriculums/".$archivo;
        }else{
            $file = public_path()."/documentos/curriculums/".$archivo;
        }
        //$file= "/home/shfnuaro/public_html/archivos/".$archivo;
        //return Response::download($file);
    }
}
