@extends('../layouts/' . $layout)

@section('subhead')
    <title>Contratos</title>
@endsection

@section('subcontent')
<!-- BEGIN: Profile Info -->
<div class="intro-y box mt-5 px-5 pt-5">
    <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
        <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
            <x-base.lucide class="h-40 w-40" icon="file-text" />
            <div class="ml-5">
                <div class="w-240 truncate text-lg font-medium sm:w-80 sm:whitespace-normal">
                    <h1 class="text-5xl font-medium leading-none">Contratos</h1>
                </div>
                <div class="text-slate-500">Pantalla de administración de contratos.</div>
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
                        <span class="text-white-700"> Lista de Contratos</span>
                    </div>
                </h3>
            </div>
        </div>
        <div class="intro-y col-span-6 lg:col-span-6 text-right">
            <div class="p-5">
                <x-base.button class="mb-2 mr-1" variant="primary" id="btn_nuevo_contrato">
                    <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                    Registrar Nuevo Contrato
                </x-base.button>
            </div>
        </div>
    </div>
    <div class="scrollbar-hidden overflow-x-auto">
        <table id="sdatatable" class="display datatable" style="width:100%">
            <thead>
                <tr class="bg-dark text-white">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Salario</th>
                    <th>Liquidación</th>
                    <th>Tipo</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contratos as $row)
                    <tr>
                        <td>{{$row->id}}</td>
                        <td>{{$row->nombre}}</td>
                        <td>{{$row->salario_formato}}</td>
                        <td>{{$row->liquidacion_formato}}</td>
                        <td>{{$row->descripcion}}</td>
                        <td>{{$row->ubicacion}}</td>
                        <td>
                            <x-base.button
                                class="mb-2 mr-1 editar"
                                variant="warning"
                                size="sm"
                                data-id="{{$row->id}}" 
                                data-nombre="{{$row->nombre}}" 
                                data-salario="{{$row->salario}}" 
                                data-liquidacion="{{$row->liquidacion}}" 
                                data-descripcion="{{$row->descripcion}}" 
                                data-ubicacion="{{$row->ubicacion}}"
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
                                data-nombre="{{$row->nombre}}" 
                                data-salario="{{$row->salario}}" 
                                data-liquidacion="{{$row->liquidacion}}" 
                                data-descripcion="{{$row->descripcion}}" 
                                data-ubicacion="{{$row->ubicacion}}"
                            >
                                <x-base.lucide
                                    class="h-4 w-4"
                                    icon="Trash"
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
<x-base.dialog id="modal_nuevo_contrato" size="xl">
    <x-base.dialog.panel>
        <x-base.dialog.title class="bg-primary">
            <h2 class="mr-auto text-white font-medium">
                <div class="flex items-center">
                    <i data-lucide="Plus" class="w-4 h-4 mr-1"></i>
                    <span class="text-white-700"> Registrar Nuevo Contrato</span>
                </div>
            </h2>
        </x-base.dialog.title>
        <x-base.dialog.description class="grid grid-cols-12 gap-4 gap-y-3">
            <div class="col-span-12 md:col-span-12 lg:col-span-12">
                <x-base.form-label class="font-extrabold" for="modal_input_nombre_contrato">
                    Nombre del Contrato
                </x-base.form-label>
                <x-base.form-input id="modal_input_nombre_contrato" type="text" placeholder="Escriba el Nombre del Contrato" />
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-6">
                <x-base.form-label class="font-extrabold" for="modal_input_salario_contrato">
                    Salario
                </x-base.form-label>
                <x-base.form-input id="modal_input_salario_contrato" type="number" placeholder="Asigne el Salario del Contrato" />
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-6">
                <x-base.form-label class="font-extrabold" for="modal_input_liquidacion_contrato">
                    Liquidación
                </x-base.form-label>
                <x-base.form-input id="modal_input_liquidacion_contrato" type="number" placeholder="Asigne la Liquidación del Contrato" />
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-6">
                <x-base.form-label class="font-extrabold" for="modal_select_tipo_contrato">
                    Tipo de Contrato
                </x-base.form-label>
                <x-base.form-select id="modal_select_tipo_contrato" class="w-full">
                    @foreach($tipos_contratos as $row)
                        <option value="{{$row->id}}">{{$row->descripcion}}</option>
                    @endforeach
                </x-base.form-select>
            </div>
            <div class="col-span-12 md:col-span-12 lg:col-span-6">
                <x-base.form-label class="font-extrabold" for="modal_select_ubicacion_contrato">
                    Ubicación del Contrato
                </x-base.form-label>
                <x-base.form-select id="modal_select_ubicacion_contrato" class="w-full">
                    @foreach($ubicaciones as $row)
                        <option value="{{$row->id}}">{{$row->nombre}}</option>
                    @endforeach
                </x-base.form-select>
            </div>
        </x-base.dialog.description>
        <x-base.dialog.footer class="bg-dark">
            <x-base.button size="sm" class="mr-1 w-20" data-tw-dismiss="modal" type="button" variant="danger">
                Cancelar
            </x-base.button>
            <x-base.button size="sm" class="w-20" type="button" variant="primary" id="modal_btn_guardar_contratos">
                Guardar
            </x-base.button>
        </x-base.dialog.footer>
    </x-base.dialog.panel>
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
            var nombre_contrato = null;
            var salario_contrato = null;
            var liquidacion_contrato = null;
            var segundo_apellido = null;
            var telefono = null;
            var identidad = null;
            var check_seguro_vida = null;
            var numero_poliza = null;
            var tipo_contrato = null;
            var ubicacion_contrato = null;
            var talla_pantalon = null;
            var check_seguro_social = null;
            var check_rap = null;
            var check_canon = null;
            var nombre_conyugue = null;
            var domicilio = null;
            var ubicacion_casa = null;
            var map = null;
            var marker = null;
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
                nombre_contrato = $(this).data('nombre_contrato');
                salario_contrato = $(this).data('salario_contrato');
                liquidacion_contrato = $(this).data('liquidacion_contrato');
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
                tipo_contrato = $(this).data('id_tipo_contrato');
                ubicacion_contrato = $(this).data('id_ubicacion_contrato');
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
                nombre_conyugue = $(this).data('nombre_conyugue');
                domicilio = $(this).data('direccion');
                ubicacion_casa = $(this).data('ubicacion_casa');
                $("#modal_input_nombre_contrato").val(nombre_contrato);
                $("#modal_input_salario_contrato").val(salario_contrato);
                $("#modal_input_liquidacion_contrato").val(liquidacion_contrato);
                $("#modal_input_segundo_apellido").val(segundo_apellido);
                $("#modal_input_telefono").val(telefono);
                $("#modal_input_identidad").val(identidad);
                $("#modal_input_numero_poliza").val(numero_poliza);
                $("#modal_select_tipo_contrato").val(tipo_contrato);
                $("#modal_select_ubicacion_contrato").val(ubicacion_contrato);
                $("#modal_select_talla_pantalon").val(talla_pantalon);
                $("#modal_input_nombre_conyugue").val(nombre_conyugue);
                $("#modal_input_domicilio").val(domicilio);
                //console.log(ubicacion_casa);
                if (marker) {
                    marker.setLatLng(ubicacion_casa);
                } else {
                    marker = L.marker(ubicacion_casa).addTo(map);
                }
                ubicacion_casa = '{"lat": '+ubicacion_casa.lat.toString() + ', "lng": ' + ubicacion_casa.lng.toString()+'}';
                const el = document.querySelector("#modal_nuevo_contrato");
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

            $("#btn_nuevo_contrato").on("click", function (event) {
                $("#modal_input_nombre_contrato").val('');
                $("#modal_input_salario_contrato").val('');
                $("#modal_input_liquidacion_contrato").val('');
                $("#modal_select_tipo_contrato").val('');
                $("#modal_select_ubicacion_contrato").val('');
                accion = 1;
                const el = document.querySelector("#modal_nuevo_contrato");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.show();
            });

            $("#modal_btn_guardar_contratos").on("click", function () {
                nombre_contrato = $("#modal_input_nombre_contrato").val();
                salario_contrato = $("#modal_input_salario_contrato").val();
                liquidacion_contrato = $("#modal_input_liquidacion_contrato").val();
                tipo_contrato = $("#modal_select_tipo_contrato").val();
                ubicacion_contrato = $("#modal_select_ubicacion_contrato").val();
                
                if(nombre_contrato == null || nombre_contrato == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Nombre del Contrato.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(salario_contrato == null || salario_contrato == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para el Salario.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(liquidacion_contrato == null || liquidacion_contrato == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para la Liquidación.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(tipo_contrato == null || tipo_contrato == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Tipo de Contrato.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }

                if(ubicacion_contrato == null || ubicacion_contrato == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Ubicación de Contrato.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
                }
                
                // if(!accion_guardar){
                //     guardar_empleados();
                // }
            });

            $("#btn_eliminar").on("click", function () {
                guardar_empleados();
                const el = document.querySelector("#modal_eliminar");
                const modal = tailwind.Modal.getOrCreateInstance(el);
                modal.hide();
            });

            function guardar_empleados() {
                accion_guardar = true;
                $.ajax({
                    type: "POST",
                    url: url_guardar_empleado,
                    data: {
                        'accion' : accion,
                        'id' : id,
                        'nombre_contrato' : nombre_contrato,
                        'salario_contrato' : salario_contrato,
                        'liquidacion_contrato' : liquidacion_contrato,
                        'segundo_apellido' : segundo_apellido,
                        'telefono' : telefono,
                        'identidad' : identidad,
                        'check_seguro_vida' : check_seguro_vida,
                        'numero_poliza' : numero_poliza,
                        'tipo_contrato' : tipo_contrato,
                        'ubicacion_contrato' : ubicacion_contrato,
                        'talla_pantalon' : talla_pantalon,
                        'check_seguro_social' : check_seguro_social,
                        'check_rap' : check_rap,
                        'check_canon' : check_canon,
                        'nombre_conyugue' : nombre_conyugue,
                        'domicilio' : domicilio,
                        'ubicacion_casa' : ubicacion_casa
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
                                    row.nombre_contrato+' '+row.salario_contrato, row.liquidacion_contrato+' '+row.segundo_apellido,
                                    row.identidad, row.telefono, row.direccion,
                                    '<button class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-warning border-warning text-slate-900 dark:border-warning editar mb-2 mr-1 editar"'+
                                        'data-id="'+row.id+'"'+  
                                        'data-nombre_contrato="'+row.nombre_contrato+'"'+  
                                        'data-salario_contrato="'+row.salario_contrato+'"'+  
                                        'data-liquidacion_contrato="'+row.liquidacion_contrato+'"'+  
                                        'data-segundo_apellido="'+row.segundo_apellido+'"'+  
                                        'data-identidad="'+row.identidad+'"'+ 
                                        'data-telefono="'+row.telefono+'"'+ 
                                        'data-poliza_seguro="'+row.poliza_seguro+'"'+ 
                                        'data-direccion="'+row.direccion+'"'+ 
                                        'data-seguro_social="'+row.seguro_social+'"'+ 
                                        'data-rap="'+row.rap+'"'+ 
                                        'data-declarado_canon="'+row.declarado_canon+'"'+ 
                                        'data-id_ubicacion_contrato="'+row.id_ubicacion_contrato+'"'+ 
                                        'data-id_talla_pantalon="'+row.id_talla_pantalon+'"'+ 
                                        'data-id_tipo_contrato="'+row.id_tipo_contrato+'"'+ 
                                        'data-nombre_conyugue="'+row.nombre_conyugue+'"'+ 
                                        'data-ubicacion_casa="'+"{&quot;lat&quot;: "+objetoUbicacion.lat+", &quot;lng&quot;: "+objetoUbicacion.lng+"}"+'"'+ 
                                    '><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="edit" data-lucide="edit" class="lucide lucide-edit stroke-1.5 h-4 w-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">'+
                                    '</path></svg></button>'+
                                    '<button class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-xs py-1.5 px-2 bg-danger border-danger text-white dark:border-danger eliminar mb-2 mr-1 eliminar"'+
                                        'data-id="'+row.id+'"'+  
                                        'data-nombre_contrato="'+row.nombre_contrato+'"'+  
                                        'data-salario_contrato="'+row.salario_contrato+'"'+  
                                        'data-liquidacion_contrato="'+row.liquidacion_contrato+'"'+  
                                        'data-segundo_apellido="'+row.segundo_apellido+'"'+  
                                        'data-identidad="'+row.identidad+'"'+ 
                                        'data-telefono="'+row.telefono+'"'+ 
                                        'data-poliza_seguro="'+row.poliza_seguro+'"'+ 
                                        'data-direccion="'+row.direccion+'"'+ 
                                        'data-seguro_social="'+row.seguro_social+'"'+ 
                                        'data-rap="'+row.rap+'"'+ 
                                        'data-declarado_canon="'+row.declarado_canon+'"'+ 
                                        'data-id_ubicacion_contrato="'+row.id_ubicacion_contrato+'"'+ 
                                        'data-id_talla_pantalon="'+row.id_talla_pantalon+'"'+ 
                                        'data-id_tipo_contrato="'+row.id_tipo_contrato+'"'+ 
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
                        const el = document.querySelector("#modal_nuevo_contrato");
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