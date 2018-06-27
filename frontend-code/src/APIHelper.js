import axios from "axios";

const config = {
  baseURL: "http://localhost:12001/api",
  withCredentials: true,
  crossDomain: true,
  contentType: false,
  responseType: "json",
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json"
  }
};

const api = axios.create(config);

export default api;
