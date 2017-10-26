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
            $(e.target).next('.upload-loading').hide();
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
            $(e.target).next('.upload-loading').hide();
        }
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