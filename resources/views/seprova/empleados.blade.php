@extends('../layouts/' . $layout)

@section('subhead')
    <title>Empleados</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        #map {
            height: 300px; /* Altura del mapa */
            width: 100%; /* Ancho del mapa */
            border: 1px solid #ccc; /* Borde opcional para el mapa */
            margin-top: 20px; /* Margen superior opcional */
        }
    </style>
@endsection

@section('subcontent')
<!-- BEGIN: Profile Info -->
<div class="intro-y box mt-5 px-5 pt-5">
    <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
        <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
            <x-base.lucide class="h-40 w-40" icon="archive" />
            <div class="ml-5">
                <div class="w-240 truncate text-lg font-medium sm:w-80 sm:whitespace-normal">
                    <h1 class="text-5xl font-medium leading-none">EMPLEADOS</h1>
                </div>
                <div class="text-slate-500">Pantalla de administración de empleados.</div>
            </div>
        </div>
    </div>
</div>
<!-- END: Profile Info -->

<!-- BEGIN: HTML Table Data -->
<div class="intro-y box mt-5 p-5">
    <div class="grid grid-cols-12 gap-6">
        <div class="intro-y col-span-6 lg:col-span-6">
            <div class="p-5">
                <h3 class="text-2xl font-medium leading-none">
                    <div class="flex items-center">
                        <i data-lucide="List" class="w-6 h-6 mr-1"></i>
                        <span class="text-white-700"> Lista de Empleados</span>
                    </div>
                </h3>
            </div>
        </div>
        <div class="intro-y col-span-6 lg:col-span-6 text-right">
            <div class="p-5">
                <x-base.button class="mb-2 mr-1" variant="primary" id="btn_nuevo_empleado">
                    <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                    Registrar Nuevo Empleado
                </x-base.button>
            </div>
        </div>
    </div>
    <div class="scrollbar-hidden overflow-x-auto">
        <table id="sdatatable" class="display datatable" style="width:100%">
            <thead>
                <tr class="bg-dark text-white">
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Identidad</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($empleados as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                    <td><div class="image-fit h-12 w-12 flex-none">
                                    <img
                                        class="rounded-full"
                                        src="{{ asset('img/empleados/')}}/{{ $row->foto }}" onerror="this.src='{{ asset('img/user2.png') }}'"
                                        alt="Midone Tailwind HTML Admin Template"
                                    />
                                </div>
                                </td>
                        <td>{{$row->primer_nombre}} {{$row->segundo_nombre}}</td>
                        <td>{{$row->primer_apellido}} {{$row->segundo_apellido}}</td>
                        <td>{{$row->identidad}}</td>
                        <td>{{$row->telefono}}</td>
                        <td>{{$row->direccion}}</td>
                        <td>
                            <x-base.button
                                class="mb-2 mr-1 editar"
                                variant="warning"
                                size="sm"
                                data-id="{{$row->id}}" 
                                data-primer_nombre="{{$row->primer_nombre}}" 
                                data-segundo_nombre="{{$row->segundo_nombre}}" 
                                data-primer_apellido="{{$row->primer_apellido}}" 
                                data-segundo_apellido="{{$row->segundo_apellido}}" 
                                data-identidad="{{$row->identidad}}"
                                data-telefono="{{$row->telefono}}"
                                data-poliza_seguro="{{$row->poliza_seguro}}"
                                data-direccion="{{$row->direccion}}"
                                data-seguro_social="{{$row->seguro_social}}"
                                data-rap="{{$row->rap}}"
                                data-declarado_canon="{{$row->declarado_canon}}"
                                data-id_talla_camisa="{{$row->id_talla_camisa}}"
                                data-id_talla_pantalon="{{$row->id_talla_pantalon}}"
                                data-id_tipo_sangre="{{$row->id_tipo_sangre}}"
                                data-id_estado_civil="{{$row->id_estado_civil}}"
                                data-estado_civil="{{$row->estado_civil}}"
                                data-nombre_conyugue="{{$row->nombre_conyugue}}"
                                data-ubicacion_casa="{{$row->ubicacion_casa}}"
                            >
                                <x-base.lucide
                                    class="h-4 w-4"
                                    icon="Edit"
                                />
                            </x-base.button>
                            <x-base.button
                                class="mb-2 mr-1 eliminar"
                                variant="danger"
                                size="sm"
                                data-id="{{$row->id}}" 
                                data-primer_nombre="{{$row->primer_nombre}}" 
                                data-segundo_nombre="{{$row->segundo_nombre}}" 
                                data-primer_apellido="{{$row->primer_apellido}}" 
                                data-segundo_apellido="{{$row->segundo_apellido}}" 
                                data-identidad="{{$row->identidad}}"
                                data-telefono="{{$row->telefono}}"
                                data-poliza_seguro="{{$row->poliza_seguro}}"
                                data-direccion="{{$row->direccion}}"
                                data-seguro_social="{{$row->seguro_social}}"
                                data-rap="{{$row->rap}}"
                                data-declarado_canon="{{$row->declarado_canon}}"
                                data-id_talla_camisa="{{$row->id_talla_camisa}}"
                                data-id_talla_pantalon="{{$row->id_talla_pantalon}}"
                                data-id_tipo_sangre="{{$row->id_tipo_sangre}}"
                                data-id_estado_civil="{{$row->id_estado_civil}}"
                                data-estado_civil="{{$row->estado_civil}}"
                                data-nombre_conyugue="{{$row->nombre_conyugue}}"
                                data-ubicacion_casa="{{$row->ubicacion_casa}}"
                            >
                                <x-base.lucide
                                    class="h-4 w-4"
                                    icon="Trash"
                                />
                            </x-base.button>
                            <x-base.button
                                href="{{url('/empleados/')}}/{{$row->id}}/expediente"
                                as="a"
                                class="mb-2 mr-1"
                                variant="primary"
                                size="sm"
                            >
                                <x-base.lucide
                                    class="h-4 w-4"
                                    icon="FileText"
                                />
                            </x-base.button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- END: HTML Table Data -->

<!-- BEGIN: Modal Content -->
<x-base.dialog id="modal_nuevo_empleado" size="xl" staticBackdrop>
    <x-base.dialog.panel>
    <form action="{{url('/empleados/guardar')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-base.dialog.title class="bg-primary">
            <h2 class="mr-auto text-white font-medium">
                <div class="flex items-center">
                    <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                    <span class="text-white-700"> Registrar Nuevo Empleado</span>
                </div>
            </h2>
            <a
                                    class="absolute top-0 right-0 mt-3 mr-3"
                                    data-tw-dismiss="modal"
                                    href="#"
                                >
                                    <x-base.lucide
                                        class="h-4 w-4 text-slate-400"
                                        icon="X"
                                    />
                                </a>
        </x-base.dialog.title>
        <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
                <input type="hidden" name="accion" id="accion"/>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_input_primer_nombre">
                        Primer Nombre
                    </x-base.form-label>
                    <x-base.form-input name="primer_nombre" id="modal_input_primer_nombre" type="text" placeholder="Escriba el Primer Nombre" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_input_segundo_nombre">
                        Segundo Nombre
                    </x-base.form-label>
                    <x-base.form-input name="segundo_nombre" id="modal_input_segundo_nombre" type="text" placeholder="Escriba el Segundo Nombre" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_input_primer_apellido">
                        Primer Apellido
                    </x-base.form-label>
                    <x-base.form-input name="primer_apellido" id="modal_input_primer_apellido" type="text" placeholder="Escriba el Primer Apellido" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_input_segundo_apellido">
                        Segundo Apellido
                    </x-base.form-label>
                    <x-base.form-input name="segundo_apellido" id="modal_input_segundo_apellido" type="text" placeholder="Escriba el Segundo Apellido" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-4">
                    <x-base.form-label class="font-extrabold" for="modal_input_telefono">
                        Teléfono
                    </x-base.form-label>
                    <x-base.form-input name="telefono" id="modal_input_telefono" type="number" placeholder="Escriba el Teléfono" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-4">
                    <x-base.form-label class="font-extrabold" for="modal_input_identidad">
                        Identidad
                    </x-base.form-label>
                    <x-base.form-input name="identidad" id="modal_input_identidad" type="number" placeholder="Escriba la Identidad" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-4">
                    <x-base.form-label class="font-extrabold" for="modal_input_numero_poliza">
                    <x-base.form-check class="mr-2">
                                        <x-base.form-check.input
                                            id="modal_checkbox_poliza"
                                            type="checkbox"
                                            name="check_seguro_vida"
                                        />
                                        <x-base.form-check.label for="modal_checkbox_poliza">
                                            Aplica Seguro de Vida
                                        </x-base.form-check.label>
                                    </x-base.form-check>
                    </x-base.form-label>
                    <x-base.form-input name="numero_poliza" disabled id="modal_input_numero_poliza" type="number" placeholder="Escriba el Número de Póliza" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-2">
                    <x-base.form-label class="font-extrabold" for="modal_select_tipo_sangre">
                        Tipo de Sangre
                    </x-base.form-label>
                    <x-base.form-select name="tipo_sangre" id="modal_select_tipo_sangre" class="w-full">
                        @foreach($tipo_sangre as $row)
                            <option value="{{$row->id}}">{{$row->nombre}}</option>
                        @endforeach
                    </x-base.form-select>
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-2">
                    <x-base.form-label class="font-extrabold" for="modal_select_talla_camisa">
                        Talla de Camisa
                    </x-base.form-label>
                    <x-base.form-select id="modal_select_talla_camisa" name="talla_camisa" class="w-full">
                        @foreach($tallas_camisas as $row)
                            <option value="{{$row->id}}">{{$row->nombre}}</option>
                        @endforeach
                    </x-base.form-select>
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-2">
                    <x-base.form-label class="font-extrabold" for="modal_select_talla_pantalon">
                        Talla de Pantalón
                    </x-base.form-label>
                    <x-base.form-select id="modal_select_talla_pantalon" name="talla_pantalon" class="w-full">
                        @foreach($tallas_pantalones as $row)
                            <option value="{{$row->id}}">{{$row->nombre}}</option>
                        @endforeach
                    </x-base.form-select>
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                <x-base.form-label class="font-extrabold">
                        Marque las opciones que aplica el empleado
                    </x-base.form-label>
                <div class="mt-2 flex flex-col sm:flex-row">
                                    <x-base.form-check class="mr-2">
                                        <x-base.form-check.input
                                            id="modal_checkbox_seguro_social"
                                            type="checkbox"
                                            value=""
                                            name="check_seguro_social"
                                        />
                                        <x-base.form-check.label for="modal_checkbox_seguro_social">
                                            Seguro Social
                                        </x-base.form-check.label>
                                    </x-base.form-check>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <x-base.form-check class="mt-2 mr-2 sm:mt-0">
                                        <x-base.form-check.input
                                            id="modal_checkbox_rap"
                                            type="checkbox"
                                            value=""
                                            name="check_rap"
                                        />
                                        <x-base.form-check.label for="modal_checkbox_rap">
                                            RAP
                                        </x-base.form-check.label>
                                    </x-base.form-check>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <x-base.form-check class="mt-2 mr-2 sm:mt-0">
                                        <x-base.form-check.input
                                            id="modal_checkbox_canon"
                                            type="checkbox"
                                            value=""
                                            name="check_canon"
                                        />
                                        <x-base.form-check.label for="modal_checkbox_canon">
                                            CANON
                                        </x-base.form-check.label>
                                    </x-base.form-check>
                                </div>
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-2">
                    <x-base.form-label class="font-extrabold" for="modal_select_estado_civil">
                        Estado Civil
                    </x-base.form-label>
                    <x-base.form-select name="estado_civil" id="modal_select_estado_civil" class="w-full">
                        @foreach($estado_civil as $row)
                            <option value="{{$row->id}}">{{$row->nombre}}</option>
                        @endforeach
                    </x-base.form-select>
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_input_nombre_conyugue">
                        Nombre Completo del Conyugue
                    </x-base.form-label>
                    <x-base.form-input name="nombre_conyugue" id="modal_input_nombre_conyugue" type="text" placeholder="Escriba el Nombre del Conyugue" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-4">
                    <x-base.form-label class="font-extrabold" for="modal_input_identidad_conyugue">
                        Número de dentidad del Conyugue
                    </x-base.form-label>
                    <x-base.form-input id="modal_input_identidad_conyugue" type="number" placeholder="Escriba la Identidad del Conyugue" />
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-12">
                    <x-base.form-label class="font-extrabold" for="modal_input_domicilio">
                        Domicilio y Ubicación de Casa
                    </x-base.form-label>
                    <x-base.form-textarea rows="5" id="modal_input_domicilio" name="domicilio" placeholder="Escriba la dirección exacta."></x-base.form-textarea>
                    <div id="map"></div>
                    <input type="hidden" name="ubicacion_casa" id="ubicacion_casa"/>
                    <!-- <p>Coordenadas: <span id="coords">N/A</span></p> -->
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-12">
                    <hr>
                </div>
                <div id="div_modal_select_contrato" class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_select_contrato">
                        Contrato Actual
                    </x-base.form-label>
                    <x-base.tom-select
                                        class="w-full"
                                        data-placeholder="Buscar"
                                        id="modal_select_contrato"
                                        name="id_contrato"
                                    >
                                    <option disabled selected>Elija una opción</option>
                                    @foreach($contratos as $row)
                                        <option value="{{$row->id}}" data-valueId="{{$row->id}}" data-valueMeses="{{$row->meses}}">{{$row->contrato}}</option>
                                    @endforeach
                                    </x-base.tom-select>
                </div>
                <div id="div_modal_select_contrato" class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_select_contrato">
                        Ubicación del Contrato
                    </x-base.form-label>
                    <x-base.tom-select
                                        class="w-full"
                                        data-placeholder="Buscar"
                                        id="modal_select_contrato"
                                    >
                                    <option disabled selected>Elija una opción</option>
                                    @foreach($ubicaciones_contratos as $row)
                                        <option value="{{$row->id}}">{{$row->nombre}}</option>
                                    @endforeach
                                    </x-base.tom-select>
                </div>
                <div id="div_modal_fecha_inicio_contrato" class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_fecha_inicio_contrato">
                        Fecha de Inicio
                    </x-base.form-label>
                    <x-base.form-input id="modal_fecha_inicio_contrato" type="date"/>
                </div>
                <div id="div_modal_fecha_finalizacion_contrato" class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_fecha_finalizacion_contrato">
                        Fecha de Finalización
                    </x-base.form-label>
                    <x-base.form-input id="modal_fecha_finalizacion_contrato" type="date"/>
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_fileInput_cirriculum">
                            Cargar Cirriculum
                        </x-base.form-label>
                        <input type="file" id="modal_fileInput_cirriculum" name="curriculum" accept="application/pdf" required class="mb-4">
                </div>
                <div class="col-span-12 md:col-span-12 lg:col-span-6">
                    <x-base.form-label class="font-extrabold" for="modal_fileInput_contrato">
                            Cargar Contrato&nbsp;&nbsp;
                        </x-base.form-label>
                        <input type="file" id="modal_fileInput_contrato" name="contrato" accept="application/pdf" required class="mb-4">
                </div>
            
        </x-base.dialog.description>
        <x-base.dialog.footer class="bg-dark">
            <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                Cancelar
            </x-base.button>
            <!-- <x-base.button size="sm" class="w-20" type="button" variant="primary" id="modal_btn_guardar_empleados">
                Guardar
            </x-base.button> -->
            <x-base.button size="sm" class="w-20" type="submit" variant="primary">
                Guardar
            </x-base.button>
        </x-base.dialog.footer>
    </x-base.dialog.panel>
    </form>
</x-base.dialog>
<!-- END: Modal Content -->

<!-- BEGIN: Modal Content -->
<x-base.dialog id="modal_eliminar">
    <x-base.dialog.panel>
        <div class="p-5 text-center">
            <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-danger" icon="XCircle" />
            <div class="mt-5 text-3xl">¡Advertencia!</div>
            <div class="mt-2 text-slate-500">
                ¿Realmente desea eliminar a este Empleado?<br />
                <div id="id_registro"></div>
            </div>
        </div>
        <div class="px-5 pb-8 text-center">
            <x-base.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="outline-secondary">
                Cancelar
            </x-base.button>
            <x-base.button class="w-24" type="button" variant="danger" id="btn_eliminar">
                Eliminar
            </x-base.button>
        </div>
    </x-base.dialog.panel>
</x-base.dialog>
<!-- END: Modal Content -->

<div class="text-center">
    <!-- BEGIN: Notification Content -->
    <div id="success-notification-content" class="py-5 pl-5 pr-14 bg-white border border-slate-200/60 rounded-lg shadow-xl dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600 hidden flex">
        <i data-lucide="check-circle" width="24" height="24" class="stroke-1.5 text-success"></i>
        <div id="success-notification" class="ml-4 mr-4"></div>
    </div>
    <div id="danger-notification-content" class="py-5 pl-5 pr-14 bg-white border border-slate-200/60 rounded-lg shadow-xl dark:bg-darkmode-600 dark:text-slate-300 dark:border-darkmode-600 hidden flex">
        <i data-lucide="x-circle" width="24" height="24" class="stroke-1.5 text-danger"></i>
        <div id="danger-notification" class="ml-4 mr-4"></div>
    </div>
    <!-- END: Notification Content -->
</div>

@endsection
@once
    @push('scripts')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/js/pages/modal/index.js')
        @vite('resources/js/vendor/toastify/index.js')
        @vite('resources/js/pages/notification/index.js')
        <script type="module">
            var accion_guardar = false;
            var accion = null;
            var id = null;
            var primer_nombre = null;
            var segundo_nombre = null;
            var primer_apellido = null;
            var segundo_apellido = null;
            var telefono = null;
            var identidad = null;
            var check_seguro_vida = null;
            var numero_poliza = null;
            var tipo_sangre = null;
            var talla_camisa = null;
            var talla_pantalon = null;
            var check_seguro_social = null;
            var check_rap = null;
            var check_canon = null;
            var estado_civil = null;
            var nombre_conyugue = null;
            var domicilio = null;
            var ubicacion_casa = null;
            var map = null;
            var marker = null;
            var id_contrato = null;
            var contrato_meses = null;
            var fecha_inicio_contrato = null;
            var fecha_finalizacion_contrato = null;
            var url_guardar_empleado = "{{url('/empleados/guardar')}}";
            var onTomSelect = false;
            var tomSelect = null;
            var titleMsg = null;
            var textMsg = null;
            var typeMsg = null;
            var numerofila = null;
            var table = null;
            var rowNumber = null;
            var id_seleccionar = localStorage.getItem("sdatatable_id_seleccionar");

            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    
                });	 

                //$.fn.dataTable.isDataTable('#sdatatable')
                    // Inicializa el DataTable
                    table = $('#sdatatable').DataTable({
                        language: { 
                            "decimal": ",", 
                            "thousands": ".", 
                            "lengthMenu": "Mostrar _MENU_ registros", 
                            "zeroRecords": "No se encontraron resultados", 
                            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros", 
                            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros", 
                            "infoFiltered": "(filtrado de un total de _MAX_ registros)", 
                            "sSearch": "Buscar:", 
                            "oPaginate": { 
                                "sFirst": "Primero", 
                                "sLast":"Último", 
                                "sNext":"Siguiente", 
                                "sPrevious": "Anterior" 
                            }, 
            
                            "oAria": { 
                                "sSortAscending": ": Activar para ordenar la columna de manera ascendente", 
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente" 
                            }, 
            
                            "sProcessing":"Cargando..." 
                        },
                        "processing": true,
                        serverSide: false,
                    });
            });

            document.addEventListener('DOMContentLoaded', function() {
                    // Inicializa el mapa
                    map = L.map('map').setView([15.199999, -86.241905], 6);

                    // Añade una capa de mapa (OpenStreetMap en este caso)
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                     // Establece la ruta de las imágenes de Leaflet
                    L.Icon.Default.imagePath = "/img/";


                    // Añade un evento de clic al mapa
                    map.on('click', function(e) {
                        // Obtén las coordenadas del clic
                        var coords = e.latlng;
                        
                        // Si ya hay un marcador, actualiza su posición
                        if (marker) {
                            marker.setLatLng(coords);
                            //{"lat": 14.119429333513594,"lng": -87.18672752380373}
                        } else {
                            // Si no hay marcador, crea uno nuevo
                            marker = L.marker(coords).addTo(map);
                        }

                        ubicacion_casa = coords;
                        ubicacion_casa = '{"lat": '+ubicacion_casa.lat.toString() + ', "lng": ' + ubicacion_casa.lng.toString()+'}';
                        $("#ubicacion_casa").val(ubicacion_casa);
                        //console.log(ubicacion_casa);
                        // Actualiza el contenido del elemento span con las coordenadas
                        //document.getElementById('coords').textContent = `Lat: ${coords.lat}, Lng: ${coords.lng}`;
                    });
                });

            $("#sdatatable tbody").on( "click", "tr", function () { 
                                     rowNumber=parseInt(table.row( this ).index()); 
                                     table.$('tr.selected').removeClass('selected'); 
                                     $(this).addClass('selected'); 
                                     localStorage.setItem("sdatatable_id_seleccionar",table.row( this ).data()[0]); 
                                     }); 

            $('#sdatatable tbody').on('click', '.editar', function() {
                map.setView([15.199999, -86.241905], 6);
                accion = 2;
                id = $(this).data('id');
                primer_nombre = $(this).data('primer_nombre');
                segundo_nombre = $(this).data('segundo_nombre');
                primer_apellido = $(this).data('primer_apellido');
                segundo_apellido = $(this).data('segundo_apellido');
                telefono = $(this).data('telefono');
                identidad = $(this).data('identidad');
                numero_poliza = $(this).data('poliza_seguro');
                if(numero_poliza == null || numero_poliza == ''){
                    $('#modal_checkbox_poliza').prop('checked', false);
                    $('#modal_input_numero_poliza').prop('disabled', true);
                }else{
                    $('#modal_checkbox_poliza').prop('checked', true);
                    $('#modal_input_numero_poliza').prop('disabled', false);
                }
                tipo_sangre = $(this).data('id_tipo_sangre');
                talla_camisa = $(this).data('id_talla_camisa');
                talla_pantalon = $(this).data('id_talla_pantalon');
                check_seguro_social = $(this).data('seguro_social');
                if(check_seguro_social == 1){
                    $('#modal_checkbox_seguro_social').prop('checked', true);
                }else{
                    $('#modal_checkbox_seguro_social').prop('checked', false);
                }
                check_rap = $(this).data('rap');
                if(check_rap == 1){
                    $('#modal_checkbox_rap').prop('checked', true);
                }else{
                    $('#modal_checkbox_rap').prop('checked', false);
                }
                check_canon = $(this).data('declarado_canon');
                if(check_canon == 1){
                    $('#modal_checkbox_canon').prop('checked', true);
                }else{
                    $('#modal_checkbox_canon').prop('checked', false);
                }
                estado_civil = $(this).data('id_estado_civil');
                if (estado_civil == 2) {
                    $('#modal_input_nombre_conyugue').prop('disabled', false);
                    $('#modal_input_identidad_conyugue').prop('disabled', false);
                } else {
                    $('#modal_input_nombre_conyugue').prop('disabled', true);
                    $('#modal_input_identidad_conyugue').prop('disabled', true);
                    $("#modal_input_nombre_conyugue").val('');
                    $("#modal_input_identidad_conyugue").val('');
                }
                nombre_conyugue = $(this).data('nombre_conyugue');
                domicilio = $(this).data('direccion');
                ubicacion_casa = $(this).data('ubicacion_casa');
                $("#modal_input_primer_nombre").val(primer_nombre);
                $("#modal_input_segundo_nombre").val(segundo_nombre);
                $("#modal_input_primer_apellido").val(primer_apellido);
                $("#modal_input_segundo_apellido").val(segundo_apellido);
                $("#modal_input_telefono").val(telefono);
                $("#modal_input_identidad").val(identidad);
                $("#modal_input_numero_poliza").val(numero_poliza);
                $("#modal_select_tipo_sangre").val(tipo_sangre);
                $("#modal_select_talla_camisa").val(talla_camisa);
                $("#modal_select_talla_pantalon").val(talla_pantalon);
                $("#modal_select_estado_civil").val(estado_civil);
                $("#modal_input_nombre_conyugue").val(nombre_conyugue);
                $("#modal_input_domicilio").val(domicilio);
                $('#div_modal_select_contrato').hide();
                $('#div_modal_fecha_inicio_contrato').hide();
                $('#div_modal_fecha_finalizacion_contrato').hide();
                //console.log(ubicacion_casa);
                if (marker) {
                    marker.setLatLng(ubicacion_casa);
                } else {
                    marker = L.marker(ubicacion_casa).addTo(map);
                }
                ubicacion_casa = '{"lat": '+ubicacion_casa.lat.toString() + ', "lng": ' + ubicacion_casa.lng.toString()+'}';
                $("#ubicacion_casa").val(ubicacion_casa);
                const el = document.querySelector("#modal_nuevo_empleado");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            });

            $('#sdatatable tbody').on('click', '.eliminar', function() {
                accion = 3;
                id = $(this).data('id');;
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show(); 
            });

            $("#btn_nuevo_empleado").on("click", function (event) {
                map.setView([15.199999, -86.241905], 6);
                if (marker) {
                    map.removeLayer(marker);
                    marker = null;
                }
                $("#modal_input_primer_nombre").val('');
                $("#modal_input_segundo_nombre").val('');
                $("#modal_input_primer_apellido").val('');
                $("#modal_input_segundo_apellido").val('');
                $("#modal_input_telefono").val('');
                $("#modal_input_identidad").val('');
                $('#modal_checkbox_poliza').prop('checked', false);
                $('#modal_input_numero_poliza').prop('disabled', true);
                $("#modal_input_numero_poliza").val('');
                $("#modal_select_tipo_sangre").val('');
                $("#modal_select_talla_camisa").val('');
                $("#modal_select_talla_pantalon").val('');
                $('#modal_checkbox_seguro_social').prop('checked', false);
                $('#modal_checkbox_rap').prop('checked', false);
                $('#modal_checkbox_canon').prop('checked', false);
                $("#modal_select_estado_civil").val('');
                $('#modal_input_nombre_conyugue').prop('disabled', true);
                $("#modal_input_nombre_conyugue").val('');
                $('#modal_input_identidad_conyugue').prop('disabled', true);
                $("#modal_input_identidad_conyugue").val('');
                $("#modal_input_domicilio").val('');
                $("#modal_select_contrato").val('');
                $('#modal_fecha_inicio_contrato').val('');
                $('#modal_fecha_inicio_contrato').prop('disabled', true);
                $('#modal_fecha_finalizacion_contrato').val('');
                $('#modal_fecha_finalizacion_contrato').prop('disabled', true);
                $('#div_modal_select_contrato').show();
                $('#div_modal_fecha_inicio_contrato').show();
                $('#div_modal_fecha_finalizacion_contrato').show();
                
                
                accion = 1;
                $('#accion').val(accion);
                const el = document.querySelector("#modal_nuevo_empleado");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            });

            $('#modal_checkbox_poliza').change(function(){
                if ($(this).is(':checked')) {
                    $('#modal_input_numero_poliza').prop('disabled', false);
                } else {
                    $('#modal_input_numero_poliza').prop('disabled', true);
                    $("#modal_input_numero_poliza").val('');
                }
            });

            $('#modal_select_estado_civil').change(function(){
                estado_civil = $("#modal_select_estado_civil").val();
                if (estado_civil == 2) {
                    $('#modal_input_nombre_conyugue, #modal_input_identidad_conyugue').prop('disabled', false);
                } else {
                    $('#modal_input_nombre_conyugue, #modal_input_identidad_conyugue').prop('disabled', true);
                    $("#modal_input_nombre_conyugue, #modal_input_identidad_conyugue").val('');
                }
            });

            $('#modal_select_contrato').change(function(){
                $('#modal_fecha_inicio_contrato').prop('disabled', false);
                const selectedOption = this.options[this.selectedIndex];
                id_contrato = selectedOption.getAttribute('data-valueId');
                contrato_meses = selectedOption.getAttribute('data-valueMeses');
                calcular_meses();
            });

            $('#modal_fecha_inicio_contrato').change(function(){
                calcular_meses();
            })

            $("#modal_btn_guardar_empleados").on("click", function () {
                primer_nombre = $("#modal_input_primer_nombre").val();
                segundo_nombre = $("#modal_input_segundo_nombre").val();
                primer_apellido = $("#modal_input_primer_apellido").val();
                segundo_apellido = $("#modal_input_segundo_apellido").val();
                telefono = $("#modal_input_telefono").val();
                identidad = $("#modal_input_identidad").val();
                check_seguro_vida = $("#modal_checkbox_poliza").prop('checked');
                numero_poliza = $("#modal_input_numero_poliza").val();
                tipo_sangre = $("#modal_select_tipo_sangre").val();
                talla_camisa = $("#modal_select_talla_camisa").val();
                talla_pantalon = $("#modal_select_talla_pantalon").val();
                check_seguro_social = $("#modal_checkbox_seguro_social").prop('checked');
                check_rap = $("#modal_checkbox_rap").prop('checked');
                check_canon = $("#modal_checkbox_canon").prop('checked');
                estado_civil = $("#modal_select_estado_civil").val();
                nombre_conyugue = $("#modal_input_nombre_conyugue").val();
                domicilio = $("#modal_input_domicilio").val();
                fecha_inicio_contrato = $("#modal_fecha_inicio_contrato").val();
                fecha_finalizacion_contrato = $("#modal_fecha_finalizacion_contrato").val();

                //console.log(ubicacion_casa);
                
                if(primer_nombre == null || primer_nombre == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Primer Nombre.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(primer_apellido == null || primer_apellido == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Primer Apellido.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(telefono == null || telefono == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para telefono.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(identidad == null || identidad == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Identidad.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(check_seguro_vida == null || check_seguro_vida == true){
                    if(numero_poliza == null || numero_poliza == ''){
                        titleMsg = 'Valor Requerido'
                        textMsg = 'Debe especificar un valor para Número de Póliza.';
                        typeMsg = 'error';
                        notificacion()
                        return false;
                    }
                }

                if (estado_civil == 2) {
                    if(nombre_conyugue == null || nombre_conyugue == ''){
                        titleMsg = 'Valor Requerido'
                        textMsg = 'Debe especificar un valor para Nombre Conyugue.';
                        typeMsg = 'error';
                        notificacion()
                        return false;
                    }
                }

                if(domicilio == null || domicilio == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Domicilio.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(ubicacion_casa == null || ubicacion_casa == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un Punto Ubicación en el Mapa.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }
                
                if(!accion_guardar){
                    guardar_empleados();
                }
            });

            $("#btn_eliminar").on("click", function () {
                guardar_empleados();
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.hide();
            });

            function calcular_meses(){
                var today = null;
                var fecha_inicio_contrato = $("#modal_fecha_inicio_contrato").val();
                if (fecha_inicio_contrato == null || fecha_inicio_contrato == ''){
                    today = new Date();
                    console.log(today);
                }else{
                    today = new Date(fecha_inicio_contrato);
                    today.setDate(today.getDate() + 1);
                    console.log(today);
                }
                const year = today.getFullYear();
                const month = today.getMonth()
                const monthFormath = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0'); // Añade ceros a la izquierda si es necesario

                const todayString = `${year}-${monthFormath}-${day}`;
                $("#modal_fecha_inicio_contrato").val(todayString);

                    if (contrato_meses != 0) {
                        $('#modal_fecha_finalizacion_contrato').prop('disabled', false);
                        today.setMonth(today.getMonth() + parseInt(contrato_meses));
                        // if (today.getMonth() === 0) {
                        //     today.setFullYear(today.getFullYear() + 1);
                        // }
                        const anio = today.getFullYear();
                        const mes = String(today.getMonth() + 1).padStart(2, '0');
                        const dia = String(today.getDate()).padStart(2, '0');
                        const nextMonthString = `${anio}-${mes}-${dia}`;
                        $("#modal_fecha_finalizacion_contrato").val(nextMonthString);
                    } else {
                        $('#modal_fecha_finalizacion_contrato').prop('disabled', true);
                        $("#modal_fecha_finalizacion_contrato").val('');
                    }
            }

            function guardar_empleados() {
                accion_guardar = true;
                $.ajax({
                    type: "POST",
                    url: url_guardar_empleado,
                    data: {
                        'accion' : accion,
                        'id' : id,
                        'primer_nombre' : primer_nombre,
                        'segundo_nombre' : segundo_nombre,
                        'primer_apellido' : primer_apellido,
                        'segundo_apellido' : segundo_apellido,
                        'telefono' : telefono,
                        'identidad' : identidad,
                        'check_seguro_vida' : check_seguro_vida,
                        'numero_poliza' : numero_poliza,
                        'tipo_sangre' : tipo_sangre,
                        'talla_camisa' : talla_camisa,
                        'talla_pantalon' : talla_pantalon,
                        'check_seguro_social' : check_seguro_social,
                        'check_rap' : check_rap,
                        'check_canon' : check_canon,
                        'estado_civil' : estado_civil,
                        'nombre_conyugue' : nombre_conyugue,
                        'domicilio' : domicilio,
                        'ubicacion_casa' : ubicacion_casa,
                        'id_contrato' : id_contrato,
                        'fecha_inicio_contrato' : fecha_inicio_contrato,
                        'fecha_finalizacion_contrato' : fecha_finalizacion_contrato
                    },
                    success: function(data) {
                        if (data.msgError) {
                            titleMsg = "Error al Guardar";
                            textMsg = data.msgError;
                            typeMsg = "error";
                        } else {
                            titleMsg = "Datos Guardados";
                            textMsg = data.msgSuccess;
                            typeMsg = "success";
                            if(accion != 3){
                                var row = data.empleados_list;
                                var objetoUbicacion = JSON.parse(row.ubicacion_casa); 
                                var nuevoFila = [
                                    row.id, 
                                    `<img class="rounded-full" src="{{ asset('img/empleados/${row.foto}') }}" onerror="this.src='{{ asset('img/user2.png') }}'" alt="Midone Tailwind HTML Admin Template">`,
                                    row.primer_nombre+' '+row.segundo_nombre, row.primer_apellido+' '+row.segundo_apellido,
                                    row.identidad, row.telefono, row.direccion,
                                    '<button class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-warning border-warning text-slate-900 dark:border-warning editar mb-2 mr-1 editar"'+
                                        'data-id="'+row.id+'"'+  
                                        'data-primer_nombre="'+row.primer_nombre+'"'+  
                                        'data-segundo_nombre="'+row.segundo_nombre+'"'+  
                                        'data-primer_apellido="'+row.primer_apellido+'"'+  
                                        'data-segundo_apellido="'+row.segundo_apellido+'"'+  
                                        'data-identidad="'+row.identidad+'"'+ 
                                        'data-telefono="'+row.telefono+'"'+ 
                                        'data-poliza_seguro="'+row.poliza_seguro+'"'+ 
                                        'data-direccion="'+row.direccion+'"'+ 
                                        'data-seguro_social="'+row.seguro_social+'"'+ 
                                        'data-rap="'+row.rap+'"'+ 
                                        'data-declarado_canon="'+row.declarado_canon+'"'+ 
                                        'data-id_talla_camisa="'+row.id_talla_camisa+'"'+ 
                                        'data-id_talla_pantalon="'+row.id_talla_pantalon+'"'+ 
                                        'data-id_tipo_sangre="'+row.id_tipo_sangre+'"'+ 
                                        'data-id_estado_civil="'+row.id_estado_civil+'"'+ 
                                        'data-estado_civil="'+row.estado_civil+'"'+ 
                                        'data-nombre_conyugue="'+row.nombre_conyugue+'"'+ 
                                        'data-ubicacion_casa="'+"{&quot;lat&quot;: "+objetoUbicacion.lat+", &quot;lng&quot;: "+objetoUbicacion.lng+"}"+'"'+ 
                                    '><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit" data-lucide="edit" class="lucide lucide-edit stroke-1.5 h-4 w-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">'+
                                    '</path></svg></button>'+
                                    '<button class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-danger border-danger text-white dark:border-danger eliminar mb-2 mr-1 eliminar"'+
                                        'data-id="'+row.id+'"'+  
                                        'data-primer_nombre="'+row.primer_nombre+'"'+  
                                        'data-segundo_nombre="'+row.segundo_nombre+'"'+  
                                        'data-primer_apellido="'+row.primer_apellido+'"'+  
                                        'data-segundo_apellido="'+row.segundo_apellido+'"'+  
                                        'data-identidad="'+row.identidad+'"'+ 
                                        'data-telefono="'+row.telefono+'"'+ 
                                        'data-poliza_seguro="'+row.poliza_seguro+'"'+ 
                                        'data-direccion="'+row.direccion+'"'+ 
                                        'data-seguro_social="'+row.seguro_social+'"'+ 
                                        'data-rap="'+row.rap+'"'+ 
                                        'data-declarado_canon="'+row.declarado_canon+'"'+ 
                                        'data-id_talla_camisa="'+row.id_talla_camisa+'"'+ 
                                        'data-id_talla_pantalon="'+row.id_talla_pantalon+'"'+ 
                                        'data-id_tipo_sangre="'+row.id_tipo_sangre+'"'+ 
                                        'data-id_estado_civil="'+row.id_estado_civil+'"'+ 
                                        'data-estado_civil="'+row.estado_civil+'"'+ 
                                        'data-nombre_conyugue="'+row.nombre_conyugue+'"'+ 
                                        'data-ubicacion_casa="'+"{&quot;lat&quot;: "+objetoUbicacion.lat+", &quot;lng&quot;: "+objetoUbicacion.lng+"}"+'"'+ 
                                    '><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash" data-lucide="trash" class="lucide lucide-trash stroke-1.5 h-4 w-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg></button>'+
                                    '<a href="http://seprova.test/empleados/'+row.id+'/expediente" class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-primary border-primary text-white dark:border-primary mb-2 mr-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="file-text" data-lucide="file-text" class="lucide lucide-file-text stroke-1.5 h-4 w-4"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><line x1="10" y1="9" x2="8" y2="9"></line></svg></a>'
                                ]; 
                            }
                            if (accion == 1) { 
                                $('#sdatatable').DataTable().row.add(nuevoFila).draw();
                            } else if (accion == 2) { 
                                $('#sdatatable').DataTable().row(rowNumber).data(nuevoFila);
                            } else if (accion == 3) {
                                $('#sdatatable').DataTable().row(rowNumber).remove().draw();
                            }
                            
                        }
                        notificacion(); 
                        accion_guardar = false;
                        const el = document.querySelector("#modal_nuevo_empleado");
                        const modal = tailwind.Modal.getOrCreateInstance(el);
                        modal.hide();
                    },
                });
            }

            function notificacion() {
                var type = null;

                if (typeMsg == "success") {
                    type = "#success-notification-content";
                }
                if (typeMsg == "error") {
                    typeMsg = "danger";
                    type = "#danger-notification-content";
                }
                
                $("#"+typeMsg+"-notification").html('<div class="font-medium">' + titleMsg + "</div>" + '<div class="mt-1 text-slate-500">' + textMsg + "</div>");

                Toastify({
                    node: $(type).clone().removeClass("hidden")[0],
                    duration: 5000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                }).showToast();
            }

        </script>
    @endpush
@endonce