import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Table, Badge, SearchBar, Tabs, DateRangePicker, DatePickerStyles } from '@/components/UI';
import { useNavigate } from 'react-router-dom';
import { startOfWeek } from 'date-fns';

export default function BookingManagement() {
    const navigate = useNavigate();
    const [type, setType] = useState('ongoing');
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());
    const [exportOpen, setExportOpen] = useState(false);

    const ongoingBookings = [
        { id: '#34567', driver: 'Theresa Webb', passenger: 'Wade Warren', fare: '$45.00', status: 'online' },
        { id: '#34568', driver: 'Ralph Edwards', passenger: 'Wade Warren', fare: '$45.00', status: 'online' },
    ];

    const previousBookings = [
        { id: '#34572', driver: 'Wade Warren', passenger: 'Theresa Webb', fare: '$45.00', status: 'success' },
        { id: '#34573', driver: 'Jacob Jones', passenger: 'Ralph Edwards', fare: '$45.00', status: 'danger' },
    ];

    const bookings = type === 'ongoing' ? ongoingBookings : previousBookings;

    return (
        <AdminLayout title="Booking Management">
            <DatePickerStyles />
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-4">
                <SearchBar
                    placeholder="Search by ID, passenger or driver"
                    className="w-full lg:w-[360px]"
                />

                <div className="flex items-center gap-1 w-full lg:w-auto">
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
                activeTab={type}
                onTabChange={setType}
                options={[
                    { id: 'ongoing', label: 'Ongoing Bookings' },
                    { id: 'previous', label: 'Previous Bookings' }
                ]}
            />

            {/* Table */}
            <Table headers={['Booking ID', 'Driver', 'Passenger', 'Fare', 'Status']}>
                {bookings.map((booking) => (
                    <tr
                        key={booking.id}
                        onClick={() => navigate('/bookings/detail', { state: { bookingStatus: booking.status } })}
                        className="cursor-pointer hover:bg-black/[0.02] transition-colors border-b border-[#F3F4F6]"
                    >
                        <td className="py-[18px] px-[30px]">
                            <span className="text-[13px] font-[800] text-[#D10000] bg-red-50 px-3 py-1.5 rounded-[10px] italic tracking-tight">
                                {booking.id}
                            </span>
                        </td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#111]">
                            <div className="flex items-center gap-3">
                                <span className="font-[700] text-[#111]">{booking.driver}</span>
                            </div>
                        </td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[700] text-[#111]">
                            <div className="flex items-center gap-3">
                                <span className="font-[700] text-[#111]">{booking.passenger}</span>
                            </div>
                        </td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#D10000]">{booking.fare}</td>
                        <td className="py-[18px] px-[30px]">
                            <Badge variant={booking.status}>{booking.status === 'online' ? 'Ongoing' : booking.status === 'danger' ? 'Cancelled' : 'Completed'}</Badge>
                        </td>
                    </tr>
                ))}
            </Table>
        </AdminLayout>
    );
}
