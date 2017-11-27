$(function () {
    $('#bgColorInputField').colorpicker().on('changeColor', function (e) {
        $(this).css({
            'background': e.color.toHex()
        })
    });
    $('.fisrtsort:last td').css("border-bottom", "0");

    $("tr[id*=treetable]").click(function () {
        if ($(this).hasClass("tr-fa-caret-right")) {
            $("tr[" + $(this).attr("id") + "]").show();
            $(this).removeClass("tr-fa-caret-right").addClass("tr-fa-caret-down");
            $(this).find("td>i").removeClass("fa-caret-right").addClass("fa-caret-down");
        }
        else {
            $("tr[" + $(this).attr("id") + "]").hide();
            $(this).removeClass("tr-fa-caret-down").addClass("tr-fa-caret-right");
            $(this).find("td>i").removeClass("fa-caret-down").addClass("fa-caret-right");
        }
    });

    $('#addCategoryBtn').click(function () {
        $('#categoryForm').easyForm('resetForm');
        $('#categoryFormModal').modal();
    });

    $('[name=thumbnailSelectBtn]').click(function () {
        $('#thumbnailInput').trigger("click");
    });

    $('[name=picSelectBtn]').click(function () {
        $('#picInput').trigger("click");
    });

    $("#thumbnailInput").fileupload({
        url: url('/upload'),
        singleFileUploads: false,
        formData: {"kind": "prod/category"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                $('#previewThumbnail').attr("src", file(resp.result[0].url));
                $('#thumbnailHiddenInputField').val(resp.result[0].url);
            }
            $(e.target).next('.upload-loading').hide();
        }
    }).bind("fileuploadadd", function (e, data) {
    });

    $("#picInput").fileupload({
        url: url('/upload'),
        singleFileUploads: false,
        formData: {"kind": "prod/category"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                $('#previewPic').attr("src", file(resp.result[0].url));
                $('#picHiddenInputField').val(resp.result[0].url);
            }
            $(e.target).next('.upload-loading').hide();
        }
    }).bind("fileuploadadd", function (e, data) {
    });

    $('#categoryForm').easyForm({
        submitBtn: '#submitCategoryFormBtn',
        resetBtn: '#closeCategoryForm',
        resetForm: function () {
            $('#previewThumbnail').attr('src', assets('/img/noimage.png'));
            $('#picThumbnail').attr('src', assets('/img/noimage.png'));
            $('#bgColorInputField').css({
                background: 'white',
            });
        },
        url: function () {
            return url($('#categoryIdInputField').val() ? '/prod/category/edit' : '/prod/category/add');
        },
        success: url('/prod/category'),
        validator: {
            ignore: "",
            messages: {
                name: {
                    required: "分类名称不能为空"
                },
                code: {
                    required: "分类编码不能为空"
                },
                pinyin: {
                    required: "分类拼音不能为空"
                },
                seq: {
                    number: "排序只能输入数字"
                }

            },
            rules: {
                name: {
                    required: true
                },
                pinyin: {
                    required: true
                },
                code: {
                    required: true
                },
                seq: {
                    number: true
                }
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.closest("div"));
                }
                else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                }
                else {
                    error.insertAfter(element);
                }
            }
        }
    });

    $('#addSecondCategoryBtn').click(function () {
        $('#secondCategoryForm').easyForm('resetForm');
        $('#secondCategoryModal').modal();
    });

    $('#secondCategoryForm').easyForm({
        submitBtn: '#submitSecondCategoryFormBtn',
        resetBtn: '#closeSecondCategory',
        url: function () {
            return url($('#secondCategoryIdInputField').val() ? '/prod/category/second/edit' : '/prod/category/second/add');
        },
        extraData: function () {
            return {};
        },
        success: url('/prod/category'),
        validator: {
            ignore: "",
            messages: {
                name: {
                    required: "分类名称不能为空"
                },
                code: {
                    required: "分类编码不能为空"
                },
                seq: {
                    number: "排序只能输入数字"
                }
            },
            rules: {
                name: {
                    required: true
                },
                code: {
                    required: true
                },
                seq: {
                    number: true
                }
            },
            errorPlacement: function (error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.closest("div"));
                }
                else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                }
                else {
                    error.insertAfter(element);
                }
            }
        }
    });

});

