(function($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function() {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });


    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

    $('.select2').select2();
    $('.datepicker').datepicker({
        autoclose: true,
    });

    $('.sluggable').on('input', function (e) {
        e.preventDefault();
        var target = $(this).data('slug');
        if (target) {
            $(target).val($(this).val().toLowerCase().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-'));
        }
    });

    $.fn.confirmDelete = function (formId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data again!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                formId.submit();
            }
        });
    };

    $.fn.confirm = function (url) {
        swal({
            title: "Are you sure?",
            text: "To change status",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location.replace(url);
            }
        });
    };


    $.fn.confirmRestore = function (formId) {
        swal({
            title: "Are you sure?",
            text: "You want to restore this item!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                formId.submit();
            }
        });
    };

    if(window.matchMedia("(max-width: 767px)").matches){
        $("body").toggleClass("sidebar-toggled");
        $("#accordionSidebar").toggleClass("toggled");
    }
})(jQuery); // End of use strict
