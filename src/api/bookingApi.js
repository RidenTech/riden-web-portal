import api from './api';

export const getBookings = async (params) => {
    const res = await api.get('/admin/bookings', { params });
    return res.data;
};

export const getBookingDetail = async (id) => {
    const res = await api.get(`/admin/bookings/${id}`);
    return res.data;
};