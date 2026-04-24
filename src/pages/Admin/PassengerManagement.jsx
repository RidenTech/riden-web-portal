import React, { useState, useEffect } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, Button, SearchBar, DateRangePicker, DatePickerStyles, Pagination, useToast } from '@/components/UI';
import { startOfWeek } from 'date-fns';
import { getPassengers } from '@/api/passengerApi';

export default function PassengerManagement() {
    const [passengers, setPassengers] = useState([]);
    const [loading, setLoading] = useState(false);
    const [searchTerm, setSearchTerm] = useState('');
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());
    const [exportOpen, setExportOpen] = useState(false);
    const { showToast } = useToast();
    const [totalItems, setTotalItems] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const navigate = useNavigate();

    const fetchPassengers = async () => {
        try {
            setLoading(true);
            const params = {
                page: currentPage,
                search: searchTerm,
            };
            const response = await getPassengers(params);

            // Extracting from { status: "success", data: { data: [...], total: 7, ... } }
            const apiData = response.data || {};
            const list = apiData.data || (Array.isArray(response.data) ? response.data : []);

            setPassengers(list);
            setTotalItems(apiData.total || list.length);
        }
        catch (error) {
            console.error("Error fetching passengers:", error);
            showToast(error.response?.data?.message || error.message, 'error');
        }
        finally {
            setLoading(false);
        }
    }

    useEffect(() => {
        fetchPassengers();
    }, [currentPage, searchTerm]);

    return (
        <AdminLayout title="Passenger Management">
            <DatePickerStyles />
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
                <SearchBar
                    placeholder="Search by name, email, phone number"
                    className="w-full lg:w-[330px]"
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                />

                <div className="flex flex-wrap items-center gap-1 w-full lg:w-auto">
                    <Button variant="pill" className="flex-1 lg:flex-none" onClick={() => navigate('/passenger/create')}>
                        <i className="bi bi-person-plus-fill"></i> Add Passenger
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
                            className="flex rounded-full items-center gap-1 px-4 py-3 bg-white border border-[#E5E7EB] text-[13px] font-[700] text-[#111] hover:bg-gray-50 transition-all"
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

            {/* Table */}
            <Table headers={['Name', 'Unique ID', 'Phone Number', 'Joined', 'Status']}>
                {loading ? (
                    <tr>
                        <td colSpan="5" className="text-center py-10">
                            <div className="animate-spin inline-block w-6 h-6 border-2 border-red-600 rounded-full border-t-transparent"></div>
                        </td>
                    </tr>
                ) : passengers.length === 0 ? (
                    <tr>
                        <td colSpan="5" className="text-center py-10 text-gray-500">
                            No passengers found
                        </td>
                    </tr>
                ) : (
                    passengers.map((p) => (
                        <tr
                            key={p.id}
                            onClick={() => navigate(`/passenger/detail/${encodeURIComponent(p.unique_id || p.id)}`)}
                            className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]"
                        >
                            <td className="py-[18px] px-[30px]">
                                <div className="flex items-center gap-3">
                                    <div className="w-[44px] h-[44px] rounded-full overflow-hidden border-2 border-white shadow-sm">
                                        <img
                                            src={
                                                p.avatar
                                                    ? `${import.meta.env.VITE_STORAGE_URL}/${p.avatar}`
                                                    : `https://ui-avatars.com/api/?name=${p.first_name}+${p.last_name}`
                                            }
                                            className="w-full h-full object-cover"
                                            alt=""
                                        />   </div>
                                    <span className="font-[700] text-[#111]">{p.first_name + " " + p.last_name}</span>
                                </div>
                            </td>
                            <td className="py-[18px] px-[30px] text-[#6B7280] font-[700] italic tracking-tight">{p.unique_id}</td>
                            <td className="py-[18px] px-[30px] text-[#111] font-[700]">{p.phone}</td>
                            <td className="py-[18px] px-[30px] text-[#6B7280] font-[700]">{p.created_at?.slice(0, 10)}</td>
                            <td className="py-[18px] px-[30px]">
                                <Badge variant={p.status}>{p.status}</Badge>
                            </td>
                        </tr>
                    ))
                )}
            </Table>
            <Pagination totalItems={totalItems}
                currentPage={currentPage}
                onPageChange={(page) => setCurrentPage(page)}
            />
        </AdminLayout>
    );
}
