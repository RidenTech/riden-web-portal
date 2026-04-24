import api from './api';

export const getVehicles = async (params) => {
    const res = await api.get('/admin/vehicles', { params });
    return res.data;
};

export const getVehicleDetail = async (id) => {
    const res = await api.get(`/admin/vehicles/${id}`);
    return res.data;
};

export const createVehicle = async (data) => {
    const res = await api.post('/admin/vehicles', data);
    return res.data;
};