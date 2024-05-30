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
<div class="intro-y mt-8 flex items-center">
        <h2 class="mr-auto text-lg font-medium">Profile Layout</h2>
    </div>
    <x-base.tab.group>
        <!-- BEGIN: Profile Info -->
        <div class="intro-y box mt-5 px-5 pt-5">
            <div class="-mx-5 flex flex-col border-b border-slate-200/60 pb-5 dark:border-darkmode-400 lg:flex-row">
                <div class="flex flex-1 items-center justify-center px-5 lg:justify-start">
                    <div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                        <img
                            class="rounded-full"
                            src="{{ Vite::asset('resources/images/logo.svg') }}"
                            alt="Midone Tailwind HTML Admin Template"
                        />
                        <div
                            class="absolute bottom-0 right-0 mb-1 mr-1 flex items-center justify-center rounded-full bg-primary p-2">
                            <x-base.lucide
                                class="h-4 w-4 text-white"
                                icon="Camera"
                                id="btn_subir_foto"
                            />
                        </div>
                    </div>
                    <div class="ml-5">
                        <div class="w-24 truncate text-lg font-medium sm:w-40 sm:whitespace-normal">
                            {{ $empleado->primer_nombre }} {{ $empleado->segundo_nombre }} {{ $empleado->primer_apellido }} {{ $empleado->segundo_apellido }}
                        </div>
                        <div class="text-slate-500">Guardia de Seguridad</div>
                    </div>
                </div>
                <div
                    class="mt-6 flex-1 border-t border-l border-r border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-t-0 lg:pt-0">
                    <div class="text-center font-medium lg:mt-3 lg:text-left">
                        Información Personal
                    </div>
                    <div class="mt-4 flex flex-col items-center justify-center lg:items-start">
                        <div class="flex items-center truncate sm:whitespace-normal">
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="Smartphone"
                            />
                            {{ $empleado->telefono }}
                        </div>
                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="CreditCard"
                            />
                            {{ $empleado->identidad }}
                        </div>
                        <div class="mt-3 flex items-center truncate sm:whitespace-normal">
                            <x-base.lucide
                                class="mr-2 h-4 w-4"
                                icon="Target"
                            />
                            {{ $empleado->direccion }}
                        </div>
                    </div>
                </div>
                <!-- <div
                    class="mt-6 flex-1 border-t border-slate-200/60 px-5 pt-5 dark:border-darkmode-400 lg:mt-0 lg:border-0 lg:pt-0">
                    <div class="text-center font-medium lg:mt-5 lg:text-left">
                        Sales Growth
                    </div>
                    <div class="mt-2 flex items-center justify-center lg:justify-start">
                        <div class="mr-2 flex w-20">
                            USP:
                            <span class="ml-3 font-medium text-success">+23%</span>
                        </div>
                        <div class="w-3/4">
                            <x-simple-line-chart-1
                                class="-mr-5"
                                height="h-[55px]"
                            />
                        </div>
                    </div>
                    <div class="flex items-center justify-center lg:justify-start">
                        <div class="mr-2 flex w-20">
                            STP: <span class="ml-3 font-medium text-danger">-2%</span>
                        </div>
                        <div class="w-3/4">
                            <x-simple-line-chart-2
                                class="-mr-5"
                                height="h-[55px]"
                            />
                        </div>
                    </div>
                </div> -->
            </div>
            <x-base.tab.list
                class="flex-col justify-center text-center sm:flex-row lg:justify-start"
                variant="link-tabs"
            >
                <x-base.tab
                    id="dashboard-tab"
                    :fullWidth="false"
                    selected
                >
                    <x-base.tab.button class="cursor-pointer py-4">Dashboard</x-base.tab.button>
                </x-base.tab>
                <x-base.tab
                    id="account-and-profile-tab"
                    :fullWidth="false"
                >
                    <x-base.tab.button class="cursor-pointer py-4">
                        Account & Profile
                    </x-base.tab.button>
                </x-base.tab>
                <x-base.tab
                    id="activities-tab"
                    :fullWidth="false"
                >
                    <x-base.tab.button class="cursor-pointer py-4">
                        Activities
                    </x-base.tab.button>
                </x-base.tab>
                <x-base.tab
                    id="tasks-tab"
                    :fullWidth="false"
                >
                    <x-base.tab.button class="cursor-pointer py-4">Tasks</x-base.tab.button>
                </x-base.tab>
            </x-base.tab.list>
        </div>
        <!-- END: Profile Info -->
        <x-base.tab.panels class="intro-y mt-5">
            <x-base.tab.panel
                id="dashboard"
                selected
            >
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: Top Categories -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div class="flex items-center border-b border-slate-200/60 p-5 dark:border-darkmode-400">
                            <h2 class="mr-auto text-base font-medium">
                                Top Categories
                            </h2>
                            <x-base.menu class="ml-auto">
                                <x-base.menu.button
                                    class="block h-5 w-5"
                                    href="#"
                                    tag="a"
                                >
                                    <x-base.lucide
                                        class="h-5 w-5 text-slate-500"
                                        icon="MoreHorizontal"
                                    />
                                </x-base.menu.button>
                                <x-base.menu.items class="w-40">
                                    <x-base.menu.item>
                                        <x-base.lucide
                                            class="mr-2 h-4 w-4"
                                            icon="Plus"
                                        /> Add
                                        Category
                                    </x-base.menu.item>
                                    <x-base.menu.item>
                                        <x-base.lucide
                                            class="mr-2 h-4 w-4"
                                            icon="Settings"
                                        />
                                        Settings
                                    </x-base.menu.item>
                                </x-base.menu.items>
                            </x-base.menu>
                        </div>
                        <div class="p-5">
                            <div class="flex flex-col sm:flex-row">
                                <div class="mr-auto">
                                    <a
                                        class="font-medium"
                                        href=""
                                    >
                                        Wordpress Template
                                    </a>
                                    <div class="mt-1 text-slate-500">
                                        HTML, PHP, Mysql
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="mt-5 mr-auto -ml-2 w-32 sm:ml-0 sm:mr-5">
                                        <x-simple-line-chart height="h-[30px]" />
                                    </div>
                                    <div class="text-center">
                                        <div class="font-medium">6.5k</div>
                                        <div class="mt-1.5 rounded bg-success/20 px-2 text-success">
                                            +150
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 flex flex-col sm:flex-row">
                                <div class="mr-auto">
                                    <a
                                        class="font-medium"
                                        href=""
                                    >
                                        Bootstrap HTML Template
                                    </a>
                                    <div class="mt-1 text-slate-500">
                                        HTML, PHP, Mysql
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="mt-5 mr-auto -ml-2 w-32 sm:ml-0 sm:mr-5">
                                        <x-simple-line-chart height="h-[30px]" />
                                    </div>
                                    <div class="text-center">
                                        <div class="font-medium">2.5k</div>
                                        <div class="mt-1.5 rounded bg-pending/10 px-2 text-pending">
                                            +150
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 flex flex-col sm:flex-row">
                                <div class="mr-auto">
                                    <a
                                        class="font-medium"
                                        href=""
                                    >
                                        Tailwind HTML Template
                                    </a>
                                    <div class="mt-1 text-slate-500">
                                        HTML, PHP, Mysql
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="mt-5 mr-auto -ml-2 w-32 sm:ml-0 sm:mr-5">
                                        <x-simple-line-chart height="h-[30px]" />
                                    </div>
                                    <div class="text-center">
                                        <div class="font-medium">3.4k</div>
                                        <div class="mt-1.5 rounded bg-primary/10 px-2 text-primary">
                                            +150
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Top Categories -->
                    <!-- BEGIN: Work In Progress -->
                    <x-base.tab.group class="intro-y box col-span-12 lg:col-span-6">
                        <div
                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-0">
                            <h2 class="mr-auto text-base font-medium">
                                Work In Progress
                            </h2>
                            <x-base.menu class="ml-auto sm:hidden">
                                <x-base.menu.button
                                    class="block h-5 w-5"
                                    href="#"
                                    tag="a"
                                >
                                    <x-base.lucide
                                        class="h-5 w-5 text-slate-500"
                                        icon="MoreHorizontal"
                                    />
                                </x-base.menu.button>
                                <x-base.menu.items class="w-40">
                                    <x-base.menu.item
                                        class="w-full"
                                        id="work-in-progress-mobile-new-tab"
                                        target="work-in-progress-new"
                                        as="x-base.tab.button"
                                        unstyled
                                        selected
                                    >
                                        New
                                    </x-base.menu.item>
                                    <x-base.menu.item
                                        class="w-full"
                                        id="work-in-progress-mobile-last-week-tab"
                                        target="work-in-progress-last-week"
                                        as="x-base.tab.button"
                                        unstyled
                                        :selected="false"
                                    >
                                        Last Week
                                    </x-base.menu.item>
                                </x-base.menu.items>
                            </x-base.menu>
                            <x-base.tab.list
                                class="ml-auto hidden w-auto sm:flex"
                                variant="link-tabs"
                            >
                                <x-base.tab
                                    id="work-in-progress-new-tab"
                                    :fullWidth="false"
                                    selected
                                >
                                    <x-base.tab.button class="cursor-pointer py-5">
                                        New
                                    </x-base.tab.button>
                                </x-base.tab>
                                <x-base.tab
                                    id="work-in-progress-last-week-tab"
                                    :fullWidth="false"
                                    :selected="false"
                                >
                                    <x-base.tab.button class="cursor-pointer py-5">
                                        Last Week
                                    </x-base.tab.button>
                                </x-base.tab>
                            </x-base.tab.list>
                        </div>
                        <div class="p-5">
                            <x-base.tab.panels>
                                <x-base.tab.panel
                                    id="work-in-progress-new"
                                    selected
                                >
                                    <div>
                                        <div class="flex">
                                            <div class="mr-auto">Pending Tasks</div>
                                            <div>20%</div>
                                        </div>
                                        <x-base.progress class="mt-2 h-1">
                                            <x-base.progress.bar
                                                class="w-1/2 bg-primary"
                                                role="progressbar"
                                                aria-valuenow="0"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></x-base.progress.bar>
                                        </x-base.progress>
                                    </div>
                                    <div class="mt-5">
                                        <div class="flex">
                                            <div class="mr-auto">Completed Tasks</div>
                                            <div>2 / 20</div>
                                        </div>
                                        <x-base.progress class="mt-2 h-1">
                                            <x-base.progress.bar
                                                class="w-1/4 bg-primary"
                                                role="progressbar"
                                                aria-valuenow="0"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></x-base.progress.bar>
                                        </x-base.progress>
                                    </div>
                                    <div class="mt-5">
                                        <div class="flex">
                                            <div class="mr-auto">Tasks In Progress</div>
                                            <div>42</div>
                                        </div>
                                        <x-base.progress class="mt-2 h-1">
                                            <x-base.progress.bar
                                                class="w-3/4 bg-primary"
                                                role="progressbar"
                                                aria-valuenow="0"
                                                aria-valuemin="0"
                                                aria-valuemax="100"
                                            ></x-base.progress.bar>
                                        </x-base.progress>
                                    </div>
                                    <x-base.button
                                        class="mx-auto mt-5 block w-40"
                                        href=""
                                        as="a"
                                        variant="secondary"
                                    >
                                        View More Details
                                    </x-base.button>
                                </x-base.tab.panel>
                            </x-base.tab.panels>
                        </div>
                    </x-base.tab.group>
                    <!-- END: Work In Progress -->
                    <!-- BEGIN: Daily Sales -->
                    <div class="intro-y box col-span-12 lg:col-span-6">
                        <div
                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-3">
                            <h2 class="mr-auto text-base font-medium">Daily Sales</h2>
                            <x-base.menu class="ml-auto sm:hidden">
                                <x-base.menu.button
                                    class="block h-5 w-5"
                                    href="#"
                                    tag="a"
                                >
                                    <x-base.lucide
                                        class="h-5 w-5 text-slate-500"
                                        icon="MoreHorizontal"
                                    />
                                </x-base.menu.button>
                                <x-base.menu.items class="w-40">
                                    <x-base.menu.item>
                                        <x-base.lucide
                                            class="mr-2 h-4 w-4"
                                            icon="File"
                                        /> Download
                                        Excel
                                    </x-base.menu.item>
                                </x-base.menu.items>
                            </x-base.menu>
                            <x-base.button
                                class="hidden sm:flex"
                                variant="outline-secondary"
                            >
                                <x-base.lucide
                                    class="mr-2 h-4 w-4"
                                    icon="File"
                                /> Download
                                Excel
                            </x-base.button>
                        </div>
                        <div class="p-5">
                            <div class="relative flex items-center">
                                <div class="image-fit h-12 w-12 flex-none">
                                    <img
                                        class="rounded-full"
                                        src="{{ Vite::asset($fakers[0]['photos'][0]) }}"
                                        alt="Midone Tailwind HTML Admin Template"
                                    />
                                </div>
                                <div class="ml-4 mr-auto">
                                    <a
                                        class="font-medium"
                                        href=""
                                    >
                                        {{ $fakers[0]['users'][0]['name'] }}
                                    </a>
                                    <div class="mr-5 text-slate-500 sm:mr-5">
                                        Bootstrap 4 HTML Admin Template
                                    </div>
                                </div>
                                <div class="font-medium text-slate-600 dark:text-slate-500">
                                    +$19
                                </div>
                            </div>
                            <div class="relative mt-5 flex items-center">
                                <div class="image-fit h-12 w-12 flex-none">
                                    <img
                                        class="rounded-full"
                                        src="{{ Vite::asset($fakers[1]['photos'][0]) }}"
                                        alt="Midone Tailwind HTML Admin Template"
                                    />
                                </div>
                                <div class="ml-4 mr-auto">
                                    <a
                                        class="font-medium"
                                        href=""
                                    >
                                        {{ $fakers[1]['users'][0]['name'] }}
                                    </a>
                                    <div class="mr-5 text-slate-500 sm:mr-5">
                                        Tailwind HTML Admin Template
                                    </div>
                                </div>
                                <div class="font-medium text-slate-600 dark:text-slate-500">
                                    +$25
                                </div>
                            </div>
                            <div class="relative mt-5 flex items-center">
                                <div class="image-fit h-12 w-12 flex-none">
                                    <img
                                        class="rounded-full"
                                        src="{{ Vite::asset($fakers[2]['photos'][0]) }}"
                                        alt="Midone Tailwind HTML Admin Template"
                                    />
                                </div>
                                <div class="ml-4 mr-auto">
                                    <a
                                        class="font-medium"
                                        href=""
                                    >
                                        {{ $fakers[2]['users'][0]['name'] }}
                                    </a>
                                    <div class="mr-5 text-slate-500 sm:mr-5">
                                        Vuejs HTML Admin Template
                                    </div>
                                </div>
                                <div class="font-medium text-slate-600 dark:text-slate-500">
                                    +$21
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Daily Sales -->
                    <!-- BEGIN: Latest Tasks -->
                    <x-base.tab.group class="intro-y box col-span-12 lg:col-span-6">
                        <div
                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-0">
                            <h2 class="mr-auto text-base font-medium">
                                Latest Tasks
                            </h2>
                            <x-base.menu class="ml-auto sm:hidden">
                                <x-base.menu.button
                                    class="block h-5 w-5"
                                    href="#"
                                    tag="a"
                                >
                                    <x-base.lucide
                                        class="h-5 w-5 text-slate-500"
                                        icon="MoreHorizontal"
                                    />
                                </x-base.menu.button>
                                <x-base.menu.items class="w-40">
                                    <x-base.menu.item
                                        class="w-full"
                                        id="latest-tasks-mobile-new-tab"
                                        target="latest-tasks-new"
                                        as="x-base.tab.button"
                                        unstyled
                                        selected
                                    >
                                        New
                                    </x-base.menu.item>
                                    <x-base.menu.item
                                        class="w-full"
                                        id="latest-tasks-mobile-last-week-tab"
                                        target="latest-tasks-last-week"
                                        as="x-base.tab.button"
                                        unstyled
                                        :selected="false"
                                    >
                                        Last Week
                                    </x-base.menu.item>
                                </x-base.menu.items>
                            </x-base.menu>
                            <x-base.tab.list
                                class="ml-auto hidden w-auto sm:flex"
                                variant="link-tabs"
                            >
                                <x-base.tab
                                    id="latest-tasks-new-tab"
                                    :fullWidth="false"
                                    selected
                                >
                                    <x-base.tab.button class="cursor-pointer py-5">
                                        New
                                    </x-base.tab.button>
                                </x-base.tab>
                                <x-base.tab
                                    id="latest-tasks-last-week-tab"
                                    :fullWidth="false"
                                    :selected="false"
                                >
                                    <x-base.tab.button class="cursor-pointer py-5">
                                        Last Week
                                    </x-base.tab.button>
                                </x-base.tab>
                            </x-base.tab.list>
                        </div>
                        <div class="p-5">
                            <x-base.tab.panels>
                                <x-base.tab.panel
                                    id="latest-tasks-new"
                                    selected
                                >
                                    <div class="flex items-center">
                                        <div class="border-l-2 border-primary pl-4 dark:border-primary">
                                            <a
                                                class="font-medium"
                                                href=""
                                            >
                                                Create New Campaign
                                            </a>
                                            <div class="text-slate-500">10:00 AM</div>
                                        </div>
                                        <x-base.form-switch class="ml-auto">
                                            <x-base.form-switch.input type="checkbox" />
                                        </x-base.form-switch>
                                    </div>
                                    <div class="mt-5 flex items-center">
                                        <div class="border-l-2 border-primary pl-4 dark:border-primary">
                                            <a
                                                class="font-medium"
                                                href=""
                                            >
                                                Meeting With Client
                                            </a>
                                            <div class="text-slate-500">02:00 PM</div>
                                        </div>
                                        <x-base.form-switch class="ml-auto">
                                            <x-base.form-switch.input type="checkbox" />
                                        </x-base.form-switch>
                                    </div>
                                    <div class="mt-5 flex items-center">
                                        <div class="border-l-2 border-primary pl-4 dark:border-primary">
                                            <a
                                                class="font-medium"
                                                href=""
                                            >
                                                Create New Repository
                                            </a>
                                            <div class="text-slate-500">04:00 PM</div>
                                        </div>
                                        <x-base.form-switch class="ml-auto">
                                            <x-base.form-switch.input type="checkbox" />
                                        </x-base.form-switch>
                                    </div>
                                </x-base.tab.panel>
                            </x-base.tab.panels>
                        </div>
                    </x-base.tab.group>
                    <!-- END: Latest Tasks -->
                    <!-- BEGIN: General Statistic -->
                    <div class="intro-y box col-span-12">
                        <div
                            class="flex items-center border-b border-slate-200/60 px-5 py-5 dark:border-darkmode-400 sm:py-3">
                            <h2 class="mr-auto text-base font-medium">
                                Ubicación de Casa
                            </h2>
                            <!-- <x-base.menu class="ml-auto sm:hidden">
                                <x-base.menu.button
                                    class="block h-5 w-5"
                                    href="#"
                                >
                                    <x-base.lucide
                                        class="h-5 w-5 text-slate-500"
                                        icon="MoreHorizontal"
                                    />
                                </x-base.menu.button>
                                <x-base.menu.items class="w-40">
                                    <x-base.menu.item>
                                        <x-base.lucide
                                            class="mr-2 h-4 w-4"
                                            icon="File"
                                        /> Download
                                        XML
                                    </x-base.menu.item>
                                </x-base.menu.items>
                            </x-base.menu>
                            <x-base.button
                                class="hidden sm:flex"
                                variant="outline-secondary"
                            >
                                <x-base.lucide
                                    class="mr-2 h-4 w-4"
                                    icon="File"
                                /> Download XML
                            </x-base.button> -->
                        </div>
                        <div class="grid grid-cols-1 gap-6 p-5 2xl:grid-cols-7">
                            <div id="map"></div>
                        </div>
                    </div>
                    <!-- END: General Statistic -->
                </div>
            </x-base.tab.panel>
        </x-base.tab.panels>
    </x-base.tab.group>
    <!-- BEGIN: Modal Content -->
    <x-base.dialog id="modal_subir_foto">
        <x-base.dialog.panel>
            <div class="p-5 text-center">
                <x-base.lucide class="mx-auto mt-3 h-16 w-16 text-primary" icon="ArrowUpCircle" />
                <form id="uploadForm" action="{{url('/empleados/foto/guardar')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-base.form-label class="font-extrabold" for="fileInput">
                        Cargar Foto del Empleado
                    </x-base.form-label>
                    <input type="text" name="id_empleado" value="{{ $empleado->id }}" required class="mb-4">
                    <input type="file" name="profile_picture" accept="image/jpeg" required class="mb-4">
                    <center> <img id="preview" class="mt-4 w-32 h-32 rounded-full object-cover hidden" src="#" alt="Image Preview"> </center>
                
                    <x-base.button class="mr-1 w-24" data-tw-dismiss="modal" type="button" variant="danger">
                        Cancelar
                    </x-base.button>
                    <x-base.button class="w-24" type="submit" variant="primary" id="btn_eliminar">
                        Cargar
                    </x-base.button>
                </form>
            </div>
        </x-base.dialog.panel>
    </x-base.dialog>
