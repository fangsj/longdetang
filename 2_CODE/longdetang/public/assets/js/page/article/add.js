$(function () {

    CKEDITOR.replace('content', {
        removePlugins: 'elementspath',
        toolbar: [
            {name: 'document', items: ['Preview', 'Source', '-', 'NewPage', 'Templates']},
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
            {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike']},
            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']},
            {name: 'links', items: ['Link', 'Unlink', 'Anchor', 'indentblock']},
            {name: 'colors', items: ['TextColor', 'BGColor', 'letterspacing']},
            {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize', 'lineheight']},
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']
            }
        ]
    });

    CKEDITOR.instances['content'].on('change', function () {
        $("#content").val(this.getData());
    });

    $('#choisePicBtn').click(function () {
        $("#picInput").trigger('click');
    });

    $("#picInput").fileupload({
        url: url('/upload'),
        singleFileUploads: false,
        formData: {"kind": "article"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                with ($('#pic-preview').show()) {
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
            with ($('#pic-preview').hide()) {
                find('img').attr("src", '');
                find('input').val('');
            }
        },
        success: url('/article'),
        validator: {
            ignore: "",
            messages: {
                title: {
                    required: "标题不能为空！"
                }
            },
            rules: {
                title: {
                    required: true
                }
            }
        }
    });

});