(function ($) {
    'use strict';
    $(function () {



        var frame,
            imgUploadButton = $('#upload_login_logo_button'),
            imgContainer = $('#upload_logo_preview'),
            imgIdInput = $('#login_logo_id'),
            imgPreview = $('#upload_logo_preview'),
            imgDelButton = $('#wp_cbf-delete_logo_button'),
            listentyDelButton = $('#delte_list_entry_button'),
            addtracklinebutton = $('#album_add_track_line_button'),
            trackcounter = 0;



        addtracklinebutton.on('click', function (event) {
            event.preventDefault();
            trackcounter++;
            //var trackcounter =0;
            console.log("TEST");
            var htmlString = '<tr><td>' + trackcounter + '. Song</td> \
                              <td> \
                            <input type="text" class="regular-text" id="track' + trackcounter + '" name="add-band[track][' + trackcounter + ']" /><br>\
                            </td></tr><div id=\"track_list\"></div>';
            $('#track_list').append(htmlString);
        });

        imgUploadButton.on('click', function (event) {

            event.preventDefault();
            console.log('foo');

            if (frame) {
                frame.open();
                return;
            }

            frame = wp.media({
                title: 'Select or Upload Media for your Login Logo',
                button: {
                    text: 'Use as my Login page Logo'
                },
                multiple: false // Set to true to allow multiple files to be selected
            });

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                imgIdInput.val(attachment.id);
            });

            frame.open();

        });
    });
})(jQuery);
