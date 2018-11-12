// pages/discuss/discuss.js
var ip = 'http://39.105.18.210'

Page({

  /**
   * 页面的初始数据
   */
  data: {
     ip:ip,
     put:1,  //输入评论框
     send:1,  //发送评论
     layer:1,  //遮罩层
     senMes:'',  //要发送的内容
     arr:{},   //要发送的数组
     rid:''
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var _this = this
  
    this.setData({rid:options.id})    //赋值首页评论数据的ID将来要用

    // var openid = getApp().globalData.openid
    var openid = 'oisX_0-varZRsNA8DEB7O9lQDOyA'

    // console.log(options.id)
    // return

    wx.request({
      url:'http://39.105.18.210/composer/basic/web/index.php?r=applets/discuss',
      data: { discuss_id: options.id,openid:openid},
      dataType:'json',
      success: function(res) {

        for(var i in res.data.reply){
          if (res.data.reply[i].z_img != 'zg_img'){
               res.data.reply[i].z_img = 'rimg'
           }
        }
        // console.log(res.data)
        // return
        _this.setData({data:res.data})
        _this.setData({reply:res.data.reply})
      },
    })

  },
  ClickDis:function(e){          //点击出现输入框 发送按钮 遮罩层

     this.setData({put:0,send:0,layer:0})

     if (e.currentTarget.dataset.bopenid != undefined){
        this.data.arr['b_openid'] = e.currentTarget.dataset.bopenid

        this.data.arr['discuss_id'] = e.currentTarget.dataset.disid
     }
     else{
        this.data.arr['b_openid'] = e.currentTarget.dataset.b_openid
        this.data.arr['discuss_id'] = e.currentTarget.dataset.disid
     }
  },
  sendMes:function(){   //点击发送按钮

    this.setData({ put: 1, send: 1, layer:1})

    var _this = this
    var len = this.data.reply.length
    var index = "reply["+len+"]"

    var mount = this.data.data.discuss.mount    //回复数加一
    mount++

    this.data.arr['reply_content'] = this.data.sendMes
    this.data.arr['openid'] = 'oisX_0-varZRsNA8DEB7O9lQDOyA'
    // getApp().globalData.openid

    // console.log(this.data.arr)
    // return
    
     wx.request({
       url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/inr',
       data:this.data.arr,
       dataType:'json',
       success(e){
          _this.setData({[index]:e.data})
          _this.setData({'data.discuss.mount':mount})
          _this.setData({'arr':{}})
          // console.log(e)
        }
     })

  },

  getMes:function(e){    //失去焦点获取文本框的值
     var sendMes = e.detail.value
     this.setData({sendMes:sendMes})
  },
  intoDis:function(e){      //回复点赞

     var index = e.currentTarget.dataset.index
     var nate = e.currentTarget.dataset.nate      //数组的下标
     var str = "reply["+nate+"].laud"
     var zg_img = "reply["+nate+"].z_img"
     var _this = this
     var arr = new Array()
     var openid = 'oisX_0-varZRsNA8DEB7O9lQDOyA'

    //  console.log(nate)
    // return

    //  if(nate == undefined){
    //        arr['discuss_id'] = index
    //        arr['flag'] = 1 
    //        wx:wx.request({
    //             url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/ur',
    //             data:arr,
    //             dataType: 'json',
    //             success: function(res) {
    //               _this.setData({'data.discuss.laud':res.data.laud})
    //               // console.log(_this)
    //             }
    //         })   
    //         return
    //  }

     wx:wx.request({
       url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/ur',
       data:{reply_id:index,openid:openid},
       dataType: 'json',
       success: function(res) {
           if(res.data == 'Ok'){
              return
           }
          _this.setData({[str]:res.data.laud})
          _this.setData({[zg_img]:'zg_img'})
          // console.log(res)
       }
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

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
  },
})