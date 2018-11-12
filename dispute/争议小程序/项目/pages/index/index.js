// pages/index/index.js

var ip = "http://39.105.18.210"

//获取应用实例
const app = getApp()
Page({
  /**
   * 页面的初始数据
   */
  data: {
      ip:ip,
      parti:1,   //点击参与弹出的输入框
      layer:1,   //遮罩层
      grenade:1,  //手榴弹
      friend:1,   //帮好友
      focus:false,
      discuss_content:'',
      invite:1,    //邀请好友点赞
      him_like_it:1, //帮好友点赞
      openid:'',
      z_img:'z_img',    //赞
      replay:{},  //替换数据
      page:'1'
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {  //获取数据库活动表数据
    
     var _this = this
     var openid = 'oisX_0-varZRsNA8DEB7O9lQDOyA'
    //  getApp().globalData.openid

     wx.request({
        url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/index&openid='+openid,
        dataType:'json',
        data:{openid:openid},
        success:function(e){
          
          // if(getApp().globalData.openid == null || getApp().globalData.openid == undefined){
          //   for (var i in e.data.discuss) {
          //       e.data.discuss[i].z_img = _this.data.z_img
          //   }
          // }else{
          //   for (var i in e.data.discuss) {
          //       if (e.data.discuss[i].z_img != 'zg_img') {
          //            e.data.discuss[i].z_img = _this.data.z_img
          //       }
          //   }
          // }
          _this.setData({ activity: e.data})
          setInterval(_this.endtime,1000,0)
        }
     })

    if (options.id != undefined){
        this.setData({ him_like_it: 0 })
        wx.request({
          url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/him&id='+options.id,
          dataType: 'json',
          success: function(e) {
               _this.setData({invite_data: e.data})    //邀请点赞数据
           },
        })
     }
  },
  endtime: function () {
      var _time = this.data.activity.activity.end_time

      _time--;

      var day = parseInt(_time / (60 * 60 * 24))

      var hour = parseInt((_time % (60 * 60 * 24)) / (60 * 60))

      var minute = parseInt((_time % (60 * 60)) / 60)

      var secend = parseInt(_time % 60)

      if (_time < 0) {
          this.setData({ title: '活动结束' })
          return
      }
        
      this.setData({ 'activity.activity.end_time': _time })
      var title = '活动剩余时间:' + day + '天' + hour + '小时' + minute + '分' + secend + '秒'
      this.setData({ title: title })
  },
  Help_him:function(event){      //帮好友点赞

     var Help_him = event.currentTarget.dataset.id
     var _this = this
      
     wx.request({
      url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/hm',
      data: { id:Help_him},
      dataType: 'json',
      success: function (e) {
        _this.setData({ 'invite_data.laud': e.data.laud, layer: 0, grenade: 0, friend: 0 })
      }
    })

  },
  discuss: function (event) {   //进入评论页

    // if(!this.affirmLog()){
    //    return
    // }
         
     wx.navigateTo({
       url: '/pages/discuss/discuss?id='+event.target.id,
    })
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {              

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {
  
  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {
    var page = this.data.page
    var _this = this
    page++
    this.setData({ page: page })

    wx: wx.request({
      url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/index',
      data: { page: page, flag: 2 },
      dataType: 'json',
      success: function (res) {

        if (res.data == '到底啦！！') {
          wx.showToast({
            title: res.data,
            icon: 'success',
            mask: true
          })
          return
        }

        for (var i in res.data) {
          var len = _this.data.activity.discuss.length
          var index = "activity.discuss[" + len + "]"

          _this.setData({ [index]: res.data[i] })
        }
      },
    })
  },
  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function (e) {
    return {
       path: '/pages/index/index?id='+e.target.dataset.id
    }
    // console.log(e)
  },
  user:function(e){
    var userInfo = new Array()
    var _this = this
    // console.log(e)
    var openid = getApp().globalData.openid

    wx.checkSession({
      success(res) {
         wx.navigateTo({
              url: '../mine/mine',
         })
      },
      fail(info) {
        wx.login({
              success(ress){
                 wx.request({
                   url: 'https://api.weixin.qq.com/sns/jscode2session?appid=wxdb1ec17a0cb1a225&secret=3db64dd906665095f03235cb335c9d32&js_code='+ress.code+'&grant_type=authorization_code',
                     success(impMsg){

                       userInfo['nickname'] = e.detail.userInfo.nickName
                       userInfo['openid'] = impMsg.data.openid
                       userInfo['head_img'] = e.detail.userInfo.avatarUrl

                      // console.log(ress)
                      // console.log(e)
                      // console.log(impMsg)

                      //  console.log(e.detail.userInfo.avatarUrl)
                      // return 

                       wx: wx.request({
                            url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/inuser',
                            data: userInfo,
                            success: function (into) {

                              wx.navigateTo({
                                 url: '../index/index',
                              })

                              wx.showToast({
                                title: '登录成功',
                                icon: 'success',
                                duration: 3000,
                                mask: true
                              })

                              // console.log(_this.data.discuss)

                              app.globalData.openid = impMsg.data.openid
                            },
                          })
                     }
                 })
              }
          })
      }
    })
  },
  rule:function(){
    wx.navigateTo({
      url: '../rule/rule',
    })
  },
  partDiscuss:function(e){                //参与讨论获取用户信息入库
    
    var _this = this

    // if(!this.affirmLog()){
    //    return 
    // }

    this.setData({'parti':0})
    this.setData({'layer': 0 })
    this.setData({'focus': true})
  },
  affirmLog:function(){

    var openid = getApp().globalData.openid

    if (openid == null) {
      wx.showToast({
        title: '请先登录',
        icon: 'loading',
        mask: true
      })
      return false
    }else{
      return true
    }
  },
  ltsGo:function(){     //帮好友点赞参与讨论
     this.setData({ layer:1, grenade:1, friend: 1})
     this.partDiscuss()
  },
  close:function(){    //关闭手榴弹
     this.setData({ layer:1, grenade:1, friend:1 })
  },
  nb:function(e){      //牛逼 垃圾 点赞

    var _this = this
    
    wx.request({
      url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/laud',
      data: { id:e.currentTarget.id,flag:e.currentTarget.dataset.flag},
      dataType: 'json',
      success: function (e) {
        _this.setData({'activity.activity.laudPer': e.data.laudPer})
        _this.setData({'activity.activity.stampPer': e.data.stampPer })
        // console.log(_this)
      }
    })

    // wx.createSelectorQuery().selectAll('.laud').boundingClientRect(function (rects) {
    //   rects.forEach(function (rect) {
 
    //      console.log(rect)   // 节点的dataset
    //   })
    // }).exec()
  },

  discussLaud: function (event) {     //首页评论点赞

    var _this = this
    var index = event.currentTarget.dataset.index
    var str = "activity.discuss["+index+"].laud"
    var zg =  "activity.discuss["+index+"].z_img"

    // if(!this.affirmLog()){
    //    return 
    // }

    // console.log(this.data.activity.discuss[index].laud)
    // return 
    var openid = 'oisX_0-varZRsNA8DEB7O9lQDOyA'
    // getApp().globalData.openid

    wx.request({
      url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/dislaud',
      data: { discuss_id: event.currentTarget.dataset.id , openid : openid },
      dataType: 'json',
      success: function (e) {
         if(e.data == 'Ok'){
           return 
         }else{
            _this.setData({ [str]: e.data.laud })
            _this.setData({ [zg]: 'zg_img' })           //替换赞的图片
         }
        //  console.log(_this)
      }
    })
  },
  discuss_content:function(e){    //用户输入的评论
    this.setData({'discuss_content':e.detail.value})
    // console.log(this.data.discuss_content)
  },
  sendMsg:function(){

    this.setData({'parti':1})
    this.setData({'layer': 1 })
    var _this = this
    var arr = new Array()

    arr['openid'] = 32
    arr['discuss_content'] = this.data.discuss_content
    arr['activity_id'] = this.data.activity.activity.activity_id

    wx:wx.request({
      url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/addd',
      data:arr,
      success: function(e) {
         _this.setData({invite:0})
         _this.setData({invite_data: e.data,him_like_it: 1})    //邀请点赞数据
      }
    })
  }
})