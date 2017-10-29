$(function () {
    //分页查询
    $('#table').easyList({
        module: url('/prod'),
        actions: {
            search: {
                btn: '#searchBtn',
                form: '#searchForm'
            },
            row: {
                deleteRow: true,
                edit: function (row) {
                    redirect(url('/prod/edit'), {id: row.id});
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
                    return "<img src='" + file(row.pic) + "' style='width: 30px; max-height: 30px;border-radius: 4px;'/>&nbsp;&nbsp;" + val;
                }
            }, {
                title: "所属分类",
                field: 'category_name',
                width: '23%',
                formatter: function (val, row) {
                    return val + '-' + (row.second_category_name || '')
                }
            }, {
                title: "编码",
                field: 'code',
                width: '8%'
            }, {
                title: "是否精选",
                width: "8%",
                field: "is_essence",
                formatter: function (val) {
                    if (val == 0) return '<span class="badge badge-info hvr-wobble-vertical">否</span>';
                    if (val == 1) return '<span class="badge badge-danger hvr-wobble-vertical">是</span>';
                }
            },  {
                title: "艺人",
                field: 'artist_name',
                width: '8%'
            }, {
                title: "状态",
                width: "16%",
                field: "status",
                formatter: function (val) {
                    if (val == 0) return '<span class="badge badge-info hvr-wobble-vertical">待上架</span>';
                    if (val == 1) return '<span class="badge badge-danger hvr-wobble-vertical">已上架</span>';
                    if (val == 2) return '<span class="badge badge-warning-light hvr-wobble-vertical">已下架</span>';
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
                    if (row.status != "1") operation += "<a title='发布' act='swtichStatus' data-index='" + index + "' class='btn btn-outline btn-xs btn-info'><i class='fa fa-upload'></i></a>";
                    if (row.status == "1") operation += "<a title='下架' act='swtichStatus' data-index='" + index + "' class='btn btn-outline btn-xs btn-danger'><i class='fa fa-download'></i></a>";
                    operation += "<a title='修改' act='edit' data-index='" + index + "' class='btn btn-xs btn-success hvr-buzz-out'><i class='fa fa-edit'></i></a>";
                    operation += "<a title='删除' act='deleteRow' data-index='" + index + "' class='btn btn-xs btn-danger hvr-buzz-out'><i class='fa fa-trash-o'></i></a>";
                    return operation;
                }
            }]
        }
    });
});