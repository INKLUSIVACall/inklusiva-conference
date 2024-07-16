import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import '@shoelace-style/shoelace/dist/components/rating/rating.js';

/*import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss';*/

import 'htmx.org';

import * as htmx from 'htmx.org';
window.htmx = htmx;

import './bootstrap';
import "./component-alert";
import "./components/slider";
import "./components/toggle";

import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

