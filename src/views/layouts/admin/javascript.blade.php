<!-- javascript-->
{{ HTML::script('js/admin-all.js') }}

<!-- JS Include -->
@section('jsInclude')
@show
<!-- JS Include Form -->
@section('jsIncludeForm')
@show

<script>
    var url   = location.href;
    var parts = url.split('#');

    if (parts[1] != null) {
        $('#'+ parts[1]).parent().addClass('active');
        $('#ajaxContent').html('<i class="fa fa-spinner fa-spin"></i>');
        $('#ajaxContent').load($('#'+ parts[1]).attr('data-location'));
    } else {
        $('#dashboard').parent().addClass('active');
        $('#ajaxContent').html('<i class="fa fa-spinner fa-spin"></i>');
        $('#ajaxContent').load($('#dashboard').attr('data-location'));
    }
    $('.ajaxLink').click(function() {

        $('.ajaxLink').parent().removeClass('active');
        $(this).parent().addClass('active');

        var link = $(this).attr('data-location');

        $('#ajaxContent').html('<i class="fa fa-spinner fa-spin"></i>');
        $('#ajaxContent').load(link);
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $(document).ready(function() {
        $('#side-menu').metisMenu();

        bootbox.setDefaults({backdrop: false});

        $("a.confirm-remove").click(function(e) {
            e.preventDefault();
            var location = $(this).attr('href');
            bootbox.dialog({
                message: "Are you sure you want to remove this item?",
                buttons: {
                    success: {
                        label: "Yes",
                        className: "btn-primary",
                        callback: function() {
                            window.location.replace(location);
                        }
                    },
                    danger: {
                        label: "No",
                        className: "btn-primary"
                    }
                }
            });
        });
        $("a.confirm-continue").click(function(e) {
            e.preventDefault();
            var location = $(this).attr('href');
            bootbox.dialog({
                message: "Are you sure you want to continue?",
                buttons: {
                    danger: {
                        label: "No",
                        className: "btn-primary"
                    },
                    success: {
                        label: "Yes",
                        className: "btn-primary",
                        callback: function() {
                            window.location.replace(location);
                        }
                    },
                }
            });
        });

        // Work around for multi data toggle modal
        // http://stackoverflow.com/questions/12286332/twitter-bootstrap-remote-modal-shows-same-content-everytime
        $('body').on('hidden.bs.modal', '#modal', function () {
            $(this).removeData('modal');
        });
        $("div[id$='Modal']").on('hidden.bs.modal',
            function () {
                $(this).removeData('bs.modal');
            }
        );
        $("div[id$='modal']").on('hidden.bs.modal',
            function () {
                $(this).removeData('bs.modal');
            }
        );

        Messenger.options = {
            extraClasses: 'messenger-fixed {{ isset($this->activeUser) ? $this->activeUser->alertLocation : "messenger-on-top" }}',
            theme: 'future'
        }

        var mainErrors = {{ (Session::get('errors') != null ? json_encode(implode('<br />', Session::get('errors')->all())) : 0) }};
        var mainStatus = {{ (Session::get('message') != null ? json_encode(Session::get('message')) : 0) }};
        var mainLogins = {{ (Session::get('login_errors') != null ? json_encode(Session::get('login_errors')) : 0) }};

        if (mainLogins == true) {
            Messenger().post({
                message: mainLogins,
                type: 'error',
                showCloseButton: true
            });
        }
        if (mainErrors != 0) {
            Messenger().post({
                message: mainErrors,
                type: 'error',
                showCloseButton: true
            });
        }
        if (mainStatus != 0) {
            Messenger().post({
                message: mainStatus,
                showCloseButton: true
            });
        }

        $('#remoteModal').on('click', '.closeModal', function (e) {
            var area = $(e.target).data('area');

            $('#remoteModal').modal('hide');

            $('#customizeArea').html('<i class="fa fa-spinner fa-spin"></i>');
            $('#customizeArea').load('/admin/user/'+ area +'-customize');
        });

        // On Ready Js
        @section('onReadyJs')
        @show
        // On Ready Js Form
        @section('onReadyJsForm')
        @show
    });
</script>

<!-- JS -->
@section('js')
@show
<!-- JS Form -->
@section('jsForm')
@show