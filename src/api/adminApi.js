import api from './api'

export const getAdmins = async () => {
    const res = await api.get('/admin/roles');
    return res.data;
}

export const createAdmin = async (data) => {
    const res = await api.post('/admin/roles', data);
    return res.data;
};



export const deleteAdmin = async (id) => {
    const res = await api.post(`/admin/roles/${id}`, {
        _method: "DELETE"
    });

    return res.data;
};


