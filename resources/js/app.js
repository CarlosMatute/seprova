import "./bootstrap";
import "./vendor/dom";
import "./vendor/tailwind-merge";
import "./vendor/svg-loader";
import $ from 'jquery';
window.$ = window.jQuery = $;
import 'datatables.net'; 
import 'datatables.net-dt/css/dataTables.dataTables.css'
import '../css/fixdatatable/arreglarcasilla.css';
// Load static files
import.meta.glob(["../images/**"]);