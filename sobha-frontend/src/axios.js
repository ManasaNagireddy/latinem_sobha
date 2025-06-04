// src/axios.js
import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api/', // API base URL
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
    // Add other headers if needed
  }
});

// Optional: Add request interceptor
axiosInstance.interceptors.request.use(config => {
  // e.g. attach auth token if available
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, error => Promise.reject(error));

// Optional: Add response interceptor
axiosInstance.interceptors.response.use(response => response, error => {
  // Handle errors globally, e.g. redirect to login on 401
  if (error.response && error.response.status === 401) {
    // do something, like logout
  }
  return Promise.reject(error);
});

export default axiosInstance;
