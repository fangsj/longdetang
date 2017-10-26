/**
 * 对列表封装
 * Created by fangsj on 16/6/27.
 */
(function (factory) {
    if (typeof define === "function" && define.amd) {
        define(["jquery"], factory);
    } else {
        factory(jQuery);
    }
}(function ($) {

    $.extend($.fn, {
        easyList: function (options) {
            if (!this.length) {
                return;
            }
            var easyList = $.data(this[0], "easyList");
            if (easyList) {
                return easyList;
            }

            var selector = $(this[0]).attr("id");
            if(!selector) {
                selector = "easylist-" + (Math.random() + '').substring(2);
                $(this[0]).attr("id", selector);
            }
            easyList = new $.easyList(options, this[0]);
            $.data(this[0], "easyList", easyList);

            //判断是否有表单,有表单则自动绑定表单查询按钮事件
            if(easyList.settings.actions.search.btn) {
                $(easyList.settings.actions.search.btn).click(function() {
                    easyList.search();
                });
            }
            if(easyList.settings.actions.search.form) {
                //关闭便当自动提交
                $(easyList.settings.actions.search.form).submit(function() {
                    return false;
                });
                //表单enter事件
                $(easyList.settings.actions.search.form).keydown(function(e) {
                    if(e.which == 13) {
                        easyList.search();
                    }
                });
            }

            //判断是否有批量删除按钮,有则绑定click事件,调用默认的删除方法
            if(easyList.settings.actions.deleteBatch.btn) {
                $(easyList.settings.actions.deleteBatch.btn).click(function() {
                    easyList.deleteBatch();
                });
            }

            //判断每行是否有事件
            if(easyList.settings.actions.row) {
                $.each(easyList.settings.actions.row, function(k, v) {
                    var actionSelector = '#' + selector + ' [act='+ k +']';
                    $(document).on("click", actionSelector, function(e) {
                        var rowIndex = $(e.target).parents("tr").data("index");
                        var data = $(e.target).closest('[act='+ k +']').data();
                        if($.isFunction(v)) {
                            v.apply(easyList, [easyList.getData()[rowIndex], data, rowIndex, v]);
                        } else {
                            easyList[k] && easyList[k](easyList.getData()[rowIndex], data, rowIndex, v);
                        }
                    });
                });
            }
            return easyList;
        }
    });

    $.easyList = function (options, table) {
        var _this = this;
        this.settings = $.extend(true, {
            module:'',
            actions: {
                search: {},
                deleteBatch: {},
                row: {}
            },
            columns: {
                queryParams: function (params) {
                    return $(_this.settings.actions.search.form).serializeArray();
                }
            }
        }, options);
        this.currentTable = table;
        this.init();
    };

    $.extend($.easyList, {
        prototype:{
            init: function() {
                this.settings.columns.url = this.settings.columns.url || this.settings.module;
                $(this.currentTable).bootstrapTable(this.settings.columns);
            },
            search: function(searchParam) {
                if(searchParam) {
                    searchParam = $.isFunction(searchParam) ? searchParam() : searchParam;
                }
                var newSearchParam = searchParam;
                if($.isPlainObject(searchParam)) {
                    newSearchParam = [];
                    $.each(searchParam, function (name, value) {
                        newSearchParam.push({name:name, value:value});
                    })
                }
                $(this.currentTable).bootstrapTable("refresh", {query: newSearchParam});
            },
            reload: function(searchParam) {
                this.search(searchParam);
            },
            selections: function(key) {
                var selections = $(this.currentTable).bootstrapTable("getSelections");
                if(key) {
                    return $.map(selections, function(obj){
                        return obj[key];
                    });
                } else {
                    return selections;
                }
            },
            getData: function() {
                return $(this.currentTable).bootstrapTable("getData");
            },
            removeRow: function (arg) {
                return $(this.currentTable).bootstrapTable("remove", arg);
            },
            //默认的删除行
            deleteRow: function(row, extraData, index, opt) {
                var _this = this;
                confirm.danger({
                    message: '确定要删除该记录?',
                    callbacks: [function () {
                        $.post(
                            (opt.url || _this.settings.module + '/delete'),
                            {id: row.id},
                            function (resp) {
                                if (resp.status == '0') {
                                    alert.success({
                                        message: resp.msg,
                                        callback: function(){
                                            _this.search();
                                        }
                                    });
                                } else {
                                    alert.warning(resp.msg);
                                }
                            },
                            'json'
                        );
                    }]
                });
            },
            //默认批量删除行
            deleteBatch: function() {
                var _this = this;

                var rowIds = [];
                var selectedRows = $(_this.currentTable).bootstrapTable("getSelections");
                if (selectedRows.length > 0) {
                    confirm.danger({
                        message:'确定要删除选中的记录?',
                        callbacks:[
                            function(){
                                $.each(selectedRows, function () {
                                    rowIds.push(this.rowId);
                                });
                                $.post(
                                    (_this.settings.actions.deleteBatch.url || _this.settings.module + '/deleteBatch'),
                                    {rowIds: rowIds},
                                    function (resp) {
                                        if (resp.status == '0') {
                                            alert.success({
                                                message: resp.msg,
                                                callback: function(){
                                                    _this.search();
                                                }
                                            });
                                        } else {
                                            alert.warning(resp.msg);
                                        }
                                    },
                                    'json'
                                );
                            }
                        ]
                    });
                } else {
                    alert.danger("请选择记录删除!");
                }
            }
        }
    });

    /**
     * 判断easyList 是否存在
     *
     * @param selector
     * @returns {boolean}
     */
    $.easyList.isExist = function(selector) {
        return $(selector).data("easyList") ? true : false;
    };
}));