import * as types from "@/store/types";

export default {
  data() {
    return {
      descTitle: $t("稳顺直播##分享页面的主题title", __FILE__),
      phoneUrl: ''
    };
  },
  created() {
    this.phoneUrl = this.baseConfig.phoneUrl;
  },
  methods: {
    postToXinLang(a, phoneUrl) { //分享到新浪  a为分享的文字
      window.open("http://v.t.sina.com.cn/share/share.php?title=" + encodeURIComponent(a) + "&url=" + encodeURIComponent(phoneUrl) + "&rcontent=", "_blank", "scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes")
    },

    postToQzone(a, phoneUrl) { //分享QQ空间
      var b = encodeURI(a),
        c = encodeURI(a),
        d = encodeURI(phoneUrl);
      return window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?title=" + b + "&url=" + d + "&summary=" + c), !1
    },

    postToWb(a, phoneUrl) { //分享到微博
      var b = encodeURI(a), //标题
        c = encodeURI(phoneUrl), //url
        d = encodeURI("appkey"),
        e = encodeURI(""),
        f = "",
        g = "http://v.t.qq.com/share/share.php?title=" + b + "&url=" + c + "&appkey=" + d + "&site=" + f + "&pic=" + e;
      window.open(g, "转播到腾讯微博", "width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no")
    },

    postToQQ(a, phoneUrl) { //分享到QQ
      var p = {
        url: phoneUrl,
        /*获取URL，可加上来自分享到QQ标识，方便统计*/
        desc: '',
        /*分享理由(风格应模拟用户对话),支持多分享语随机展现（使用|分隔）*/
        title: a,
        /*分享标题(可选)*/
        summary: '',
        /*分享摘要(可选)*/
        pics: '',
        /*分享图片(可选)*/
        flash: '',
        /*视频地址(可选)*/
        site: '',
        /*分享来源(可选) 如：QQ分享*/
        style: '201',
        width: 32,
        height: 32
      };

      var s = [];
      for (var i in p) {
        s.push(i + '=' + encodeURIComponent(p[i] || ''));
      }
      s.join('&');

      var urlTo = 'http://connect.qq.com/widget/shareqq/index.html?' + s.join('&');
      window.open(urlTo, "分享到QQ", "width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no")
    },
  }
}