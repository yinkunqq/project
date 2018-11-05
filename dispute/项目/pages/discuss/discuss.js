// pages/discuss/discuss.js
  
var ip = 'http://39.105.101.0'
Page({

  /**
   * 页面的初始数据
   */
  data: {
     ip:ip
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    var _this = this

    wx:wx.request({
      url:'http://39.105.18.210/composer/basic/web/index.php?r=applets/discuss',
      data: { discuss_id: options.id},
      dataType:'json',
      success: function(res) {
        _this.setData({data:res.data})
      },
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