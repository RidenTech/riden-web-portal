import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Badge, Button, Table, SearchBar, Tabs, Pagination } from '@/components/UI';

export default function PayoutManagement() {
    const [section, setSection] = useState('upcoming');

    const drivers = [
        { name: 'Wade Warren', id: '#34567', rides: '45', amount: '$50.00', date: '22 March 2025', img: 'https://i.pravatar.cc/100?img=1', status: 'Paid' },
        { name: 'Jacob Jones', id: '#34568', rides: '45', amount: '$50.00', date: '22 March 2025', img: 'https://i.pravatar.cc/100?img=2', status: 'Pending' },
        { name: 'Bessie Cooper', id: '#34569', rides: '45', amount: '$50.00', date: '22 March 2025', img: 'https://i.pravatar.cc/100?img=3', status: 'Paid' },
    ];

    return (
        <AdminLayout title="Payments">
            {/* Header Actions */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                <SearchBar
                    placeholder="Search transactions..."
                    className="w-full lg:w-[400px]"
                />

                <div className="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <Button variant="pill" className="flex-1 lg:flex-none">
                        Instant Payout Requests(12)
                    </Button>
                    <div className="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#6B7280]">
                        <i className="bi bi-calendar3"></i>
                        <span>23/04/2025 - 23/04/2025</span>
                    </div>
                </div>
            </div>

            {/* Tabs */}
            <Tabs
                activeTab={section}
                onTabChange={setSection}
                options={[
                    { id: 'upcoming', label: 'Upcoming Payments' },
                    { id: 'previous', label: 'Previous Transactions' },
                    { id: 'instant', label: 'Instant Payouts' }
                ]}
            />

            {/* Table */}
            <Table headers={['Name', 'Unique ID', 'Total Rides', 'Total Amount', ...(section === 'previous' ? ['Payout Date'] : []), 'Action']} headerBg="bg-[#FFF1F2]">
                {drivers.map((d, i) => (
                    <tr key={i} className="hover:bg-black/[0.03] transition-colors border-b border-[#F3F4F6]">
                        <td className="py-[18px] px-[30px]">
                            <div className="flex items-center gap-3">
                                <div className="w-[44px] h-[44px] rounded-full border-2 border-white shadow-sm overflow-hidden">
                                    <img src={d.img} className="w-full h-full object-cover" />
                                </div>
                                <span className="text-[14px] font-[800] text-[#111]">{d.name}</span>
                            </div>
                        </td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#D10000]">{d.id}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111]">{d.rides}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111]">{d.amount}</td>
                        {section === 'previous' && (
                            <td className="py-[18px] px-[30px]">
                                <div className="flex items-center gap-3">
                                    <span className="text-[14px] font-[500] text-[#4B5563]">{d.date}</span>
                                    <Badge variant="active">Paid</Badge>
                                </div>
                            </td>
                        )}
                        <td className="py-[18px] px-[30px] text-right">
                            <div className="flex justify-end gap-3">
                                {section === 'instant' ? (
                                    <button className="px-6 py-2 bg-[#10B981] text-white text-[12px] font-[800] rounded-[10px] hover:bg-black transition-all shadow-md shadow-green-100 uppercase italic">Approve</button>
                                ) : section === 'previous' ? (
                                    <button className="w-10 h-10 rounded-xl bg-red-50 text-[#D10000] flex items-center justify-center hover:bg-[#D10000] hover:text-white transition-all"><i className="bi bi-file-earmark-pdf text-xl"></i></button>
                                ) : (
                                    <button className="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all"><i className="bi bi-eye-fill text-xl"></i></button>
                                )}
                            </div>
                        </td>
                    </tr>
                ))}
            </Table>

            <Pagination totalItems={payouts.length} />
        </AdminLayout>
    );
}
