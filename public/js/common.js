var _DELIMITER = '|#$%-|';
/**
 * ****************************************************************************
 *
 * COMMON.JS
 *
 * 処理概要		:	common.js
 * 作成日		:	2015/09/15
 * 作成者		:	thanhnv
 *
 * 更新日		:
 * 更新者		:
 * 更新内容		:
 *
 * @package		:	MODULE NAME
 * @copyright	:	Copyright (c) ACV
 * @version		:	1.0.0
 * ****************************************************************************
 */
/**
 * value is array or string
 */
jQuery.fn.extend({
    _addError: function(value) {
        var message_code = value;
        var message = "";
        var messageArr = [];
        var localtion = 'jp';
        //Get message error
        if($.isArray(value)){
            $.each(value,function(key,valueItem){
                message_code = valueItem;
                if(_messageTranslation[localtion].hasOwnProperty(message_code)){
                    messageArr.push(_messageTranslation[localtion][message_code]);
                }else{
                    messageArr.push(message_code);
                }
            })
            message = messageArr.join();
        }else{
            if(_messageTranslation[localtion].hasOwnProperty(message_code)){
                message =_messageTranslation[localtion][message_code];
            }else{
                message = message_code;
            }
        }

        return this.each(function() {
            //Style error
            $(this).addClass('input-error');
            $(this).attr('data-original-title',message);
            $(this).tooltip();
        });
    },
    _removeError: function() {
        return this.each(function() {
            $(this).removeClass('input-error');
            $(this).removeAttr('data-original-title');
        });
    }
});
$(document).ready(function() {
    try {
        _commonInitEvent();
    } catch (e) {
        console.log('ready' + e.message);
    }
});

/**
 *init
 */
