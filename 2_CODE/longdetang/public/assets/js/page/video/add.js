$(function () {
    $('#choisePicBtn').click(function () {
        $("#picInput").trigger('click');
    });

    $('#choiseVideoBtn').click(function () {
        $("#videoInput").trigger('click');
    });

    $("#picInput").fileupload({
        url: url('/upload'),
        singleFileUploads: false,
        formData: {"kind": "video"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                with($('#pic-preview').show()) {
                    find('img').attr("src", file(resp.result[0].url));
                    find('input').val(resp.result[0].url);
                }
            }
        }
    });

    $("#videoInput").fileupload({
        url: url('/upload'),
        singleFileUploads: false,
        formData: {"kind": "video"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                with($('#video-preview').show()) {
                    find('video').attr("src", file(resp.result[0].url));
                    find('input').val(resp.result[0].url);
                }
            }
            $('#videoUploaderProcess').css('width', '100%');
            $('#videoUploaderProcessContainer').hide();
            $('#videoUploaderProcess').css('width', '0%');
        }
    }).bind('fileuploadprogress', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#videoUploaderProcess').css('width', progress + '%');
    }).bind('fileuploadadd', function (e, data) {
        $('#videoUploaderProcessContainer').show();
        $('#videoUploaderProcess').css('width', '85%');
    });

    $('#dataForm').easyForm({
        submitBtn: '[name=saveBtn]',
        resetBtn: '#resetBtn',
        resetForm: function () {
            with($('#video-preview').hide()) {
                find('video').attr("src", '');
                find('input').val('');
            }
            with($('#pic-preview').hide()) {
                find('img').attr("src", '');
                find('input').val('');
            }
        },
        success: url('/video'),
        validator: {
            ignore: "",
            messages: {
                title: {
                    required: "标题不能为空！"
                },
                description: {
                    required: "描述不能为空"
                }
            },
            rules: {
                title: {
                    required: true
                },
                description: {
                    required: true
                }
            }
        }
    });

});