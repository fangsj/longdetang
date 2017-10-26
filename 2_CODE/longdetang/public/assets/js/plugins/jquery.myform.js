/**
 * form封装
 *
 * fangsj
 * 使用JqueryForm\JqueryValidate\BootstrapDialog插件
 */
(function ($) {
    var EasyForm;
    EasyForm = (function () {

        /**
         * 构造函数
         * @param form 表单
         * @param opt 选项
         * @constructor
         */
        function EasyForm(form, opt) {
            var _this = this;
            this.isSubmiting = false;//是否正在提交
            this.form = form;
            this.jform = $(form);
            this.opt = opt;
            this.formErrorContainer = this.opt.formErrorContainer || '#formValidPrompt';
            this.opt.disableFormClass = this.opt.disableFormClass || 'disable-form';
            if (opt.submitBtn) {
                $(opt.submitBtn).click(function (e) {
                    _this.submitEvent = {
                        btn: $(this),
                        event: e
                    };
                    _this.submit();
                });
            }

            if (opt.resetBtn) {
                $(opt.resetBtn).click(function () {
                    _this.resetForm();
                });
            }

            if (opt.validator) {
                if (!opt.validator.errorPlacement) {
                    opt.validator.errorPlacement = function (error, element) {
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
                this.validator = this.jform.validate(opt.validator);
            }

            this.disableForm = function () {
                _this.isSubmiting = true;
                $(opt.submitBtn).each(function () {
                    var iconClass = $(this).find(".fa").attr("class");
                    if (iconClass) {
                        $(this).attr("icon-class", iconClass);
                        $(this).find(".fa").removeAttr("class").addClass("fa fa-spinner");
                    }
                    $(this).addClass(_this.opt.disableFormClass);
                });
            };

            this.enableForm = function () {
                _this.isSubmiting = false;
                $(opt.submitBtn).each(function () {
                    $(this).removeClass(_this.opt.disableFormClass);
                    var iconClass = $(this).attr("icon-class");
                    $(this).find(".fa").attr("class", iconClass);
                });
            };

            this.jform.ajaxForm({
                url: this.jform.attr('action'),
                type: this.jform.attr('method')
            });
        };

        /**
         * 验证表单
         *
         * @returns {*}
         */
        EasyForm.prototype.validate = function () {
            var validResult;
            if (!this.opt.validator) {
                validResult = true;
            }
            else {
                if(!this.opt.beforeValidate || this.opt.beforeValidate() !== false) {
                    validResult = this.jform.valid();
                } else {
                    validResult = false;
                }
            }
            if (!validResult) {
                $(this.formErrorContainer).show();
                if ($(this.formErrorContainer).html() == '') {
                    $(this.formErrorContainer).html('&nbsp;请检查表单数据,请提交正确的数据!')
                }
            }
            else {
                $(this.formErrorContainer).hide();
            }
            return validResult;
        };

        /**
         * 重置表单
         *
         * @param clean 回调函数
         */
        EasyForm.prototype.resetForm = function (clean) {
            this.jform.validate().resetForm();
            this.form.reset();
            this.jform.find('.form-control.error').removeClass('error');
            this.opt.resetForm && this.opt.resetForm();
            clean && clean(this.jform);
        };

        /**
         * 获取验证框架
         * @param clean
         * @returns {*|PlatformMismatchEvent}
         */
        EasyForm.prototype.getValidator = function () {
            return this.validator;
        };

        EasyForm.prototype.valitate = function (element) {
            return this.validator.validate().element(element);
        };

        /**
         * 获取请求URL
         * 1.先判断是否传入URL,则用传入URL
         * 2.判断URL是否是函数
         * @param url
         * @returns {*}
         */
        EasyForm.prototype.getUrl = function (url) {
            if (url) return url;
            else if ($.isFunction(this.opt.url)) return this.opt.url.apply(this);
            else if ($.type(this.opt.url) == "string") return this.opt.url;
            else if(this.submitEvent.btn.attr('action')) return this.submitEvent.btn.attr('action');
            else return this.jform.attr('action');
        };

        /**
         * 成功响应
         *
         * @param resp 响应数据
         * @param status 状态
         * @param xhr AJAX对象
         * @param form 表单
         */
        EasyForm.prototype.doSuccess = function (resp, status, xhr, form) {
            var that = $(form).data("easyForm");
            var submitEvent = that.submitEvent;
            try {
                BootstrapDialog.alert({
                    title: '系统操作提示!',
                    message: resp.msg,
                    closable: true,
                    type: (resp.status == '0' ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER),
                    size: BootstrapDialog.SIZE_SMALL,
                    buttonLabel: '确 认',
                    callback: function () {
                        if (resp.status == '0') {
                            if (that.opt.success) {
                                if ($.isFunction(that.opt.success)) {
                                    that.opt.success(resp, submitEvent);
                                }
                                else {
                                    var redirectUrl = that.opt.success;
                                    if (redirectUrl.lastIndexOf("?") != -1) {
                                        redirectUrl = redirectUrl + "&";
                                    }
                                    else {
                                        redirectUrl = redirectUrl + "?";
                                    }
                                    location.href = (redirectUrl + "keep");
                                }
                            }
                        }
                        else {
                            that.opt.error && that.opt.error(resp, submitEvent);
                        }
                    }
                });
            }
            finally {
                that.enableForm();
            }
        };


        /**
         * 响应完成
         *
         * @param xhr
         * @param status
         * @param form
         */
        EasyForm.prototype.doComplete = function (xhr, status, form) {
            accessDefine(xhr);
            var that = $(form).data("easyForm");
            that.enableForm();
        };


        /**
         * 提交表单
         *
         * @param url
         */
        EasyForm.prototype.submit = function (url) {
            if (!this.isSubmiting) {
                this.disableForm();
                var _this = this;
                try {
                    if (this.validate()) {
                        this.jform.ajaxSubmit({
                            url: this.getUrl(url),
                            success: this.doSuccess,
                            complete: this.doComplete,
                            data: function () {
                                return _this.opt.extraData ? _this.opt.extraData.apply(_this, this) : {};
                            },
                            beforeSerialize: function () {
                                return _this.opt.beforeSerialize && _this.opt.beforeSerialize.apply(_this, this);
                            },
                            beforeSubmit: function () {
                               return _this.opt.beforeSubmit && _this.opt.beforeSubmit.apply(_this, this);
                            }
                        });
                    }
                    else {
                        this.enableForm();
                    }
                }
                catch (e) {
                    throw e;
                    this.enableForm();
                }
            }
        };
        return EasyForm;
    })();

    /**
     * easyForm 绑定
     *
     * @param option 参数
     * @returns {*}
     */
    $.fn.easyForm = function (option) {
        var value,
            args = Array.prototype.slice.call(arguments, 1);
        return this.each(function () {
            var $this = $(this),
                data = $this.data('easyForm'),
                options = $.extend({}, $this.data(),
                    typeof option === 'object' && option);

            if (typeof option === 'string') {

                if (!data) {
                    return;
                }

                value = data[option].apply(data, args);

                if (option === 'destroy') {
                    $this.removeData('easyForm');
                }
            }

            if (!data) {
                data = new EasyForm(this, options);
                $this.data('easyForm', data);
            }
        });
        return typeof value === 'undefined' ? this : value;
    }
})(jQuery);