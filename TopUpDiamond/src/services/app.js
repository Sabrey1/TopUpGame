import axios from "axios";

// ✅ Create axios instance
const api = axios.create({
  baseURL: "http://localhost:8000/api/", // your API base
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

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
