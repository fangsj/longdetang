$(function () {
    //分页查询
    $('#table').easyList({
        module: url('/banner'),
        actions: {
            search: {
                btn: '#searchBtn',
                form: '#searchForm'
            },
            row: {
                deleteRow: true,
                edit: function (row) {
                    redirect(url('/banner/edit'), {id: row.id});
                }
            }
        },
        columns: {
            pageNumber: 1,
            pageSize: 10,
            singleSelect: false,
            columns: [{
                title: "标题",
                field: 'title',
                width: '15%'
            }, {
                title: "图片",
                field: 'pic',
                width: '23%',
                formatter: function (val, row) {
                    return "<img src='" + file(val) + "' style='max-height: 30px;'/>&nbsp;&nbsp;";
                }
            }, {
                title: "状态",
                field: 'status',
                width: '8%',
                formatter: function (val) {
                    if (val == 0) return '<span class="badge badge-danger hvr-wobble-vertical">未发布</span>';
                    if (val == 1) return '<span class="badge badge-primary hvr-wobble-vertical">已发布</span>';
                }
            }, {
                title: "创建时间",
                width: "16%",
                field: "created_at"
            }, {
                title: "操作",
                width: '16%',
                formatter: function (val, row, index) {
                    var operation = "";
                    operation += "<a title='修改' act='edit' data-index='" + index + "' class='btn btn-xs btn-success hvr-buzz-out'><i class='fa fa-edit'></i></a>";
                    operation += "<a title='删除' act='deleteRow' data-index='" + index + "' class='btn btn-xs btn-danger hvr-buzz-out'><i class='fa fa-trash-o'></i></a>";
                    return operation;
                }
            }]
        }
    });
});