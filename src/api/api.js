import axios from 'axios';

const API_URL = import.meta.env.VITE_API_URL;
export const STORAGE_URL = import.meta.env.VITE_STORAGE_URL || API_URL.replace('/api', '/storage');

const api = axios.create({
    baseURL: API_URL,
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
    },
});

// ✅ REQUEST INTERCEPTOR (ONLY AUTH SOURCE)
api.interceptors.request.use((config) => {
    const token = localStorage.getItem("token");

    if (token && token !== "undefined" && token !== "null") {
        config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
});

// ✅ RESPONSE DEBUG (GOOD FOR DEV)
api.interceptors.response.use(
    (res) => {
        console.log("✅ API:", res.config.url);
        return res;
    },
    (error) => {
        console.log("❌ API ERROR:");
        console.log("URL:", error.config?.url);
        console.log("STATUS:", error.response?.status);
        console.log("DATA:", error.response?.data);
        return Promise.reject(error);
    }
);

export default api;