// pages/index/index.js

var ip = 'http://39.105.101.0'

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
      discuss_content:''
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {  //获取数据库活动表数据
    
     var _this = this

     wx.request({
        url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/index',
        dataType:'json',
        success:function(e){
          _this.setData({ activity: e.data})
          setInterval(_this.endtime,1000)
        }
     })

  },

  endtime: function (){

     var _time = this.data.activity.activity.end_time

     _time --;

     var day = parseInt(_time/(60*60*24))

     var hour = parseInt( (_time % (60*60*24)) / (60*60))

     var minute =parseInt((_time% (60*60)) / 60)

     var secend = parseInt(_time % 60)

     this.setData({'activity.activity.end_time':_time})

     var title = '活动剩余时间:'+day+'天'+hour+'小时'+minute+'分'+secend+'秒'
   
     this.setData({title:title})
  },

  discuss: function (event) {   //进入评论页
         
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

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  },
  user:function(){
    wx.navigateTo({
      url: '../mine/mine',
    })
  },
  rule:function(){
    wx.navigateTo({
      url: '../rule/rule',
    })
  },

  partDiscuss:function(){                //参与讨论获取用户信息入库

    wx.getSetting({
       success(res){
         console.log(res)
       }
    })


    this.setData({'parti':0})
    this.setData({'layer': 0 })
    this.setData({'focus': true})
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

    // console.log(this.data.activity.activity.laud)

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

    wx.request({
      url: 'http://39.105.18.210/composer/basic/web/index.php?r=applets/dislaud',
      data: { discuss_id: event.currentTarget.dataset.id },
      dataType: 'json',
      success: function (e) {
         _this.setData({[str]:e.data.laud})
      }
    })

   // console.log(this.data.activity.discuss[index])

  },
  discuss_content:function(e){
    this.setData({'discuss_content':e.detail.value})
  },
  sendMsg:function(){
    this.setData({'parti':1})
    this.setData({'layer': 1 })
  }
})