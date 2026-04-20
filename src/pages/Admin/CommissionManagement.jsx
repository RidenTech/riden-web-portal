import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Button, Badge, Table, SearchBar, Pagination } from '@/components/UI';

export default function CommissionManagement() {
    const transactions = [
        { date: '22 March 2025', id: '#34567', type: 'Standard', total: '$400.00', discount: '$0.00', percent: '20%', amount: '$80.00' },
        { date: '22 March 2025', id: '#34568', type: 'Premium', total: '$600.00', discount: '$0.00', percent: '25%', amount: '$150.00' },
        { date: '22 March 2025', id: '#34569', type: 'Standard', total: '$400.00', discount: '$0.00', percent: '20%', amount: '$80.00' },
        { date: '22 March 2025', id: '#34570', type: 'Van', total: '$800.00', discount: '$0.00', percent: '30%', amount: '$240.00' },
    ];

    return (
        <AdminLayout title="Commission Management">
            {/* Header Actions */}
            <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <SearchBar
                    placeholder="Search by ID or car type"
                    className="w-full md:w-80"
                />
                <div className="flex flex-wrap gap-4">
                    <Button className="px-8 uppercase italic tracking-wider font-bold">
                        <i className="bi bi-gear-fill mr-2"></i>
                        Set Commission
                    </Button>
                    <div className="flex items-center gap-3 px-5 py-[12px] bg-[#fdfdfd] border-[1.5px] border-[#E5E7EB] rounded-[14px] text-[14px] text-[#4B5563] font-[600] whitespace-nowrap shadow-sm">
                        <i className="bi bi-calendar3 text-[#D10000]"></i>
                        <span>23/04/2025 - 23/04/2025</span>
                    </div>
                </div>
            </div>

            {/* KPI Summary */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div className="bg-[#white] border border-[#D10000] p-8 rounded-[30px] flex justify-between items-center group relative overflow-hidden">
                    <div className="relative z-10">
                        <span className="text-[14px] font-[800] text-gray-400 block mb-2 uppercase tracking-wide">Total Rides</span>
                        <h2 className="text-[44px] font-[900] text-gray-900 leading-none tracking-tighter italic uppercase">1,024</h2>
                    </div>
                    <i className="bi bi-car-front-fill text-[100px] absolute -right-4 -bottom-4 text-[#D10000] opacity-[0.05] group-hover:scale-110 group-hover:-rotate-12 transition-all duration-500"></i>
                </div>
                <div className="bg-[#white] border border-[#D10000] p-8 rounded-[30px] flex justify-between items-center group relative overflow-hidden">
                    <div className="relative z-10">
                        <span className="text-[14px] font-[800] text-gray-400 block mb-2 uppercase tracking-wide">Total Commission</span>
                        <h2 className="text-[44px] font-[900] text-gray-900 leading-none tracking-tighter italic uppercase">$45k</h2>
                    </div>
                    <i className="bi bi-cash-stack text-[100px] absolute -right-4 -bottom-4 text-[#D10000] opacity-[0.05] group-hover:scale-110 group-hover:-rotate-12 transition-all duration-500"></i>
                </div>
            </div>

            {/* Table */}
            <Table headers={['Date & Time', 'Booking ID', 'Car Type', 'Total Amount', 'Discount', 'Commission %', 'Commission Amount']} headerBg="bg-[#FFF1F2]">
                {transactions.map((row, i) => (
                    <tr key={i} className="hover:bg-black/[0.03] transition-colors border-b border-[#F3F4F6]">
                        <td className="py-[18px] px-[30px] text-[14px] font-[500] text-[#4B5563]">{row.date}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#D10000]">{row.id}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111] uppercase italic tracking-tight">{row.type}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111]">{row.total}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[500] text-[#9CA3AF] font-mono">{row.discount}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#111]">{row.percent}</td>
                        <td className="py-[18px] px-[30px] text-[14px] font-[800] text-[#10B981]">{row.amount}</td>
                    </tr>
                ))}
            </Table>

            <Pagination totalItems={transactions.length} />
        </AdminLayout>
    );
}
