import api from './api';

export const getPassengers = async (params) => {
    const res = await api.get('/admin/passengers', { params });
    return res.data;
}

export const createPassenger = async (data) => {
    const res = await api.post('/admin/passengers', data, {
        headers: { 'Content-Type': 'multipart/form-data' }
    });
    return res.data;
}

export const getPassengerById = async (id) => {
    const safeId = encodeURIComponent(id);
    const res = await api.get(`/admin/passengers/${safeId}`);
    return res.data;
}