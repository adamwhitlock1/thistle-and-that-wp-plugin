# thistle-and-that

This custom application built into Wordpress is used to provide a unique customer experience for creating and customizing a DIY wedding flower package. Users can create an account, and configure their ideal flower arrangements while paying significantly less than traditional wedding flower bouquets and arrangements.

## Technical stack details

* Wordpress with WooCommerce
* Advanced Custom Fields for custom user profile information
* Woo360 based drag and drop site builder
* Plugin based application that provides a specific Woo360 module
* Material Design Styling through Vue-Material
* REST api calls for data hydration
* Vimeo Video integration into gated content pages
* Advanced composite product creation and management

* Vue.js front end framework for rendering and dynamic data binding
  * Vuex for state management
  * AOS for animations
  * Flatpickr date picker
  * Sticky-js
  * Vuelidate form validation
  * Vue-swatches
  * Vue-select
  * Vue-Resource for ajax and REST calls
  * Webpack w/uglify, babel, optimize-css, and bundle analyzer


### WooCommerce api keys (for read only development)

__Consumer Key:__

`ck_2e8cee8764ecebe01f73721f381551c7e5a259a3`

__Consumer Secret:__

`cs_79f6b0bcbfa64cd718e581e05f1052a9d3506310`

### Development scripts

npm  of yarn can be used for package installation

`yarn dev`

`yarn build`

Current development best practices include:
Eslist, Prettier, Vetur, and Github Version control.