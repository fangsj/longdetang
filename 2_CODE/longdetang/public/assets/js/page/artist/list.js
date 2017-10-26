$(function () {
    //分页查询
    $('#table').easyList({
        module: url('/artist'),
        actions: {
            search: {
                btn: '#searchBtn',
                form: '#searchForm'
            },
            row: {
                deleteRow: true,
                edit: function (row) {
                    redirect(url('/artist/edit'), {id: row.id});
                }
            }
        },
        columns: {
            pageNumber: 1,
            pageSize: 10,
            singleSelect: false,
            columns: [{
                title: "名称",
                field: 'name',
                width: '15%',
                formatter: function (val, row) {
                    return "<img src='" + file(row.pic) + "' style='width: 30px; max-height: 30px;border-radius: 100%;'/>&nbsp;&nbsp;" + val;
                }
            }, {
                title: "介绍",
                field: 'intro',
                width: '23%',
                sortable: true
            }, {
                title: "作品数",
                field: 'works',
                width: '8%'
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