export default {
  app: null,
  token: localStorage.getItem('token'),
  user: null,

  init(app) {
    this.app = app
    this.refreshUser()
  },

  refreshUser() {
    if (!this.token) {
      this.user = null
    } else {
      this.app.$http('users/me').then(res => {
         this.user = res.data
       })
    }
  },

  setToken(token) {
    if (!token) {
      this.logout()
    } else {
      this.token = token
      localStorage.setItem('token', token)
      this.refreshUser()
    }
  },

  logout() {
    this.user = null
    this.token = null
    localStorage.removeItem('token')
  },

  get_token(email, password){
    var params = {
        email: email,
        password: password,
      }
      //if(!this.token){
        this.app.$http.post('token', params).then(res => {
          console.log("token-> "+res.data.token)
          this.setToken(res.data.token)
        })
      //}

  }


}
