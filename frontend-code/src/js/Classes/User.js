export default class User {
  constructor(username, password) {
    this.username = username;
    this.password = password;
  }

  chibre() {
    console.log(this.username);
  }
}