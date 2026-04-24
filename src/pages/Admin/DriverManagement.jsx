import React, { useState, useEffect } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, Button, SearchBar, Tabs, DateRangePicker, DatePickerStyles, Pagination, useToast } from '@/components/UI';
import { useNavigate } from 'react-router-dom';
import { startOfWeek } from 'date-fns';
import { getDrivers } from '../../api/driverApi';
import { STORAGE_URL } from '@/api/api';

export default function DriverManagement() {
    const navigate = useNavigate();
    const { showToast } = useToast();
    const [activeTab, setActiveTab] = useState('active');
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());
    const [exportOpen, setExportOpen] = useState(false);

    // API States
    const [drivers, setDrivers] = useState([]);
    const [loading, setLoading] = useState(true);
    const [searchTerm, setSearchTerm] = useState('');
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [totalItems, setTotalItems] = useState(0);

    const fetchDrivers = async () => {
        try {
            setLoading(true);
            const params = {
                page: currentPage,
                search: searchTerm,
                // Status mapping: if tab is 'active', show Active. If 'requested', show Pending.
                status: activeTab === 'active' ? 'Active' : 'Pending'
            };
            const response = await getDrivers(params);

            // Laravel paginated structure: response.data.data
            let driversData = response.data?.data || response.data || [];

            // Apply local filtering to ensure tab consistency 
            if (activeTab === 'active') {
                driversData = driversData.filter(d => d.status?.toLowerCase() === 'active');
            } else {
                driversData = driversData.filter(d => d.status?.toLowerCase() !== 'active');
            }

            setDrivers(driversData);

            // Pagination info
            setTotalPages(response.data?.last_page || 1);
            setTotalItems(response.data?.total || driversData.length);
        } catch (error) {
            console.error("Error fetching drivers:", error);
            showToast("Failed to load drivers", "error");
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        fetchDrivers();
    }, [currentPage, searchTerm, activeTab]);

    return (
        <AdminLayout title="Driver Management">
            <DatePickerStyles />
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-4">
                <SearchBar
                    placeholder="Search by name, email, phone number"
                    className="w-full lg:w-[360px]"
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                />

                <div className="flex items-center gap-1 w-full lg:w-auto">
                    <Button variant="pill" className="flex-1 lg:flex-none" onClick={() => navigate('/drivers/create')}>
                        <i className="bi bi-person-plus-fill"></i> Add Driver
                    </Button>

                    <DateRangePicker
                        startDate={startDate}
                        endDate={endDate}
                        onStartDateChange={setStartDate}
                        onEndDateChange={setEndDate}

                    />
                    <div className="relative">
                        <button
                            onClick={() => setExportOpen(!exportOpen)}
                            className="flex rounded-full items-center gap-1 px-6 py-3 bg-white border border-[#E5E7EB] text-[13px] font-[700] text-[#111] hover:bg-gray-50 transition-all"
                        >
                            <i className="bi bi-file-earmark-excel-fill text-[#1D7E4D]"></i> Export
                            <i className={`bi bi-chevron-down text-[#1D7E4D] text-sm transition-all ${exportOpen ? 'rotate-180' : ''}`}></i>
                        </button>
                        {exportOpen && (
                            <div className="absolute right-0 mt-2 w-44 bg-white border border-[#E5E7EB] rounded-2xl shadow-lg overflow-hidden py-1 z-10">
                                <button
                                    className="w-full text-left px-4 py-2 hover:bg-gray-50 text-[13px] font-[600] text-[#111] border-b border-[#F3F4F6] transition-colors"
                                    onClick={() => setExportOpen(false)}
                                >
                                    <i className="bi bi-filetype-csv mr-2 text-[#1D7E4D]"></i> CSV Format
                                </button>
                                <button
                                    className="w-full text-left px-4 py-2 hover:bg-gray-50 text-[13px] font-[600] text-[#111] transition-colors"
                                    onClick={() => setExportOpen(false)}
                                >
                                    <i className="bi bi-filetype-pdf mr-2 text-[#E72929]"></i> PDF Format
                                </button>
                                <button
                                    className="w-full text-left px-4 py-2 hover:bg-gray-50 text-[13px] font-[600] text-[#111] transition-colors border-t border-[#F3F4F6]"
                                    onClick={() => setExportOpen(false)}
                                >
                                    <i className="bi bi-file-earmark-excel-fill mr-2 text-[#1D7E4D]"></i> Excel Format
                                </button>
                            </div>
                        )}
                    </div>
                </div>
            </div>

            {/* Tabs */}
            <Tabs
                activeTab={activeTab}
                onTabChange={setActiveTab}
                options={[
                    { id: 'active', label: 'Active Drivers' },
                    { id: 'requested', label: 'Requested' }
                ]}
            />

            {/* Table */}
            <Table headers={['Name', 'Unique ID', 'Phone Number', 'Status']}>
                {loading ? (
                    <tr><td colSpan="4" className="text-center py-10"><div className="animate-spin inline-block w-6 h-6 border-2 border-red-600 rounded-full border-t-transparent"></div></td></tr>
                ) : drivers.length === 0 ? (
                    <tr><td colSpan="4" className="text-center py-10 text-gray-500 font-medium">No drivers found</td></tr>
                ) : (
                    drivers.map((d) => (
                        <tr
                            key={d.id}
                            onClick={() => navigate(`/drivers/detail/${encodeURIComponent(d.unique_id)}`)}
                            className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]"
                        >
                            <td className="py-[18px] px-[30px]">
                                <div className="flex items-center gap-3">
                                    <div className="w-[44px] h-[44px] rounded-full overflow-hidden border-2 border-white shadow-sm bg-gray-100">
                                        <img
                                            src={d.avatar ? `${STORAGE_URL}/${d.avatar}` : `https://ui-avatars.com/api/?name=${d.first_name}+${d.last_name}&background=random`}
                                            className="w-full h-full object-cover"
                                            alt=""
                                        />
                                    </div>
                                    <span className="font-[700] text-[#111]">{d.first_name} {d.last_name}</span>
                                </div>
                            </td>
                            <td className="py-[18px] px-[30px] text-[#6B7280] font-[700] italic tracking-tight">{d.unique_id}</td>
                            <td className="py-[18px] px-[30px] text-[#111] font-[700]">{d.phone}</td>
                            <td className="py-[18px] px-[30px]">
                                <Badge variant={d.status?.toLowerCase() === 'active' ? 'active' : d.status?.toLowerCase()}>{d.status}</Badge>
                            </td>
                        </tr>
                    ))
                )}
            </Table>
            <Pagination
                totalItems={totalItems}
                currentPage={currentPage}
                onPageChange={setCurrentPage}
            />
        </AdminLayout>
    );
}
