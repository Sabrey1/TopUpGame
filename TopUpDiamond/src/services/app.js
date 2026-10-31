import axios from "axios";

// ✅ Create axios instance
const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");

    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }

    return config;
  },
  (error) => Promise.reject(error)
);

// ✅ Global app object
const app = {
  // GET request
  getApi(url, params = {}) {
    return api.get(url, { params });
  },

  // POST request
  postApi(url, data = {}) {
    return api.post(url, data);
  },

  // PUT request
  putApi(url, data = {}) {
    return api.put(url, data);
  },

  // DELETE request
  deleteApi(url) {
    return api.delete(url);
  },
};

globalThis.app = app;

export default app;
