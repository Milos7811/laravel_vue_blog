import axios from "axios";

const apiClient = axios.create({
    baseURL: "/api/posts",
    withCredentails: false,
    headers: {}
});
