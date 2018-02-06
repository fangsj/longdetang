$(function () {

    $('.pic_bg').click(function () {
        $('#formModal').modal();
        cleanForm();
        console.log($(this))
        if ($(this).find('img').size() === 1) {
            var data = $(this).find('img').data()['meta'];
            console.log(data)
            $('#idInputField').val(data.id);
            $('#linkInputField').val(data.link);
            $('#previewThumbnail').attr('src', file(data.pic));
            $('#thumbnailHiddenInputField').val(data.pic);
        }
        $('#positionInputField').val($(this).data()['position'])
    });

    function  cleanForm() {
        $('#previewThumbnail').attr('src', noimage);
        $('#thumbnailHiddenInputField').val('');
        $('#idInputField').val('');
        $('#linkInputField').val('');
    }
    $('[name=thumbnailSelectBtn]').click(function () {
        $("#thumbnailInput").trigger('click');
    });

    $("#thumbnailInput").fileupload({
        url: url('/upload'),
        singleFileUploads: false,
        formData: {"kind": "midHotRecom"},
        paramName: "files[]",
        done: function (e, resp) {
            if (resp.result) {
                $('#previewThumbnail').attr("src", file(resp.result[0].url));
                $('#thumbnailHiddenInputField').val(resp.result[0].url);
            }
        }
    });
    
    $('#submitFormBtn').click(function () {
        var form = {
            id: $('#idInputField').val(),
            position: $('#positionInputField').val(),
            link: $('#linkInputField').val(),
            pic: $('#thumbnailHiddenInputField').val()
        };
        form.id = form.id ? form.id : '';
       $.post(url('/hotRecom/save'), form, function (resp) {
           alert({
               message: resp.msg,
               type: resp.status == 0 ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
               callback: function () {
                   if (resp.status == 0) {
                       form.id = resp.data && (resp.data.id || '')
                       $('[data-position='+ form.position +']')
                           .html('<img data-meta=\''+ JSON.stringify(form) +'\' src="'+ file($('#thumbnailHiddenInputField').val()) +'" style="width: 100%;height: 100%;"/>');
                       $('#formModal').modal('hide');
                   }
               }
           })
       }) 
    });
});