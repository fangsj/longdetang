$(function () {
    CKEDITOR.replace('brief', {
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

    CKEDITOR.instances['brief'].on('change', function () {
        $("#brief").val(this.getData());
    });

    $('#choisePicBtn').click(function () {
        $("#picInput").trigger('click');
    });

    $("#picInput").fileupload({
        url: url('/upload'),
        singleFileUploads: true,
        formData: {"kind": "prod/banner"},
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

    $('#choiseBarPicBtn').click(function () {
        $("#barPicInput").trigger('click');
    });
    $("#barPicInput").fileupload({
        url: url('/upload'),
        singleFileUploads: true,
        formData: {"kind": "prod/bar"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                with($('#bar-pic-preview').show()) {
                    find('img').attr("src", file(resp.result[0].url));
                    find('input').val(resp.result[0].url);
                }
            }
            $(e.target).next('.upload-loading').hide();
        }
    });
    $('#choiseBannerPicBtn').click(function () {
        $("#bannerPicInput").trigger('click');
    });
    $("#bannerPicInput").fileupload({
        url: url('/upload'),
        singleFileUploads: false,
        formData: {"kind": "prod/banner"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                for(var i in resp.result) {
                    var pre = $('#preview-tpl').clone();
                    pre.removeAttr('id');
                    pre.find('input').val(resp.result[i].url).attr('name', 'attachs[]');
                    pre.find('img').attr('src', file(resp.result[i].url));
                    pre.show();
                    $('#pic-preview-container').append(pre);
                }
            }
            $(e.target).next('.upload-loading').hide();
        }
    });

    $('#second_category_id').change(function () {
        $('#category_id').val($(this).find('option:selected').attr('data-pid'));
    });

    $(document).on('click', '.img-preview i.fa-times-circle-o', function () {
        $(this).parents('.img-preview').remove();
    })
    $('#artist_id').select2({
        placeholder: "请选择艺人",
        ajax: {
            url: url('/artist/search'),
            dataType: 'json',
            type:'post',
            delay: 1000,
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            }
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
        success: url('/prod'),
        validator: {
            ignore: "",
            messages: {
                name: {
                    required: "商品名称不能为空！"
                },
                code: {
                    required: "商品编码不能为空！"
                },
                price: {
                    required: "商品价格不能为空！"
                }
            },
            rules: {
                name: {
                    required: true
                },
                code: {
                    required: true
                },
                price: {
                    required: true
                }
            }
        }
    });

});