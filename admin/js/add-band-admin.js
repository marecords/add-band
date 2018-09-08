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
            addtracklineeditbutton = $('#album_edit_track_line_button'),
            addvideolinebutton = $('#band_add_video_line_button'),
            editvideolinebutton = $('#band_edit_video_line_button'),
            trackcounter = 0,
            videocounter = 0;


        addvideolinebutton.on('click', function (event) {
            event.preventDefault();
            videocounter++;
            var htmlString = '<tr><td>' + videocounter + '. Video</td> \
                              <td> \
                            <input type="text" class="regular-text" id="video' + videocounter + '" name="add-band[video][' + videocounter + ']""  value="" size="10" /><br>\
                            </td></tr><div id=\"track_list\"></div>';
            $('#video_list').append(htmlString);
            $(this).val(videocounter);
        });

        editvideolinebutton.on('click', function (event) {
            event.preventDefault();
            if (videocounter != 0){
                videocounter = $(this).val();    
            }
            videocounter++;
            var htmlString = '<tr><td>' + videocounter + '. Video</td> \
                              <td> \
                            <input type="text" class="regular-text" id="video' + videocounter + '" name="add-band[video][' + videocounter + ']""  value="" size="10" /><br>\
                            </td></tr><div id=\"track_list\"></div>';
            $('#video_list').append(htmlString);
            $(this).val(videocounter);
        });

        addtracklinebutton.on('click', function (event) {
            event.preventDefault();
            trackcounter++;
            var htmlString = '<tr><td>' + trackcounter + '. Song</td> \
                              <td> \
                            <input type="text" class="regular-text" id="track' + trackcounter + '" name="add-band[track][' + trackcounter + ']" /><br>\
                            </td></tr><div id=\"track_list\"></div>';
            $('#track_list').append(htmlString);
            $(this).val(trackcounter);
        });

        addtracklineeditbutton.on('click', function (event) {
            event.preventDefault();
            trackcounter = $(this).val();
            trackcounter++;
            var htmlString = '<tr><td>' + trackcounter + '. Song</td> \
                              <td> \
                            <input type="text" class="regular-text" id="track' + trackcounter + '" name="add-band[track][' + trackcounter + ']" /><br>\
                            </td></tr><div id=\"track_list\"></div>';
            $('#track_list').append(htmlString);
            $(this).val(trackcounter);
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
