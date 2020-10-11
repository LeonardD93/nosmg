export default {
  app: null,
  token: localStorage.getItem('token'),
  //user: null,
  data:null,

  init(app) {
    this.app = app
    //this.refreshUser()
    this.refreshData()
  },

  // refreshUser() {
  //   if (!this.token) {
  //     this.user = null
  //   } else {
  //     this.app.$http('users/me').then(res => {
  //        this.user = res.data
  //      })
  //   }
  // },
  refreshData(){
    if (!this.token) {
      // cancello i dati in locale
    } else {
      this.app.$http('data').then(res => {
        console.log(res.data)
         this.data = res.data
       })
     }
  },

  setToken(token) {
    if (!token) {
      this.logout()
    } else {
      this.token = token
      localStorage.setItem('token', token)
      console.log('token setato')
      this.refreshData()
    }
  },

  logout() {
    var params = {token: this.token}
    this.app.$http.post('token/destroy', params).then(res => {
      console.log(res)
    })
  //this.user = null
    this.data=null
    this.token = null
    localStorage.removeItem('token')
  },

  clone(obj) {
    return JSON.parse(JSON.stringify(obj))
  },
}
