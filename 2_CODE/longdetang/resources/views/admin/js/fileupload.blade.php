@push('css-plugin')
    <style>
        .img-preview {
            float: left;
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .img-preview .icon-container {
            position: absolute;
            top: 40%;
            left: 45%;
            z-index: 100;
            display: none;
        }

        .img-preview .icon-container i {
            font-size: 20px;
        }

        .upload-loading {
            background: {{asset('/assets/js/plugins/jquery-file-upload/img/loading.gif')}} no-repeat;
            display: none;
            width: 32px;
            background-size: contain;
            height: 32px;
        }
    </style>
@endpush
@push('js-plugin')
    <script src="{{asset('/assets/js/plugins/jquery-file-upload/js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('/assets/js/plugins/jquery-file-upload/js/jquery.fileupload.js')}}"></script>
@endpush