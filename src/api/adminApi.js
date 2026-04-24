import api from './api'

export const getAdmins = async () => {
    const res = await api.get('/admin/roles');
    return res.data;
}

export const createAdmin = async (data) => {
    const res = await api.post('/admin/roles', data);
    return res.data;
};



export const getAdminById = async (id) => {
    const res = await api.get(`/admin/roles/${id}`);
    return res.data;
};

export const updateAdmin = async (id, data) => {
    const res = await api.post(`/admin/roles/${id}`, {
        ...data,
        _method: 'PUT'
    });
    return res.data;
};

export const deleteAdmin = async (id) => {
    const res = await api.post(`/admin/roles/${id}`, {
        _method: "DELETE"
    });

    return res.data;
};