function _commonInitEvent() {
    try {
        //Close popup
        $(document).on('click', '.btn-close-popup', function() {
            parent.$.colorbox.close();
        });
        // Click function display Popup
        $(document).on('click', '.btn-popup', function() {
            $.colorbox({
                iframe : true,
                innerWidth : '80%',
                innerHeight : '60%',
                opacity : 0.2,
                href : $(this).attr('href'),
                escKey : false,
                cbox_load : function() {
                    $('#cboxClose').remove();
                    $("#cboxTitle").remove();
                }
            });
        });
        $(document).on('focus','input.numeric:enabled, input.only-number:enabled',
            function(e) {
                $(this).attr('type', 'tel');
            }
        );
        $(".only-number, .numeric").bind('paste', function(e) {
            var _this = $(this);
            setTimeout(function(e) {
                if (!_validateNumber($(_this).val())) {
                    $(_this).val('');
                }
            }, 0);
        });
        $(document).on('keypress', '.ui-datepicker-trigger', function(e) {
            try {
                if (e.keyCode == 13) {
                    $(this).trigger('click');
                }
            } catch (e) {
                console.log('.ui-datepicker-trigger' + e.message);
            }
        });

        // input upper
        $(document)
            .on(
                'keypress',
                'input.upper',
                function(event) {
                    // var ctrlDown = event.ctrlKey||event.metaKey; //
                    // Mac support
                    if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                            // 9
                            || (event.keyCode > 64 && event.keyCode < 91)
                            || event.keyCode == 116 // F5
                            || event.keyCode == 46 // del
                            || event.keyCode == 35 // end
                            || event.keyCode == 36 // home
                            || event.keyCode == 37 // ←
                            || event.keyCode == 39 // →
                            || event.keyCode == 8 // backspace
                            || event.keyCode == 9 // tab
                            || event.keyCode == 188 // ,
                            || event.keyCode == 189 // -
                            || event.keyCode == 109 // numpad -
                            || event.keyCode == 173 // - (firefox only)
                            || event.keyCode == 190 // .
                            || event.keyCode == 110 // numpad .
                            || (event.shiftKey && event.keyCode == 35) // shift
                            // +
                            // end
                            || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                        ))
                        || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                    // Shift
                    // +
                    // [0~9]
                    )
                        event.preventDefault();
                });
        // input.percent, input.percent-money, input.time
        $(document)
            .on(
                'keydown',
                'input.rate, input.percentage,input.time, input.time25, input.time30',
                function(event) {
                    // var ctrlDown = event.ctrlKey||event.metaKey; //
                    // Mac support
                    if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                            // 9
                            || (event.keyCode > 95 && event.keyCode < 106) // numpad
                            // 0 ~
                            // numpad
                            // 9
                            || event.keyCode == 116 // F5
                            || event.keyCode == 46 // del
                            || event.keyCode == 35 // end
                            || event.keyCode == 36 // home
                            || event.keyCode == 37 // ←
                            || event.keyCode == 39 // →
                            || event.keyCode == 8 // backspace
                            || event.keyCode == 9 // tab
                            || event.keyCode == 188 // ,
                            || event.keyCode == 190 // .
                            || event.keyCode == 110 // numpad .
                            || (event.shiftKey && event.keyCode == 35) // shift
                            // +
                            // end
                            || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                            || event.keyCode == 229 // ten-key processing
                        ))
                        || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                    // Shift
                    // +
                    // [0~9]
                    )
                        event.preventDefault();
                });
        // input.timeblock5 allow top and bottom keyboard -- thanhnv

        $(document)
            .on(
                'keydown',
                'input.timeblock5',
                function(event) {
                    // var ctrlDown = event.ctrlKey||event.metaKey; //
                    // Mac support
                    if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                            // 9
                            || (event.keyCode > 95 && event.keyCode < 106) // numpad
                            // 0 ~
                            // numpad
                            // 9
                            || event.keyCode == 116 // F5
                            || event.keyCode == 46 // del
                            || event.keyCode == 35 // end
                            || event.keyCode == 36 // home
                            || event.keyCode == 37 // ←
                            || event.keyCode == 39 // →
                            || event.keyCode == 38 // arrow up
                            || event.keyCode == 40 // arrow bottom
                            || event.keyCode == 8 // backspace
                            || event.keyCode == 9 // tab
                            || event.keyCode == 188 // ,
                            || event.keyCode == 190 // .
                            || event.keyCode == 110 // numpad .
                            || (event.shiftKey && event.keyCode == 35) // shift
                            // +
                            // end
                            || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                            || event.keyCode == 229 // ten-key processing
                        ))
                        || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                    // Shift
                    // +
                    // [0~9]
                    )
                        event.preventDefault();
                    if (event.keyCode == 38){
                        var time	=	_formatTimeBlock5($(this),'+5');
                        if(time !=''){
                            $(this).val(time);
                        }
                    }
                    if (event.keyCode == 40){
                        var time	=	_formatTimeBlock5($(this),'-5');
                        if(time !=''){
                            $(this).val(time);
                        }
                    }
                });
        $(document).on(
            'blur',
            'input.timeblock5',
            function() {
                $(this).val(_formatTimeBlock5($(this)));
            });
        // input.number
        $(document)
            .on(
                'keydown',
                'input.number',
                function(event) {
                    if (event.keyCode != 9) {
                        NUMBER_PASTE_DATA_STATUS = true;
                    }
                    // var ctrlDown = event.ctrlKey||event.metaKey; //
                    // Mac support
                    if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                            // 9
                            || (event.keyCode > 95 && event.keyCode < 106) // numpad
                            // 0 ~
                            // numpad
                            // 9
                            || event.keyCode == 116 // F5
                            || event.keyCode == 46 // del
                            || event.keyCode == 35 // end
                            || event.keyCode == 36 // home
                            || event.keyCode == 37 // ←
                            || event.keyCode == 39 // →
                            || event.keyCode == 8 // backspace
                            || event.keyCode == 9 // tab
                            // || event.keyCode == 110 // numpad .
                            || event.keyCode == 13 // Enter
                            || (event.shiftKey && event.keyCode == 35) // shift
                            // +
                            // end
                            || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                            || event.keyCode == 229 // ten-key processing
                        ))
                        || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                    // Shift
                    // +
                    // [0~9]
                    )
                        event.preventDefault();
                });
        $(document).on(
            'change',
            'input.number',
            function(event) {
                if (!_validateNumber($(this).val())
                    || _validateFullSize($(this).val())) {
                    $(this).val('');
                }
            });
        // input method
        $(document)
            .on(
                'keydown',
                'input.tel',
                function(event) {
                    // var ctrlDown = event.ctrlKey||event.metaKey; //
                    // Mac support
                    if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                            // 9
                            || (event.keyCode > 95 && event.keyCode < 106) // numpad
                            // 0 ~
                            // numpad
                            // 9
                            || event.keyCode == 116 // F5
                            || event.keyCode == 46 // del
                            || event.keyCode == 35 // end
                            || event.keyCode == 36 // home
                            || event.keyCode == 37 // ←
                            || event.keyCode == 39 // →
                            || event.keyCode == 8 // backspace
                            || event.keyCode == 9 // tab
                            || event.keyCode == 189 // -
                            || event.keyCode == 109 // numpad -
                            || event.keyCode == 173 // - (firefox only)
                            ///|| event.keyCode == 107 // numpad +
                            //|| (event.shiftKey && event.keyCode == 187) // shift
                            // +
                            // add
                            || (event.shiftKey && event.keyCode == 35) // shift
                            // +
                            // end
                            || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                            || event.keyCode == 229 // ten-key processing
                        ))
                        || (event.shiftKey && (event.keyCode > 47
                            && event.keyCode < 58 || event.keyCode == 189)) // exlcude
                    // Shift
                    // +
                    // [0~9]
                    )
                        event.preventDefault();
                });
        // input tel in mobile
        $(document).on('keydown', 'input.tel-mobile', function(event) {
            // var ctrlDown = event.ctrlKey||event.metaKey; //
            // Mac support
            if (!((event.keyCode > 47 && event.keyCode < 58) // 0 ~ 9
                || (event.keyCode > 95 && event.keyCode < 106) // numpad
                || event.keyCode == 8 // backspace
                || event.keyCode == 189 // +
                || event.keyCode == 187 // -
                || event.keyCode == 9 // tab
                || event.keyCode == 229 // ten-key processing
            )) {
                event.preventDefault();
            }
        });
        // input keydown only-number
        $(document)
            .on(
                'keydown',
                'input.only-number',
                function(event) {
                    if(!event){
                        console.log("!event");
                    }
                    try {
                        var negativeEnabled = false;
                        if ($(this).attr('negative')) {
                            negativeEnabled = $(this).attr('negative');
                        }
                        if (event.keyCode == 229) {
                            $(this).val('');
                        }
                        if (event.keyCode == 53)
                            return true;
                        if (!((event.keyCode > 47 && event.keyCode < 58)
                                || (event.keyCode > 95 && event.keyCode < 106)
                                || event.keyCode == 116
                                || event.keyCode == 46
                                || event.keyCode == 37
                                || event.keyCode == 39
                                || event.keyCode == 8
                                || event.keyCode == 9
                                || event.ctrlKey // 20160404 - sangtk - allow all ctrl combination //
                                || event.keyCode == 229 // ten-key processing
                            )
                            // || event.shiftKey
                            || (negativeEnabled == false
                                && event.keyCode == 189 || event.keyCode == 109)) {
                            event.preventDefault();
                        }
                        if (negativeEnabled
                            && (event.keyCode == 189 || event.keyCode == 109)) {
                            var val = $(this).val();
                            var negative = '-' + val.replace(/-/g, '');
                            $(this).val(negative);
                        }
                    } catch (e) {
                        console.log(e.message);
                    }
                });
        // input blur only-number
        // input keydown only-number
        $(document)
            .on(
                'keydown',
                'input.notnumber',
                function(event) {
                    try {
                        var negativeEnabled = false;
                        if ($(this).attr('negative')) {
                            negativeEnabled = $(this).attr('negative');
                        }
                        if (event.shiftKey) {
                            event.preventDefault();
                        }
                        if (!(((event.keyCode <= 47 || event.keyCode >= 58) && (event.keyCode <= 95 || event.keyCode >= 106))
                            || event.keyCode == 116
                            || event.keyCode == 46
                            || event.keyCode == 37
                            || event.keyCode == 39
                            || event.keyCode == 8 || event.keyCode == 9)
                            || event.shiftKey
                            || (negativeEnabled == false
                                && event.keyCode == 189 || event.keyCode == 109)) {
                            event.preventDefault();
                        }
                    } catch (e) {
                        console.log("input.notnumber "+e.message);
                    }
                });
        //negative
        $(document)
            .on(
                'keydown',
                'input.negative',
                function(event) {
                    if (event.keyCode != 9) {
                        NUMBER_PASTE_DATA_STATUS = true;
                    }
                    // var ctrlDown = event.ctrlKey||event.metaKey; //
                    // Mac support
                    if ((!((event.keyCode > 47 && event.keyCode < 58) // 0 ~
                            // 9
                            || (event.keyCode > 95 && event.keyCode < 106) // numpad
                            // 0 ~
                            // numpad
                            // 9
                            || event.keyCode == 116 // F5
                            || event.keyCode == 46 // del
                            || event.keyCode == 35 // end
                            || event.keyCode == 36 // home
                            || event.keyCode == 37 // ←
                            || event.keyCode == 39 // →
                            || event.keyCode == 8 // backspace
                            || event.keyCode == 9 // tab
                            // || event.keyCode == 110 // numpad .
                            || event.keyCode == 13 // Enter
                            || event.keyCode == 189 // -
                            || event.keyCode == 109 // numpad -
                            || event.keyCode == 173 // - (firefox only)
                            || (event.shiftKey && event.keyCode == 35) // shift
                            // +
                            // end
                            || (event.shiftKey && event.keyCode == 36) // shift
                            // +
                            // home
                            || event.ctrlKey // allow all ctrl combination
                            || event.keyCode == 229 // ten-key processing
                        ))
                        || (event.shiftKey && (event.keyCode > 47 && event.keyCode < 58)) // exlcude
                    // Shift
                    // +
                    // [0~9]
                    ) event.preventDefault();
                });
        $(document).on('focus', 'input.negative:enabled', function() {
            var val = $(this).val();
            $(this).val(val.replace(/,/g, "")).select();
        });
        $(document).on('blur', '.negative', function () {
            var amount = $(this).val();
            if(amount< 0) {
                $(this).addClass('color-red');
            } else {
                $(this).removeClass('color-red');
            }
            if(! $.isNumeric(amount)) {
                $(this).val('');
            } else {
                $(this).val(formatNumber(amount,0));
            }
        });
        //only-number
        $(document).on('blur', 'input.only-number', function() {
            try {
                if (!_validateNumber($(this).val())) {
                    $(this).val('');
                }else{
                    if($(this).hasClass('validate-to')){
                        if(($(this).val() * 1)==0){
                            $(this).val('');
                        }
                    }
                }
            } catch (e) {
                console.log("input.only-number "+e.message);
            }
        });
        $(document).on('blur', 'input.tel, input.tel-mobile', function() {
            try {
                var string 	=	$(this).val();
                var reg2 	=	/^[0-9-]+$/;
                if(!string.match(reg2)){
                    $(this).val('');
                }
            } catch (e) {
                console.log(e.message);
            }
        });
        $(document).on('blur', 'input.post-code', function() {
            try {
                var string 	=	$(this).val();
                var reg2 	=	/^[0-9-]+$/;
                if(!string.match(reg2)){
                    $(this).val('');
                }else{
                    string = string.replace(/-/gi,'');
                    if($(this).val().length>=4){
                        $(this).val(string.substring(0,3) + '-' + string.substring(3,string.length));
                    }
                }
            } catch (e) {
                console.log(e.message);
            }
        });
        $(document).on('blur', 'input.padding-zero', function() {
            try {
                var maxLength = $(this).attr('maxlength');
                var input = $(this).val();
                if (!_validateNumber($(this).val())) {
                    $(this).val('');
                } else {
                    if(input != '') {
                        input = '000000000000000' + '' + input;
                        var tmp = input.substring(input.length,input.length -maxLength);
                        $(this).val(tmp);
                    }
                }
            } catch (e) {
                console.log(e.message);
            }
        });
        //keyup ten-key
        $(document).on('keyup',
            'input.tel, input.tel-mobile, input.only-number, input.number, input.numeric, input.money, input.rate, input.percentage, input.zip_cd, input.zip_cd_en, input.time, input.time25, input.time30, input.timeblock5', function() { //2016/03/30 sangtk add zip_cd_en
                var noSbcRegex = /[^\x00-\x7E]+/g;
                var target = $(this);
                try {
                    if(target.val().match(noSbcRegex))  {
                        target.val( target.val().replace(noSbcRegex, '') );
                    }
                } catch (e) {
                    console.log(e.message);
                }
            });
        // blur zip_cd
        $(document).on('blur', 'input.zip_cd', function() {
            var string = $(this).val();
            if (!_validateZipCd($(this).val())) {
                $(this).val('');
            }
        });
        // blur zip_cd_en
        $(document).on('blur', 'input.zip_cd_en', function() {
            var string = $(this).val();
            if (!_validateZipCdEn(string)) {
                $(this).val('');
            }
        });
        // blur katakana
        $(document).on('blur', 'input.katakana', function() {
            var string = $(this).val();
            if (_validateFullSize(string)) {
                $(this).val('');
            }
        });
        // blur fullsize
        $(document).on('blur', 'input.fullsize', function() {
            var string = $(this).val();
            if (!_validateKatakana(string)) {
                $(this).val('');
            }
        });
        // blur fullsize for textarea
        $(document).on('blur', 'textarea.fullsize', function() {
            var string = $(this).val();
            if (!_validateFullSize(string)) {
                $(this).val('');
            }
        });
        // blur alphabetkatakana
        $(document).on('blur', 'input.alphabetkatakana', function() {
            var string = $(this).val();
            if (!_validateHalfSizeAlphabet(string)) {
                $(this).val('');
            }
        });
        // blur not number
        $(document).on('blur', 'input.notnumber', function() {
            var string = $(this).val();
            var reg = /\d/;
            if (string.match(reg)) {
                $(this).val('');
            }
        });
        // blur alphanumeric
        $(document).on('blur', 'input.alphanumeric', function() {
            var string = $(this).val();
            if (!_validateHalfSizeAlphanumeric(string)) {
                $(this).val('');
            }
        });
        // focus zip_cd
        $(document).on('focus', 'input.zip_cd', function() {
            $(this).select();
        });
        // input blur time
        $(document)
            .on(
                'blur',
                'input.time',
                function() {
                    var string	=	'';
                    if ($(this).val().length==1){
                        string	= padZeroRight($(this).val(), 3);
                        string 	= padZeroLeft(string, 4);
                    }else{
                        string = padZeroRight($(this).val(), 4);
                    }
                    var reg1 = /^(([0-1][0-9])|(2[0-3])):[0-5][0-9]|[2][4]:[0][0]$/;
                    var reg2 = /^(([0-1][0-9])|(2[0-3]))[0-5][0-9]|[2][4][0][0]$/;
                    var reg3 = /^[2][4][0][0]$/;
                    if (string.match(reg1)) {
                        $(this).val(string);
                    } else if (string.match(reg2)) {
                        if($(this).val().length <=2){
                            $(this).val( string.substring(2) + ':' + string.substring(0, 2));
                        }else if($(this).val().length ==3){
                            $(this).val( string.substring(2) + ':' + string.substring(0, 1));
                        }else{
                            $(this).val( string.substring(0, 2) + ':' + string.substring(2));
                        }

                    } else {
                        $(this).val('');
                    }
                    if (!_validateTime($(this).val())) {
                        $(this).val('');
                    }
                });
        // input blur time25
        $(document).on(
            'blur',
            'input.time25',
            function() {
                var string	=	'';
                if ($(this).val().length==1){
                    string	= padZeroRight($(this).val(), 3);
                    string 	= padZeroLeft(string, 4);
                }else{
                    string = padZeroRight($(this).val(), 4);
                }
                var reg1 = /^([0-9][0-9]):[0-5][0-9]$/;
                var reg2 = /^([0-9][0-9])[0-5][0-9]$/;
                if (string.match(reg1)) {
                    $(this).val(string);
                } else if (string.match(reg2)) {
                    $(this).val(
                        string.substring(0, 2) + ':'
                        + string.substring(2));
                } else {
                    $(this).val('');
                }
                if (!_validateTime25($(this).val())) {
                    $(this).val('');
                }
            });
        // input blur hours23
        $(document).on(
            'blur',
            'input.hours23',
            function() {
                var string	=	'';
                if ($(this).val().length==1){
                    string	= padZeroLeft($(this).val(), 2);
                } else {
                    string	= $(this).val();
                }
                var reg = /\b(2[0-3]|[0-1]?[0-9])\b/;
                if (string.match(reg)) {
                    $(this).val(string);
                } else {
                    $(this).val('');
                }
                if (!_validateHours23(string)) {
                    $(this).val('');
                }
            });
        // input blur hours24
        $(document).on(
            'blur',
            'input.hours24',
            function() {
                var string	=	$(this).val();
                var tmpString = "";
                var reg = /^(2[0-4]|1[0-9]|[1-9])$/;
                if (string.match(reg)) {
                    if ($(this).val().length==1){
                        tmpString	= padZeroLeft($(this).val(), 2);
                    } else {
                        tmpString	= $(this).val();
                    }
                    $(this).val(tmpString);
                } else {
                    $(this).val('');
                }
                if (!_validateHours24(string)) {
                    $(this).val('');
                }
            });
        // input blur minutes59
        $(document).on(
            'blur',
            'input.minutes59',
            function() {
                var string	= $(this).val();
                var tmpString = "";
                var reg = /^([0-5]?[0-9])$/;
                if (string.match(reg)) {
                    if ($(this).val().length==1){
                        tmpString	= padZeroLeft($(this).val(), 2);
                    } else {
                        tmpString	= $(this).val();
                    }
                    $(this).val(tmpString);
                } else {
                    $(this).val('');
                }
                if (!_validateMinutes60(string)) {
                    $(this).val('');
                }
            });
        // input blur time25
        $(document).on(
            'blur',
            'input.time30',
            function() {
                var string	=	'';
                if ($(this).val().length==1){
                    string	= padZeroRight($(this).val(), 3);
                    string 	= padZeroLeft(string, 4);
                }else{
                    string = padZeroRight($(this).val(), 4);
                }
                var reg1 = /^([0-9][0-9]):[0-5][0-9]$/;
                var reg2 = /^([0-9][0-9])[0-5][0-9]$/;
                if (string.match(reg1)) {
                    $(this).val(string);
                } else if (string.match(reg2)) {
                    $(this).val(
                        string.substring(0, 2) + ':'
                        + string.substring(2));
                } else {
                    $(this).val('');
                }
                if (!_validateTime30($(this).val())) {
                    $(this).val('');
                }
            });
        // focus date
        $(document).on('focus', 'input.date', function(){
            var string = $(this).val();
            var reg = /^[0-9]{4}[\/.][0-9]{2}[\/.][0-9]{2}$/;
            if (string.match(reg)){
                $(this).val(string.replace(/\D/g,''));
            }
        });
        // input method for blur datepicker
        $(document).on('blur','input.date ',function() {
            var string = $(this).val();
            var reg1 = /^[0-9]{8}$/;
            var reg2 = /^[0-9]{4}[\/.][0-9]{2}[\/.][0-9]{2}$/;
            if (string.match(reg1)) {
                $(this).val(
                    string.substring(0, 4) + '/'
                    + string.substring(4, 6) + '/'
                    + string.substring(6));
            } else if (string.match(reg2)) {
                $(this).val(string);
            } else {
                var date = autoFormatDate($(this).val());
                var strDate = date;
                if(strDate !='' && strDate != 'undefined' && strDate !== undefined){
                    strDate = strDate.replace(/\//gi,'');
                    if(!_validateNumber(strDate)){
                        $(this).val('');
                    }else{
                        $(this).val(date);
                    }
                }
            }
            if (!_validateYyyyMmDd($(this).val())) {
                var date = autoFormatDate($(this).val());
                var strDate = ( date !='undefined' ?  'date' : '' );
                strDate = strDate.replace(/\//gi,'');
                if(!_validateNumber(strDate)){
                    $(this).val('');
                }else{
                    $(this).val(date);
                }
            }
            //HiepNV - check valid date afer auto format
            if(!moment($(this).val(),"YYYY/MM/DD").isValid()){
                $(this).val('');
            }
        });
        $(document).on( 'blur', 'input.longlat',function() {
            try {
                var string = $(this).val();
                for(var i=0; i<string.length;i++){
                    if(string[i] == "°") string = string.replace("°","");
                }
                var reg1 = /^[0-9.,"'newsNEWS/\s/g]+$/;
                if (!string.match(reg1)) {
                    $(this).val('');
                }
            } catch (e) {
                console.log(e.message);
            }
        });
        $(document).on(
            'blur',
            'input.month',
            function() {
                try {
                    var string = $(this).val();
                    var reg1 = /^[0-9]{6}$/;
                    var reg2 = /^[0-9]{4}[\/.][0-9]{2}$/;
                    if (string.match(reg1)) {
                        $(this).val(
                            string.substring(0, 4) + '/'
                            + string.substring(4, 6));
                        $(this).val(set_limit_date_month($(this).val()));
                    } else if (string.match(reg2)) {
                        $(this).val(string);
                        $(this).val(set_limit_date_month($(this).val()));
                    } else {
                        $(this).val('');
                    }
                    if (string.replace(/\D/g, '') != $(this).attr('old')) {
                        $(this).next('.hasYmpicker').trigger('change');
                    }
                    if (!_validateYyyyMm($(this).val())) {
                        $(this).val('');
                    }
                } catch (e) {
                    console.log(e.message);
                }
            });
        $(document).on('focus', 'input.month', function() {
            try {
                var string = $(this).val();
                var reg = /^[0-9]{4}[\/.][0-9]{2}$/;
                if (string.match(reg)) {
                    $(this).val(string.replace(/\D/g, ''));
                    $(this).attr('old', string.replace(/\D/g, ''));
                }
            } catch (e) {
                console.log(e.message);
            }
        });
        // zip code
        $(document)
            .on(
                "keydown",
                'input.zip_cd, input.zip_cd_en', //2016/03/30 sangtk add zip_cd_en
                function(e) {
                    // if(e.shiftKey){
                    // e.preventDefault();
                    // }
                    // Allow: backspace, delete, tab, escape, enter, -
                    if ($.inArray(e.keyCode, [ 46, 8, 9, 27, 13, 109,
                            110, 116, 117, 173, 189, 229]) !== -1 // 2016/03/25 sangtk add 299 for tenkey processing
                        ||
                        // Allow: Ctrl+A, C, X, V
                        ($.inArray(e.keyCode,
                            [ 65, 67, 86, 88, 116 ]) !== -1 && e.ctrlKey === true)
                        ||
                        // Allow: home, end, left, right
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                        // let it happen, don't do anything
                        return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57))
                        && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
        // numeric
        $(document)
            .on(
                'keydown',
                'input.numeric:enabled',
                function(e) {
                    if (!((e.keyCode > 47 && e.keyCode < 58)
                        || (e.keyCode > 95 && e.keyCode < 106)
                        // ////////// PERIOD SIGN
                        // ////////////////////////////////////////////////////////////////
                        || ((e.keyCode == 190 || e.keyCode == 110) && $(
                            this).val().indexOf('.') === -1)
                        || e.keyCode == 173
                        || e.keyCode == 109
                        || e.keyCode == 189
                        || e.keyCode == 116
                        || e.keyCode == 46
                        || e.keyCode == 37
                        || e.keyCode == 39
                        || e.keyCode == 8
                        || e.keyCode == 9
                        || e.keyCode == 229 // ten-key processing
                    )) {
                        e.preventDefault();
                        return false;
                    }
                    var negativeEnabled = $(this).attr('negative');
                    var percen = $(this).attr('percen');
                    if (e.keyCode != 116
                        && e.keyCode != 46
                        && e.keyCode != 37
                        && e.keyCode != 39
                        && e.keyCode != 8
                        && e.keyCode != 9
                        && e.keyCode != 173
                        && e.keyCode != 189
                        && e.keyCode != 109
                        && ($(this).get(0).selectionEnd - $(this)
                            .get(0).selectionStart) < $(this)
                            .val().length) {
                        // DEFAULT PARAMS (NUMERIC (10, 0))
                        var ml = 10;
                        var dc = 0;
                        if (parseInt($(this).attr('maxlength')) * 1 > 2) {
                            //ml = 1 * $(this).attr('maxlength') - 1;
                            ml = 1 * $(this).attr('maxlength');
                        }
                        if (parseInt($(this).attr('decimal')) > 0) {
                            dc = 1 * $(this).attr('decimal');
                            if (dc >= ml - 1) {
                                dc = 0;
                            }
                        }
                        var it = (ml - (dc > 0 ? (dc + 1) : 0));
                        // CURRENT STATES
                        var val = $(this).val();
                        var negative = val.indexOf('-') > -1;
                        var selectionStart = $(this).get(0).selectionStart;
                        var selectionEnd = $(this).get(0).selectionEnd;
                        if (negative) {
                            val = val.substring(1);
                            selectionStart--;
                            selectionEnd--;
                        }
                        // OUTPUT STATES
                        var destSelectionStart = undefined;
                        var destSelectionEnd = undefined;
                        var destVal = undefined;
                        // SKIP PERIOD KEY WHEN DECIMAL = 0
                        if (dc == 0
                            && (e.keyCode == 190 || e.keyCode == 110)) {
                            e.preventDefault();
                        }
                        // EXCEED THE ACCEPTED NUMBER OF INTEGERS
                        if (val.match(new RegExp('[0-9]{' + it + '}'))
                            && selectionStart <= it) {
                            // PERIOD DOES NOT EXIST
                            if (val.indexOf('.') === -1) {
                                // PERIOD KEY NOT RECEIVED (USER FORGETS
                                // TO TYPE PERIOD)
                                // DECIMAL > 0
                                if (e.keyCode != 190
                                    && e.keyCode != 110 && dc > 0) {
                                    e.preventDefault();
                                    var output = val.substring(0,
                                        selectionStart)
                                        + String
                                            .fromCharCode((96 <= e.keyCode && e.keyCode <= 105) ? e.keyCode - 48
                                                : e.keyCode)
                                        + val
                                            .substring(selectionStart);
                                    // INSERT PERIOD
                                    destVal = output.substring(0, ml
                                        - (dc + 1))
                                        + '.'
                                        + output.substring(ml
                                            - (dc + 1));
                                }
                                // PERIOD EXISTS
                                // CARET STARTS NEXT TO THE PERIOD
                            } else if (selectionStart == val
                                .indexOf('.')) {
                                // EXCEED THE ACCEPTED NUMBER OF
                                // DECIMALS
                                if (val.match(new RegExp('\\.[0-9]{'
                                    + dc + '}$'))) {
                                    e.preventDefault();
                                } else {
                                    // JUMP TO THE NEXT POSITION THEN
                                    // INSERT THE DIGIT
                                    destSelectionStart = selectionStart + 1;
                                }
                                // CARET STARTS BEFORE THE PERIOD AND
                                // NOTHING HIGHLIGHTED
                            } else if (selectionStart < val
                                    .indexOf('.')
                                && selectionStart == selectionEnd) {
                                e.preventDefault();
                                // CARET STARTS BEFORE THE PERIOD AND
                                // ENDS AFTER THE PERIOD (HIGHLIGHTS
                                // OVER THE PERIOD)
                            } else if (selectionEnd > val.indexOf('.')
                                && selectionStart < val
                                    .indexOf('.')) {
                                e.preventDefault();
                                var output = val.substring(0,
                                    selectionStart)
                                    + String
                                        .fromCharCode((96 <= e.keyCode && e.keyCode <= 105) ? e.keyCode - 48
                                            : e.keyCode)
                                    + val.substring(selectionEnd);
                                destVal = output.substring(0, ml
                                    - (dc + 1))
                                    + '.'
                                    + output.substring(ml
                                        - (dc + 1));
                                destSelectionStart = selectionStart + 1;
                                destSelectionEnd = selectionStart + 1;
                            }
                            // INTEGERS CAN BE ADDED BUT...
                            // EXCEED THE ACCEPTED NUMBER OF DECIMALS
                        } else if (val.match(new RegExp('\\.[0-9]{'
                            + dc + '}$'))) {
                            // PERIOD EXISTS
                            // CARET STARTS AFTER THE PERIOD
                            if (val.indexOf('.') != -1
                                && selectionStart > val
                                    .indexOf('.')) {
                                e.preventDefault();
                            }
                        }
                        // CARET RESULT
                        if (destVal && negative) {
                            destVal = '-' + destVal;
                        }
                        if (destVal) {
                            $(this).val(destVal);
                        }
                        if (negative && destSelectionStart) {
                            destSelectionStart++;
                        }
                        if (destSelectionStart) {
                            $(this).get(0).selectionStart = destSelectionStart;
                        }
                        if (negative && destSelectionEnd) {
                            destSelectionEnd++;
                        }
                        if (destSelectionEnd) {
                            $(this).get(0).selectionEnd = destSelectionEnd;
                        }
                    } else if (e.keyCode == 173 || e.keyCode == 109
                        || e.keyCode == 189) {
                        e.preventDefault();
                        if (negativeEnabled) {
                            var val = $(this).val();
                            var negative = val.indexOf('-') > -1;
                            if (negative) {
                                $(this).val(val.substring(1));
                            } else {
                                $(this).val('-' + val);
                            }
                        }
                        if(1*percen	==1){
                            var val = $(this).val().replace(/[-,%]/g, '');
                            $(this).val(val+'%');
                        }
                    }
                    // fix maxlenght
                    var val = $(this).val();
                    if ($(this).attr('fixed') != undefined
                        && val.indexOf('-') > -1) {
                        var f_maxlenght = (parseInt($(this).attr(
                            'maxlengthfixed')) + 1)
                            + '';
                        if (val.length <= f_maxlenght) {
                            $(this).attr('maxlength', f_maxlenght);
                        } else {
                            $(this).attr('maxlength', f_maxlenght);
                        }
                    } else if ($(this).attr('maxlength') > $(this)
                        .attr('maxlengthfixed')) {
                        $(this).attr('maxlength',
                            $(this).attr('maxlengthfixed'));
                    }
                });
        // input method for numeric
        $(document)
            .on(
                'blur',
                'input.numeric:enabled',
                function() {
                    try {
                        var negativeEnabled = $(this).attr('negative');
                        var percen = $(this).attr('percen');
                        var val = $(this).val();
                        var negative = val.indexOf('-') > -1;
                        if (negative) {
                            val = val.substring(1);
                        }
                        var old = val;
                        val = val.replace('.', '');
                        val = old;
                        var dc = 1 * $(this).attr('decimal');
                        var result = parseFloat(val.replace(/,/g, ""));
                        if (result || result === 0) {
                            result = result.toFixed(dc);
                            if (result.indexOf('.') > -1) {
                                var integer = result.substring(0,
                                    result.indexOf('.')).replace(
                                    /\B(?=(\d{3})+(?!\d))/g, ",");
                                var decimal = result.substring(result
                                    .indexOf('.'));
                                var ml = typeof $(this).attr('maxlength') != 'undefined' ? parseInt($(this).attr('maxlength')) : 0;
                                if(ml > 0 && integer.length > (ml-2)){
                                    var num = ml-dc-1;
                                    var tmp = $(this).val().replace('.', "");
                                    integer = parseFloat(tmp.substring(0,num));
                                    decimal = parseFloat('0.'+tmp.substring(num,num+dc));
                                }
                                val = integer + decimal;
                            } else {
                                val = result.replace(
                                    /\B(?=(\d{3})+(?!\d))/g, ",");
                            }
                        } else {
                            val = '';
                        }
                        $(this)
                            .val(
                                (val != '' && val != '0'
                                    && negativeEnabled && negative) ? ('-' + val)
                                    : val);
                        if(1*percen==1){
                            val	=	val.replace(/[%]/g, '');
                            $(this).val(val+'%');
                        }
                    } catch (e) {
                        console.log('Error input.numeric blur event: '
                            + e.message);
                    }
                });
        // blur money, amount,rate, percentage
        $(document).on('blur', 'input.amount, input.rate, input.percentage',
            function(event) {
                var item = $(this);
                var value = item.val().replace(/,/gi, '');
                if (value != '') {
                    if ($.isNumeric(value)) {
                        value = addCommas(value);
                        if (value == 0) {
                            item.val('');
                        } else {
                            item.val(value);
                        }
                    } else {
                    }
                }
            });
        // format money
        $("input.money").keyup(function(e) {
            var val = parseInt($(this).val());
            if (val == 0) {
                $(this).val('');
                return;
            }
            $(this).val(formatMoney(val));
        });
        function formatMoney(num) {
            var str = num.toString(), parts = false, output = [], i = 1, formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ",") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(",");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return (formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        }
        // focus numeric
        $(document).on('focus', 'input.numeric:enabled', function() {
            var val = $(this).val();
            var negative = val.indexOf('-') > -1;
            var percen	=	$(this).attr('percen');
            if (negative) {
                val = val.substring(1);
            }
            val = val.replace(/,/g, "");
            $(this).val(negative ? ('-' + val) : val);
            if (1*percen	==	1){
                val	=	val.replace(/%/g, '');
                $(this).val(val+'%');
            }
            $(this).select();
        });
        $(document).on('focus', 'input:enabled,textarea:enabled', function() {
            $( "body" ).delegate( "*", "focus blur", function() {
                var elem = $( this );
                setTimeout(function() {
                    elem.toggleClass( "item-focused", elem.is( ":focus" ) );
                }, 0 );
            });
            $(this).select();
        });
        // change upload-file
        $(document).on(
            'change',
            '.upload-file',
            function() {
                $(this).parents('.upload').find('.input-path').val(
                    $(this).val().replace(/^.*[\\\/]/, ''));
            });
        // focus money item
        $(document).on('focus', 'input.money', function() {
            $(this).val($(this).val().replace(/,/g, ''));
            $(this).select();
        });
        // focus time item
        $(document).on('focus', 'input.time, input.time25, input.time30, input.timeblock5', function() {
            $(this).val($(this).val().replace(/:/g, ''));
            $(this).select();
        });
    } catch (e) {
        console.log('initialize' + e.message);
    }
}

/**
 * _autoFormattingDate
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function _autoFormattingDate(target) {
    $(target)
        .focusout(
            function() {
                var string = $(this).val();
                if (string.length == 8) {
                    string = string.substring(0, 4) + '/'
                        + string.substring(4, 6) + '/'
                        + string.substring(6);
                }
                var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[13578]|1[02])[\/.]31|((19|[2-9][0-9])[0-9]{2}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|((19|[2-9][0-9])[0-9]{2}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)$/;
                if (string.match(reg)) {
                    $(this).val(string);
                }
            });
}
/**
 * _autoFormattingMonth
 *
 * @author : viettd - 2015/10/02 - create
 * @author :
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function _autoFormattingMonth(target) {
    $(target)
        .focusout(
            function() {
                var string = $(this).val();
                if (!($(this).hasClass('from-month'))) {
                    if (string.length == 6) {
                        string = string.substring(0, 4) + '/'
                            + string.substring(4, 6);
                    }
                    var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[1-9]|1[0-2])$/;
                    if (string.match(reg)) {
                        $(this).val(string);
                    }
                } else {
                    switch (string.length) {
                        case 6:
                            string = string.substring(0, 4) + '/'
                                + string.substring(4, 6) + '/01';
                            break;
                        case 7:
                            string = string.substring(0, 4)
                                + string.substring(4, 7) + '/01';
                            break;
                        case 8:
                            string = string.substring(0, 4) + '/'
                                + string.substring(4, 6) + '/'
                                + string.substring(6);
                            break;
                    }
                    var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[1-9]|1[0-2])[\/.](01)$/;
                    if (string.match(reg)) {
                        $(this).val(string);
                    }
                }
            });
}
/**
 * add comma function
 *
 * @param nStr
 * @return str
 */
function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
/**
 * format phone, fax number
 *
 * @param string
 * @param input
 */
function _validatePhoneFaxNumber(string) {
    try {
        string = _formatString(string);
        var reg = /^[0-9]+[-][0-9]+[-][0-9]+$/;
        if (string.match(reg) || string == '') {
            return true;
        }
        return false;
    } catch (e) {
        console.log('_validatePhoneFaxNumber: ' + e);
    }
}
/**
 * Check number
 *
 * @param string
 * @returns {Boolean}
 */
function _validateNumber(string) {
    try {
        string = _formatString(string);
        var regexp = /^[0-9]+$/;
        if (regexp.test(string) || string == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        console.log('_ValidateNumber: ' + e);
    }
}
/**
 * Convert Full-width to Half-width Characters
 *
 * @param string
 * @returns string
 */
function _formatString(string) {
    try {
        string = $.textFormat(string, '9');
        string = $.textFormat(string, '@');
        string = $.textFormat(string, 'a');
        string = $.textFormat(string, 'A');
        return string;
    } catch (e) {
        console.log('_formatString: ' + e);
    }
}
/**
 * check length of string
 *
 * @param string
 * @param length
 * @returns {Bolean}
 */
function _validateLength(string, length) {
    try {
        var len = string.length;
        if (len > length) {
            return false;
        } else {
            return true;
        }
    } catch (e) {
        console.log('_validateLength: ' + e);
    }
}
/**
 * check full size
 *
 * @param string
 * @returns {boolean}
 */
function _validateFullSize(string) {
    try {
        // string = $.rtrim(string);
        string = $.mbRTrim(string);
        if ($.byteLength(string) != string.length) {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        console.log('_validateFullSize: ' + e);
    }
}
/**
 * validate zip code
 *
 * @param string
 * @returns {boolean}
 */
function _validateZipCd(zip_cd) {
    try {
        zip_cd = _formatString(zip_cd);
        var reg1 = /^[0-9]{3}-[0-9]{4}$/;
        var reg2 = /^[0-9]{3}[0-9]{4}$/;
        //
        if (zip_cd.match(reg1) || zip_cd.match(reg2) || zip_cd == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        console.log('_validateZipCd: ' + e);
    }
}
/**
 * validate zip code en
 *
 * @param string
 * @returns {boolean}
 */
function _validateZipCdEn(zip_cd_en) {
    try {
        zip_cd_en = _formatString(zip_cd_en);
        var reg1 = /^\d+(-\d+)*$/;
        //
        if (zip_cd_en.match(reg1) || zip_cd == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        console.log('_validateZipCdEn: ' + e);
    }
}


/**
 * function validate money
 *
 * @param string
 * @param real
 * @param img
 * @returns {Boolean}
 */
function _validateMoney(string, real, img) {
    try {
        string = string.replace(/,/gi, "");
        if (string == '') {
            return true;
        } else {
            string = _formatString(string);
            if (string.indexOf('.') > -1) {
                var res = string.split('.');
                if (res[0].length > real || res[1].length > img) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (string.length > real) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    } catch (e) {
        console.log('_validateMoney: ' + e);
    }
}

/**
 * Check percent number money
 *
 * @param string
 * @returns {Boolean}
 */
function _validatePercentMoney(string) {
    string = _formatString(string);
    if (string != '') {
        var number = parseInt(string);
        if (number >= 0 && number <= 100) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}
/**
 * Check number
 *
 * @param string
 * @returns {Boolean}
 */
function _validateZero(string) {
    try {
        string = _formatString(string);
        string = parseInt(string) * 1 || 0;
        if (string != 0) {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        console.log('_validateZero: ' + e);
    }
}

/**
 * _formatInput
 */
function _formatInput(mode) {
    try {

        // format date
        $('input.date').attr('placeholder','yyyy/mm/dd');
        if ($('input.date') && $('input.date').length > 0) {
            $('input.date').each(function() {
                if ($(this).is('[readonly]') || $(this).is('[disabled]')) {
                    $(this).datepicker('destroy');
                } else {
                    if (!$(this).hasClass('hasDatepicker')) {
                        $.appendDatepicker($(this));
                    }
                }
            });
        }
        // format month
        if ($('input.month') && $('input.month').length > 0) {
            $('input.month').each(function() {
                if ($(this).is('[readonly]') || $(this).is('[disabled]')) {
                    $(this).ympicker('destroy');
                } else {
                    if (!$(this).hasClass('hasYmpicker')) {
                        $.appendYmpicker($(this));
                        $(this).attr('maxlength', 7);
                    }
                }
            });
        }
        // format point
        $('input.point').each(function() {
            var string = $(this).val();
            var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]))$/;
            if (string.match(reg)) {
                $(this).val(string);
            } else {
                $(this).val('');
            }
        });
        // format rate
        $('input.rate').each(function() {
            var string = $(this).val();
            var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]{1,2}))$/;
            if (string.match(reg)) {
                $(this).val(string);
            }
        });
        // format money
        $('input.money').each(
            function() {
                var length = 99;
                try {
                    length = parseInt($(this).attr('maxlength'))
                        - Math
                            .floor(parseInt($(this).attr(
                                'maxlength')) / 4);
                } catch (e) {
                    length = 99;
                }
                $(this).priceFormat({
                    limit : length,
                    prefix : '',
                    centsSeparator : '',
                    thousandsSeparator : ',',
                    clearOnEmpty : true,
                    centsLimit : 0
                });
            });
        // format cash
        $('input.cash').each(
            function() {
                var length = 99;
                try {
                    length = parseInt($(this).attr('maxlength'))
                        - Math
                            .floor(parseInt($(this).attr(
                                'maxlength')) / 4);
                } catch (e) {
                    length = 99;
                }
                $(this).priceFormat({
                    limit : length,
                    prefix : '',
                    centsSeparator : '',
                    thousandsSeparator : ',',
                    allowNegative : true,
                    clearOnEmpty : true,
                    centsLimit : 0
                });
            });
        // format zip_cd
        $('input.zip_cd').each(function(index) {
            if (!_validateZipCd($(this).val())) {
                $(this).val('');
            }
        });
        $('input.padding-zero').each(function() {
            var maxLength = $(this).attr('maxlength');
            var input = $(this).val();
            if (!_validateNumber($(this).val())) {
                $(this).val('');
            } else {
                if(input != '') {
                    input = '000000000000000' + '' + input;
                    var tmp = input.substring(input.length,input.length - maxLength);
                    $(this).val(tmp);
                }
            }
        });
        $(".only-number, .numeric").bind('paste', function(e) {
            var _this = $(this);
            setTimeout(function(e) {
                if (!_validateNumber($(_this).val())) {
                    $(_this).val('');
                }
            }, 0);
        });
        //disable tabindex input
        $('input[readonly="readonly"]').attr('tabindex','-1');
        $('input[readonly=""]').attr('tabindex','-1');
        $('button').attr('tabindex','-1');


    } catch (e) {
        console.log('_formatInput: ' + e.toString());
    }
}
/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyyMm(string) {
    if (string == '') {
        return true;
    }
    string = _formatString(string);
    var reg = /^([0-9]{4})\/(0[1-9]|1[0-2])$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Date
 *
 * @param string
 * @returns {Boolean}
 */
function _validateYyyyMmDd(string) {
    if (string == '') {
        return true;
    }
    if (string.length == 8) {
        string = string.substring(0, 4) + '/' + string.substring(4, 6) + '/'
            + string.substring(6);
    }
    string = _formatString(string);
    var reg = /^((19|[2-9][0-9])[0-9]{2})[\/.](0[13578]|1[02])[\/.]31|((19|[2-9][0-9])[0-9]{2}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|((19|[2-9][0-9])[0-9]{2}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)$/;
    if (string.match(reg)) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Time
 *
 * @param string
 * @returns {Boolean}
 */
function _validateTime(string) {
    string = _formatString(string);
    var reg = /^(([0-1][0-9])|(2[0-3])):[0-5][0-9]|[2][4]:[0][0]$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Time
 *
 * @param string
 * @returns {Boolean}
 */
function _validateTime25(string) {
    string = _formatString(string);
    var reg = /^([0-9][0-9]):[0-5][0-9]$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check hours of time < 24
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHours23(string) {
    string = _formatString(string);
    var reg = /\b(2[0-3]|[0-1]?[0-9])\b/;
    if (string.match(reg) && parseInt(string) < 24) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check hours of time 1 - 24
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHours24(string) {
    string = _formatString(string);
    var reg = /^(2[0-4]|1[0-9]|[1-9])$/;
    if (string.match(reg) && parseInt(string) >= 1 && parseInt(string) <= 24) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check minutes of time < 60
 *
 * @param string
 * @returns {Boolean}
 */
function _validateMinutes60(string) {
    string = _formatString(string);
    var reg = /^[0-5]?[0-9]$/;
    if (string.match(reg) && parseInt(string) < 60) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Time
 *
 * @param string
 * @returns {Boolean}
 */
function _validateTime30(string) {
    string = _formatString(string);
    var reg = /^([0-9][0-9]):[0-5][0-9]$/;
    var timeInt	=	1*(string.replace(/:/gi,''));
    if ((string.match(reg) || string == '') && timeInt<3060) {
        return true;
    } else {
        return false;
    }
}
/**
 * Check DateTime
 *
 * @param string
 * @returns {Boolean}
 */
function _validateDateTime(string) {
    string = _formatString(string);
    var reg = /^(((19|[2-9][0-9])[0-9]{2})[\/.](0[13578]|1[02])[\/.]31|((19|[2-9][0-9])[0-9]{2}[\/.](01|0[3-9]|1[0-2])[\/.](29|30))|((19|[2-9][0-9])[0-9]{2}[\/.](0[1-9]|1[0-2])[\/.](0[1-9]|1[0-9]|2[0-8]))|((((19|[2-9][0-9])(04|08|[2468][048]|[13579][26]))|2000)[\/.](02)[\/.]29)) ((([0-1][0-9])|(2[0-3])):[0-5][0-9])$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Validate Point(xxx.x)
 */
function _validatePoint(string) {
    string = _formatString(string);
    var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]))$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Validate Rate(xxx.xx)
 */
function _validateRate(string) {
    string = _formatString(string);
    var reg = /^(([0-9]{1,3})|([0-9]{1,3}\.[0-9]{1,2}))$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Money
 *
 * @param string
 * @returns {Boolean}
 */
function _validateCash(string) {
    string = _formatString(string);
    var reg = /^[\-]?[0-9]{1,3}(\,[0-9]{3})*$/;
    if (string.match(reg) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Tel Number
 *
 * @param string
 * @returns {Boolean}
 */
function _validatePhoneNumber(string) {
    string = _formatString(string);
    var reg = /^((\([0-9]{4}\)[0-9]{4}|[0-9]{4}\-[0-9]{4}|[0-9]{8})|(\([0-9]{2,3}\)|[0-9]{2,3}|[0-9]{2,3}-)(\([0-9]{3,4}\)[0-9]{3,4}|[0-9]{3,4}\-[0-9]{3,4}|[0-9]{6,8}))$/;
    if (reg.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check URL
 *
 * @param string
 * @returns {Boolean}
 */
function _validateUrl(string) {
    string = _formatString(string);
    var regexp = /^((http|https):\/\/)?(www\.)?([a-zA-Z0-9\-_]{2,}\.){1,3}[a-z]{2,}(\/|\/[\w#?+=&%@\-\/\.]*)?$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Email Address
 *
 * @param string
 * @returns {Boolean}
 */
function _validateEmail(string) {
    // string = _formatString(string);
    var regexp = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check halfsize alphanumeric
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHalfSizeAlphanumeric(string) {
    // string = _formatString(string);
    var regexp = /^[a-zA-Z0-9]+$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check halfsize alphabet
 *
 * @param string
 * @returns {Boolean}
 */
function _validateHalfSizeAlphabet(string) {
    // string = _formatString(string);
    var regexp = /^[a-zA-Z]+$/;
    if (regexp.test(string) || string == '') {
        return true;
    } else {
        return false;
    }
}
/**
 * Check Katakana String
 *
 * @param string
 * @returns {Boolean}
 */
function _validateKatakana(string) {
    if(string != '') {
        /**
         * 2015/01/16
         * check is string fullsize?
         */
            //  return /^[\u3000-\u303f\u3040-\u309f\u30a0-\u30ff\uff00-\uff9f\u4e00-\u9faf\u3400-\u4dbf\u25cb\u00d7]+$/.test(string.replace(/\r?\n|\r/g, ''));
        var isFullSize  = /^[^\uff65-\uffef\u4db6-\u4dbf\ue000-\ue757\u0020-\u007e]+$/.test(string.replace(/\r?\n|\r|\s/g, ''));
        return isFullSize;
    }else{
        return true;
    }
}
/**
 * Convert Full-width to Half-width Characters
 *
 * @param string
 * @returns string
 */
function _formatString(string) {
    string = $.textFormat(string, '9');
    string = $.textFormat(string, '@');
    string = $.textFormat(string, 'a');
    string = $.textFormat(string, 'A');
    return string;
}
/**
 * _validateNumber
 *
 * @param :
 *            string
 * @returns : {Boolean}
 */
function _validateNumber(string) {
    try {
        var regexp = /^-*[0-9]+$/;
        if (regexp.test(string) || string == '') {
            return true;
        } else {
            return false;
        }
    } catch (e) {
        console.log(e.message);
    }
}
/**
 * _validateFromToDate
 *
 * @return : true/false
 * @access : public
 * @see :
 */
function _validateFromToDate(from, to) {
    try {
        if (from != '' && to != '') {
            var fromDate = new Date(from);
            var toDate = new Date(to);
            if (fromDate.getTime() > toDate.getTime()) {
                return false;
            }
        }
        return true;
    } catch (e) {
        console.log('_validateFromToDate:' + e.message);
    }

}

/**
 * _validateFromToDate
 *
 * @return : true/false
 * @access : public
 * @see :
 */
function _validateFromToTime(from, to) {
    try {
        if (from != '' && to != '') {
            if (parseInt(from) > parseInt(to)  ) {
                return false;
            }
        }
        return true;
    } catch (e) {
        console.log('_validateFromToTime:' + e.message);
    }

}
/**
 * padZeroLeft
 *
 * @param :
 *            $data
 * @param :
 *            $max
 * @return : null
 * @access : public
 * @see :
 */
function padZeroLeft($data, $max) {
    try {
        var length = $max - $data.length;
        var zero = '';
        if (length == $max) {
            return '';
        }
        for (var i = 0; i < length; i++) {
            zero = zero + '0';
        }
        return zero + $data;
    } catch (e) {
        console.log('padZeroLeft' + e.message);
    }
}
/**
 * padZeroRight
 *
 * @param :
 *            $data
 * @param :
 *            $max
 * @return : null
 * @access : public
 * @see :
 */
function padZeroRight($data, $max) {
    try {
        var length = $max - $data.length; // alert(length);
        var zero = '';
        if (length == $max) {
            return '';
        }
        for (var i = 0; i < length; i++) {
            zero = zero + '0';
        }
        return $data+zero;
    } catch (e) {
        console.log('padZeroRight' + e.message);
    }
}
/**
 * htmlEntities
 *
 * @params : null
 * @return : null
 * @access : public
 * @see :
 */
function htmlEntities(str) {
    try {
        if (str == undefined) {
            str = '';
        }
        return str.replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(
            /&gt;/g, '>').replace(/&quot;/g, '"');
    } catch (e) {
        console.log('htmlEntities' + e.message);
    }
}
/**
 * calculate age from birthday
 *
 * @return : null
 * @access : public
 * @see :
 */
function calculateAge(dateString) {
    try {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        if (isNaN(age)){
            age	=	'';
        }
        return age;
    } catch (e) {
        console.log('calculate age from birthday' + e.message);
    }
}
/**
 * priceFormat of function
 *
 * @param  : 999999
 * @return : 999,999
 */
function priceFormat(val) {
    try {
        var rgx = /(\d+)(\d{3})/;
        str = val + '';
        while (rgx.test(str)) {
            str = str.replace(rgx, '$1' + ',' + '$2');
        }
        return (str);
    } catch (e) {
        console.log('priceFormat: ' + e.message);
    }
}
/**
 * unPriceFormat
 *
 * @author		:	viettd - 2016/02/17 - create
 * @author		:
 * @params		:	999,999
 * @return		:	999999
 * @access		:	public
 * @see			:
 */
function unPriceFormat(val) {
    try {
        var res = 0;
        if(val != ''){
            res = val.replace(/,/g , '');
        }
        return (res);
    } catch (e) {
        console.log('unPriceFormat: ' + e.message);
    }
}
/**
 * formatNumber
 * @param val
 * @param num
 * @param displayzero
 * @returns
 */
function formatNumber (val, num, displayzero) {
    try {
        if (!num) {
            num = 0;
        }
        if(!displayzero) {
            displayzero =  true;
        }
        if(val*1 == 0 && displayzero) {
            return '';
        } else if(val*1 == 0 && !displayzero) {
            return 0;
        } else {
            return addCommas(val);
        }

    } catch (e) {
        console.log('formatNumber: ' + e.message);
    }
}
function pad(n, width, z) {
    z = z || '0';
    n = n + '';
    return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
}

function _commonShowError(object,areaSelector) {
    _commonClearError(areaSelector);
    if(areaSelector){
        $.each( object, function( key, value ) {
            $(areaSelector).find('[name="'+key+'"]')._addError(value);
        });
    }else{
        $.each( object, function( key, value ) {
            $('[name="'+key+'"]')._addError(value);
        });
    }

}

/**
 *
 * @param areaSelector : limit area effected
 * @private
 */
function _commonClearError(areaSelector) {
    if(areaSelector){
            $(areaSelector).find('.input-error')._removeError();
    }else{
            $('.input-error')._removeError();
    }

}


