(function ($) {


    showToast = function (title, text, type) {
        'use strict';
        resetToastPosition();

        switch (type) {
            case 'danger':
                $.toast({
                    heading: title,
                    text: text,
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f2a654',
                    position: 'top-right'
                })
                break;

            case 'success':
                $.toast({
                    heading: title,
                    text: text,
                    showHideTransition: 'slide',
                    icon: 'success',
                    loaderBg: '#f96868',
                    position: 'top-right'
                })
                break;

            case 'info':
                $.toast({
                    heading: title,
                    text: text,
                    showHideTransition: 'slide',
                    icon: 'info',
                    loaderBg: '#46c35f',
                    position: 'top-right'
                })
                break;
            case 'warning':
                $.toast({
                    heading: title,
                    text: text,
                    showHideTransition: 'slide',
                    icon: 'warning',
                    loaderBg: '#57c7d4',
                    position: 'top-right'
                })
                break;

        }
    }
    showToastInCustomPosition = function () {
        'use strict';
        resetToastPosition();
        $.toast({
            heading: 'Custom positioning',
            text: 'Specify the custom position object or use one of the predefined ones',
            icon: 'info',
            position: {
                left: 120,
                top: 120
            },
            stack: false,
            loaderBg: '#f96868'
        })
    }
    resetToastPosition = function () {
        $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
        $(".jq-toast-wrap").css({
            "top": "",
            "left": "",
            "bottom": "",
            "right": ""
        }); //to remove previous position style
    }
})(jQuery);
