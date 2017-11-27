$(function () {
    //分页查询
    $('#table').easyList({
        module: url('/article'),
        actions: {
            search: {
                btn: '#searchBtn',
                form: '#searchForm'
            },
            row: {
                deleteRow: true,
                edit: function (row) {
                    redirect(url('/article/edit'), {id: row.id});
                },
                swtichStatus: function(row) {
                    var _this = this;
                    $.post(url('/article/status'), {
                        'id': row.id,
                        'status': row.status != 1 ? 1 : 2
                    }, function (resp) {
                        if (resp.status == 0) {
                            alert.success({
                                message:resp.msg,
                                callback: function () {
                                    _this.search();
                                }
                            });
                        } else {
                            alert.danger(resp.msg)
                        }
                    });
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
                width: '10%'
            }, {
                title: "简要介绍",
                field: 'preface',
                overflow: 'hide',
                width: '35%'
            }, {
                title: "作者",
                field: 'author',
                width: '5%'
            }, {
                title: "浏览数",
                field: 'views',
                width: '4%'
            }, {
                title: "发布时间",
                width: "13%",
                field: "publish_time"
            }, {
                title: "状态",
                field: 'status',
                width: '5%',
                formatter: function (val) {
                    if (val == 0) return '<span class="badge badge-warning hvr-wobble-vertical">未发布</span>';
                    if (val == 1) return '<span class="badge badge-primary hvr-wobble-vertical">已发布</span>';
                    if (val == 2) return '<span class="badge badge-danger hvr-wobble-vertical">已下架</span>';
                }
            }, {
                title: "操作",
                width: '8%',
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