import './styles/app.scss';

const $ = require('jquery');
global.$ = global.jQuery = $;

require( 'datatables.net-bs4/js/dataTables.bootstrap4' );

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');