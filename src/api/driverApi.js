import api from './api';


export const getDrivers = async (params = {}) => {
    const res = await api.get('/admin/drivers', { params });
    return res.data;
};


export const getDriverById = async (id) => {
    // Loop through paginated search results to find the exact ID, avoiding 500 error on the direct endpoint 
    for (let page = 1; page <= 10; page++) {
        const res = await api.get('/admin/drivers', {
            params: { page }
        });
        const list = res.data?.data?.data || res.data?.data || [];
        const exactMatch = list.find(d => d.id == id);

        if (exactMatch) {
            return { data: exactMatch };
        }

        // Stop fetching if there's no next page
        const meta = res.data?.data || {};
        if (meta.current_page >= meta.last_page || !meta.next_page_url) {
            break;
        }
    }

    // If not found in all pages, return null
    return { data: null };
};


export const createDriver = async (data) => {
    const res = await api.post('/admin/drivers', data, {
        headers: data instanceof FormData ? { 'Content-Type': 'multipart/form-data' } : {}
    });
    return res.data;
};


export const updateDriver = async (id, data) => {
    if (data instanceof FormData) {
        data.append('_method', 'PATCH');
        const res = await api.post(`/admin/drivers/${id}`, data, {
            headers: { 'Content-Type': 'multipart/form-data' }
        });
        return res.data;
    }

    const res = await api.patch(`/admin/drivers/${id}`, data);
    return res.data;
};

/**
 * Toggle driver status (Active/Blocked etc.)
 */
export const toggleDriverStatus = async (id) => {
    const res = await api.patch(`/admin/drivers/${id}/status`);
    return res.data;
};

/**
 * Delete a driver
 */
export const deleteDriver = async (id) => {
    const res = await api.delete(`/admin/drivers/${id}`);
    return res.data;
};
