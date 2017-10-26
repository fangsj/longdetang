$(function () {
    $('#choisePicBtn').click(function () {
        $("#picInput").trigger('click');
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


    $('#dataForm').easyForm({
        submitBtn: '[name=saveBtn]',
        resetBtn: '#resetBtn',
        resetForm: function () {
            with($('#pic-preview').hide()) {
                find('img').attr("src", '');
                find('input').val('');
            }
        },
        success: url('/artist'),
        validator: {
            ignore: "",
            messages: {
                name: {
                    required: "艺人不能为空！"
                }
            },
            rules: {
                name: {
                    required: true
                }
            }
        }
    });

});