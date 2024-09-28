import axios from "axios";
const apiRequest = axios.create({
    baseURL: import.meta.env.VITE_BASE_URL_API,
    timeout: 8000,
    headers: {
        Accept: "application/json",
    },
    // withCredentials: true,
    // xsrfCookieName: "XSRF-TOKEN",
    // xsrfHeaderName: "X-XSRF-TOKEN",
});

export default apiRequest;