function editCategory(id) {
    this.event.stopPropagation();
    $.post(url('/prod/category/initEdit'), {
        'id': id
    }, function (resp) {
        $('#categoryForm').easyForm('resetForm', function () {
            $('#previewThumbnail').attr('src', assets('/img/noimage.png'));
            $('#picThumbnail').attr('src', assets('/img/noimage.png'));
        });
        $('#nameInputField').val(resp.data.name);
        $('#pinyinInputField').val(resp.data.pinyin);
        $('#pinyinInputField').val(resp.data.pinyin);
        $('#categoryCodeInputField').val(resp.data.code);
        $('#previewThumbnail').attr('src', file(resp.data.thumbnail));
        $('#picThumbnail').attr('src', file(resp.data.pic));
        $('#thumbnailHiddenInputField').val(resp.data.thumbnail);
        $('#picHiddenInputField').val(resp.data.pic);
        $('#categoryStatus' + resp.data.status + '').prop('checked', true);
        $('#seqInputField').val(resp.data.seq || '');
        $('#adSloganInputField').val(resp.data.ad_slogan || '');
        $('#explainInputField').val(resp.data.explain || '');
        $('#categoryIdInputField').val(resp.data.id);
        $('#bgColorInputField').val(resp.data.bg_color).css({
            'background': resp.data.bg_color
        });
        $('#categoryFormModal').modal();
    });
}

function editSecondCategory(id) {
    this.event.stopPropagation();
    $.post(url('/prod/category/second/initEdit'), {
        'id': id
    }, function (resp) {
        $('#secondCategoryForm').easyForm('resetForm');
        with ($('#secondCategoryForm')) {
            find('[name=id]').val(resp.data.id || '');
            find('[name=name]').val(resp.data.name || '');
            find('[name=code]').val(resp.data.code || '');
            find('[name=seq]').val(resp.data.seq || '');
            find('#secondCategoryStatus' + resp.data.status + '').prop('checked', true);
            find('[name=parent_id] option[value="' + resp.data.parent_id + '"]').prop('selected', true);
        }
        $('#secondCategoryModal').modal();
    });
}

function addSecondCategory(id) {
    this.event.stopPropagation();
    $('#secondCategoryForm').easyForm('resetForm');
    $('#secondCategoryForm [name=parent_id] option[value="' + id + '"]').prop('selected', true);
    $('#secondCategoryModal').modal();
}

function deleteCategory(id) {
    this.event.stopPropagation();
    confirm.warning({
        message: "确认要删除该分类,会删除关联子分类？",
        callbacks: [function () {
            $.post(url('/prod/category/delete'), {
                'id': id
            }, function (resp) {
                if (resp.status == 0) {
                    alert.success(resp.msg);
                    redirect(url('/prod/category'))
                } else {
                    alert.danger(resp.msg)
                }
            });
        }]
    });
}

function deleteSecondCategory(id) {
    this.event.stopPropagation();
    confirm.warning({
        message: "确认要删除该分类？",
        callbacks: [function () {
            $.post(url('/prod/category/second/delete'), {
                'id': id
            }, function (resp) {
                if (resp.status == 0) {
                    alert.success(resp.msg);
                    redirect(url('/prod/category'))
                } else {
                    alert.danger(resp.msg)
                }
            });
        }]
    });
}

function switchStatus(id, status) {
    this.event.stopPropagation();
    confirm.warning({
        message: status == 1 ? "确认要启用该分类以及子分类？" : "确认要禁用该分类以及子分类？",
        callbacks: [function () {
            $.post(url('/prod/category/' + (status == 1 ? 'enable' : 'disable')), {
                'id': id
            }, function (resp) {
                if (resp.status == 0) {
                    alert.success(resp.msg);
                    redirect(url('/prod/category'))
                } else {
                    alert.danger(resp.msg)
                }
            });
        }]
    });
}

function switchSecondCategory(id, status) {
    this.event.stopPropagation();
    confirm.warning({
        message: status == 1 ? "确认要启用该分类？" : "确认要禁用该分类？",
        callbacks: [function () {
            $.post(url('/prod/category/second/switch'), {
                'id': id,
                'status': status
            }, function (resp) {
                if (resp.status == 0) {
                    alert.success({
                        message: resp.msg,
                        callback: function () {
                            redirect(url('/prod/category'))
                        }
                    });
                } else {
                    alert.danger(resp.msg)
                }
            });
        }]
    });
}
