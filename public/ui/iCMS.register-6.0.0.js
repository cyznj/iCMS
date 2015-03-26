(function($) {
  iCMS.user.register = function() {
    var register = $("#iCMS-register-box");
    $(".iCMS_register_btn", register).click(function(event) {
      event.preventDefault();
      var _checkform = false,
        param = {
          'action': 'register',
          'openid': $('#iCMS-openid').val(),
          'gender': $('input[name="gender"]:checked').val()
        };
      $("input[id^='iCMS-reg-']", register).each(function() {
        check_form(this);
        //console.log(this.id, this.name, !$(this).data('check'))
        if (!$(this).data('check')) {
          _checkform = true;
          return false;
        }
        //console.log(this.id, 'ok')
        if (this.name) {
          param[this.name] = this.value;
        }
      });
      if (_checkform) return false;

      var param = $.extend(iCMS.user.OPENID,param);

      $.post(iCMS.api('user'), param, function(ret) {
        if (ret.code) {
          window.location.href = ret.forward;
        } else {
          iCMS.seccode(0,register);
          var a = document.getElementById('iCMS-reg-' + ret.forward);
          msg(a, ret.msg);
        }
      }, 'json');

    })

    $("input[id^='iCMS-reg-']", register).click(function() {
      if (!$(this).data('check')) {
        msg(this, 'def');
      }
    }).blur(function() {
      check_form(this);
    });

    $("[name=agreement]").click(function() {
      $(this).prop("checked", true);
    });

  }

  function check_form(a) {
    if (a.value == "") {
      return msg(a, 'empty');
    }
    switch (a.name) {
      case 'username':
        var pattern = /^([a-zA-Z0-9._-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9._-])+/;
        if (!pattern.test(a.value)) {
          return msg(a, "err");
        }
        ajax_check(a);
        break;
      case 'nickname':
        var length = a.value.replace(/[^\x00-\xff]/g, 'xx').length;
        if (length < 4) {
          return msg(a, "err");
        }
        if (length > 20) {
          return msg(a, "err");
        }
        ajax_check(a);
        break;
      case 'password':
        if (a.value.length < 6) {
          return msg(a, "err");
        }
        return msg(a, "ok");
        break;
      case 'rstpassword':
        var pwd = $("#iCMS-reg-password").val();
        if (pwd.length < 6) {
          return msg(a, "perr");
        }
        if (pwd != a.value) {
          return msg(a, "err");
        }
        return msg(a, "ok");
        break;
      case 'seccode':
        ajax_check(a);
        break;
    }
  }

  function msg(e, c) {
    var info = {
      'err_username': '电子邮箱格式不正确！',
      'err_nickname': '昵称只能4~20位，每个中文字算2位字符。',
      'err_password': '密码太短啦，至少要6位哦',
      'err_rstpassword': '密码与确认密码不一致！',
      'perr_rstpassword': '请重复输入一次密码！',
      'err_ajax_username': '邮件地址已经注册过了,请直接登陆或者换个邮件再试试。',
      'err_ajax_nickname': '昵称已经被注册了,请换个再试试。',
      'err_ajax_seccode': '',

      'empty_username': '请填写电子邮箱！',
      'empty_nickname': '请填写昵称！',
      'empty_password': '请填写密码！',
      'empty_rstpassword': '请重复输入一次密码！',
      'empty_seccode': '请输入验证码！',
      'def_username': '请填写正确的常用邮箱，以便找回密码。<br />比如：example@example.com',
      'def_nickname': '支持中文，不能以数字开头，最多20个字符，中文算两个字符。',
      'def_password': '6-20个字母、数字或者符号',
      'def_rstpassword': '这里要重复输入一下你的密码',
      'def_seccode': '请输入图片中的字符!',
    }
    var n = e.name,b = $('#iCMS-reg-' + n);
    b.tooltip('destroy');
    if (c == "ok") {
      iCMS.tip(b, '<i class="fa fa-check-circle" style="color: #33B800;"></i>');
      $(e).data('check', true);
    } else if (c && c != "ok") {
      var info = info[c + '_' + n] || c;
      iCMS.tip(b, '<i class="fa fa-times-circle"></i> '+info);
      $(e).data('check', false);
    }
  }

  function ajax_check(a) {
    var val = $(a).data('value');
    if (typeof(val) === undefined || val == "" || val != a.value) {
      $(a).data('value', a.value);
      $.get(iCMS.api('user',"&do=check"), {
          name: a.name,
          value: a.value
        },
        function(c) {
          if (c.code) {
            //a.name = c.forward;
            msg(a, "ok");
            $(a).data("check", true);
          } else {
            msg(a, c.msg);
            $(a).data("check", false);
          }
        }, 'json');
    }
  }

})(jQuery);
