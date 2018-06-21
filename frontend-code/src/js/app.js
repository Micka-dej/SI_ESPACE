import User from './Classes/User';
import axios from 'axios';

function confirmSubmit() {
  let username = document.getElementById('username').value;
  let password = document.getElementById('password').value;
  let newUser = new User(username, password);

  console.log(newUser);
}

document.addEventListener('DOMContentLoaded', function() {
  'use strict'; 

  document.getElementById('lol').addEventListener('click', confirmSubmit);
});