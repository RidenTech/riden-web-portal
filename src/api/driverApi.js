import api from './api';

/**
 * Fetch all drivers with optional pagination and filters
 */
export const getDrivers = async (params = {}) => {
    const res = await api.get('/admin/drivers', { params });
    return res.data;
};

/**
 * Fetch a single driver's details by ID
 */
export const getDriverById = async (id) => {
    // Reverting to search approach as the direct show route was failing with numeric IDs
    // and the backend search on the index route effectively finds the driver by unique_id.
    const res = await api.get('/admin/drivers', {
        params: { search: id }
    });

    // Extract deep nested data: res.data.data.data (standard Laravel paginated structure)
    const list = res.data?.data?.data || res.data?.data || [];
    return { data: list[0] || null };
};

/**
 * Create a new driver (handles FormData for avatar/files)
 */
export const createDriver = async (data) => {
    // If data is not FormData, it will be sent as JSON by default headers
    const res = await api.post('/admin/drivers', data, {
        headers: data instanceof FormData ? { 'Content-Type': 'multipart/form-data' } : {}
    });
    return res.data;
};

/**
 * Update a driver's details
 */
export const updateDriver = async (id, data) => {
    // Using PATCH as per backend routes
    // For FormData with PATCH in Laravel, we often use POST with _method=PATCH
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
