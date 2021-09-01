@extends('admin::default')

@section('title', __($namespace.'::general.social_media'))

@push('scripts')

    <script>

        $(document).ready(function () {

            // Custom options

             $('#target').iconpicker({

                 align: 'left', // Only in div tag

                 arrowClass: 'btn-danger',

                 arrowPrevIconClass: 'fas fa-angle-left',

                 arrowNextIconClass: 'fas fa-angle-right',

                 cols: 7,

                 footer: false,

                 header: false,

                 icon: 'fas fa-bomb',

                 iconset: {
                     iconClass: 'fontawesome5',
                     icons: [

                         'fab fa-youtube',

                         'fab fa-youtube-square',

                         'fab fa-yahoo',

                         'fab fa-vimeo',

                         'fab fa-vimeo-v',

                         'fab fa-vimeo-square',

                         'fab fa-whatsapp',

                         'fab fa-whatsapp-square',

                         'fab fa-viber',

                         'fab fa-tumblr',

                         'fab fa-tumblr-square',

                         'fab fa-twitter',

                         'fab fa-twitter-square',

                         'fab fa-tripadvisor',

                         'fab fa-stack-overflow',

                         'fab fa-slack',

                         'fab fa-slack-hash',

                         'fab fa-skype',

                         'fab fa-pinterest',

                         'fab fa-pinterest-p',

                         'fab fa-pinterest-square',

                         'fab fa-paypal',

                         'fab fa-linkedin-in',

                         'fab fa-linkedin',

                         'fab fa-instagram',

                         'fab fa-google-plus-g',

                         'fab fa-google-plus-square',

                         'fab fa-google',

                         'fab fa-google-drive',

                         'fab fa-google-plus',

                         'fab fa-github',

                         'fab fa-github-alt',

                         'fab fa-github-square',

                         'fab fa-facebook-square',

                         'fab fa-facebook-messenger',

                         'fab fa-facebook-f',

                         'fab fa-facebook',

                         'fab fa-airbnb'

                     ]
                 },

                 labelHeader: '{0} of {1} pages',

                 labelFooter: '{0} - {1} of {2} icons',

                 placement: 'bottom',
                 // Only in button tag

                 rows: 5,

                 search: true,

                 searchText: 'Search',

                 selectedClass: 'btn-success',

                 unselectedClass: ''

             });


             $('#target').on('change', function(e) {

                 $('#icon').val(e.icon);

             });
         });

     </script>

@endpush