<!-- END: Modal Content -->
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
            var nombre_conyugue = null;
            var domicilio = null;
            var ubicacion_casa = "{{ $empleado->ubicacion_casa }}";
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

                    $('#fileInput').on('change', function(){
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(file);
                }
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
                    L.Icon.Default.imagePath = "/build/assets/";
                        // Obtén las coordenadas del clic
                        var coords = ubicacion_casa;
                        var jsonString = coords.replace(/&quot;/g, '"');
                        var jsonObject = JSON.parse(jsonString);
                        //coords = JSON.parse(coords);
                        //console.log(jsonObject)
                        
                        // Si ya hay un marcador, actualiza su posición
                        if (marker) {
                            marker.setLatLng(jsonObject);
                            //{"lat": 14.119429333513594,"lng": -87.18672752380373}
                        } else {
                            // Si no hay marcador, crea uno nuevo
                            marker = L.marker(jsonObject).addTo(map);
                        }
                  
                })

                

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
                $("#modal_input_nombre_conyugue").val(nombre_conyugue);
                $("#modal_input_domicilio").val(domicilio);
                //console.log(ubicacion_casa);
                if (marker) {
                    marker.setLatLng(ubicacion_casa);
                } else {
                    marker = L.marker(ubicacion_casa).addTo(map);
                }
                ubicacion_casa = '{"lat": '+ubicacion_casa.lat.toString() + ', "lng": ' + ubicacion_casa.lng.toString()+'}';
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

            $("#btn_subir_foto").on("click", function (event) {
                accion = 1;
                const el = document.querySelector("#modal_subir_foto");
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
                nombre_conyugue = $("#modal_input_nombre_conyugue").val();
                domicilio = $("#modal_input_domicilio").val();

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

                if(nombre_conyugue == null || nombre_conyugue == ''){
                    titleMsg = 'Valor Requerido'
                    textMsg = 'Debe especificar un valor para Nombre Conyugue.';
                    typeMsg = 'error';
                    notificacion()
                    return false;
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

//             $('#uploadForm').submit(function(e) {
//                 e.preventDefault();
//                 var formData = new FormData(this);
// console.log('J')
//                 // $.ajax({
//                 //     type: 'POST',
//                 //     url: $(this).attr('action'),
//                 //     data: formData,
//                 //     contentType: false,
//                 //     processData: false,
//                 //     success: function(response) {
//                 //         alert('Profile picture uploaded successfully!');
//                 //         $('#profileModal').addClass('hidden');
//                 //     },
//                 //     error: function(response) {
//                 //         alert('An error occurred while uploading the picture.');
//                 //     }
//                 // });
//             });

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
                                // var row_ubicacion_casa = JSON.parse(row.ubicacion_casa); 
                                // row_ubicacion_casa = JSON.stringify(row_ubicacion_casa);
                                //console.log(objetoUbicacion.lat);
                                var nuevoFila = [
                                    row.id, row.primer_nombre+' '+row.segundo_nombre, row.primer_apellido+' '+row.segundo_apellido,
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
                                        'data-nombre_conyugue="'+row.nombre_conyugue+'"'+ 
                                        'data-ubicacion_casa="'+"{&quot;lat&quot;: "+objetoUbicacion.lat+", &quot;lng&quot;: "+objetoUbicacion.lng+"}"+'"'+ 
                                    '><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="trash" data-lucide="trash" class="lucide lucide-trash stroke-1.5 h-4 w-4"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg></button>'
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