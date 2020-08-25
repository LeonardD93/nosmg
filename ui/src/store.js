export default {
  app: null,
  token: localStorage.getItem('token'),
  user: null,
  data:null,

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
  refreshData(){
    if (!this.token) {
      console.log('qua')
      // cancello i dati in locale
    } else {
      this.app.$http('data').then(res => {
        console.log(res.data)
         this.data = res.data
       })
     }
  },
  setData(data){
    this.data = data
    localStorage.setItem('data', JSON.stringify(data)) // support only string rendere piu complesso e salvare in singole var in base alle classi
    console.log('dati setati');
  },

  setToken(token) {
    if (!token) {
      this.logout()
    } else {
      this.token = token
      localStorage.setItem('token', token)
      console.log('token setato')
      this.refreshUser()
    }
  },

  logout() {
    var params = {token: this.token}
    this.app.$http.post('token/destroy', params).then(res => {
      console.log(res)
    })
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
          console.log(res.data.value)
          this.setToken(res.data.value)
        })
      //}

  }


}
