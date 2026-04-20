import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Badge, Button, SearchBar, Tabs, Pagination } from '@/components/UI';

export default function ReviewManagement() {
    const [tab, setTab] = useState('drivers');

    const reviews = {
        drivers: [
            { name: 'Floyd Miles', rating: '4.5', date: '22-02-2025 09:30pm', id: '#34565', by: 'Passenger Ronald Richards', img: 'https://i.pravatar.cc/100?img=12' },
            { name: 'Floyd Miles', rating: '4.5', date: '22-02-2025 09:30pm', id: '#34565', by: 'Passenger Ronald Richards', img: 'https://i.pravatar.cc/100?img=13' },
        ],
        passengers: [
            { name: 'Floyd Miles', rating: '4.5', date: '22-02-2025 09:30pm', id: '#34565', by: 'Driver Ronald Richards', img: 'https://i.pravatar.cc/100?img=14' },
        ]
    };

    const currentReviews = reviews[tab];

    return (
        <AdminLayout title="Reviews & Ratings">
            {/* Header Row */}
            <div className="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8">
                <SearchBar
                    placeholder="Search by passenger or driver name"
                    className="w-full lg:w-[400px]"
                />

                <div className="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <button className="flex items-center gap-2 px-6 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#111] hover:bg-gray-50 transition-all">
                        <i className="bi bi-file-earmark-excel-fill text-[#1D7E4D]"></i> Download
                    </button>
                    <div className="flex items-center gap-2 px-4 py-2.5 bg-white border border-[#E5E7EB] rounded-[14px] text-[13px] font-[700] text-[#6B7280]">
                        <i className="bi bi-calendar3"></i>
                        <span>23/04/2025 - 23/04/2025</span>
                    </div>
                </div>
            </div>

            <Tabs
                activeTab={tab}
                onTabChange={setTab}
                options={[
                    { id: 'drivers', label: 'Drivers Reviews' },
                    { id: 'passengers', label: 'Passengers Reviews' }
                ]}
            />

            {/* Stats Summary Card */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-8 p-10 bg-[#FDF2F2] border border-[#D10000]/10 rounded-[30px] mb-10 relative overflow-hidden">
                <div className="space-y-4">
                    <p className="text-[14px] font-[800] text-gray-500 uppercase tracking-widest">Total Reviews</p>
                    <h2 className="text-[54px] font-[900] text-gray-900 leading-none italic uppercase tracking-tighter">10.0K</h2>
                    <p className="text-[12px] font-[800] text-[#10B981] flex items-center gap-1"><i className="bi bi-graph-up-arrow"></i> +40% Growth rate this year</p>
                </div>
                <div className="space-y-4 md:border-l border-white/50 md:ps-10">
                    <p className="text-[14px] font-[800] text-gray-500 uppercase tracking-widest">Average Rating</p>
                    <div className="flex items-center gap-4">
                        <h2 className="text-[54px] font-[900] text-gray-900 leading-none italic">4.0</h2>
                        <div className="flex text-[#D10000] text-2xl gap-1">
                            <i className="bi bi-star-fill"></i>
                            <i className="bi bi-star-fill"></i>
                            <i className="bi bi-star-fill"></i>
                            <i className="bi bi-star-fill"></i>
                            <i className="bi bi-star text-white/50"></i>
                        </div>
                    </div>
                    <p className="text-[12px] text-gray-500 font-medium">Average rating this year</p>
                </div>
                <div className="space-y-3 md:border-l border-white/50 md:ps-10 flex flex-col justify-center">
                    {[5, 4, 3, 2, 1].map((s) => (
                        <div key={s} className="flex items-center gap-4">
                            <span className="text-[12px] font-[800] text-gray-400 w-10">{s} star</span>
                            <div className="flex-1 h-[6px] bg-white rounded-full overflow-hidden">
                                <div className="h-full bg-[#D10000] rounded-full" style={{ width: `${s * 15}%` }}></div>
                            </div>
                        </div>
                    ))}
                </div>
                <i className="bi bi-star-fill text-[150px] absolute -right-10 -bottom-10 text-[#D10000] opacity-[0.03]"></i>
            </div>

            {/* Reviews List */}
            <div className="space-y-6">
                {currentReviews.map((r, i) => (
                    <div key={i} className="p-8 bg-[#fdfdfd] border border-[#E5E7EB] rounded-[24px] hover:shadow-xl hover:shadow-red-50/20 transition-all duration-300 group">
                        <div className="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                            <div className="flex items-center gap-5">
                                <div className="w-16 h-16 rounded-full border-2 border-white shadow-md overflow-hidden ring-4 ring-riden-red/5">
                                    <img src={r.img} className="w-full h-full object-cover" />
                                </div>
                                <div>
                                    <h4 className="text-[18px] font-[900] text-[#111] uppercase italic tracking-tight">{r.name}</h4>
                                    <div className="flex items-center gap-2 text-[#D10000] text-md mt-1">
                                        <div className="flex gap-0.5">
                                            <i className="bi bi-star-fill"></i>
                                            <i className="bi bi-star-fill"></i>
                                            <i className="bi bi-star-fill"></i>
                                            <i className="bi bi-star-fill"></i>
                                            <i className="bi bi-star-half"></i>
                                        </div>
                                        <span className="font-[800] text-[#9CA3AF] text-sm tracking-tight">({r.rating})</span>
                                    </div>
                                </div>
                            </div>
                            <div className="flex flex-col items-end gap-2">
                                <p className="text-[13px] font-[600] text-[#9CA3AF]">{r.date}</p>
                                <Badge variant="warning" className="bg-[#FFF8F1] text-[#F59E0B] border-none font-[900] px-4 py-1.5 rounded-[10px] uppercase italic text-[11px] tracking-wider">BookingID {r.id}</Badge>
                            </div>
                        </div>

                        <div className="relative">
                            <i className="bi bi-quote absolute -left-2 -top-4 text-[40px] text-[#D10000] opacity-[0.05]"></i>
                            <p className="text-[15px] text-[#4B5563] leading-[1.8] font-[500] mb-8 relative z-10">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            </p>
                        </div>

                        <div className="flex justify-between items-center pt-6 border-t border-[#F3F4F6]">
                            <p className="text-[13px] font-[800] text-[#9CA3AF] uppercase tracking-wider">
                                By <span className="text-[#111]">{r.by}</span>
                            </p>
                            <div className="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button className="w-10 h-10 rounded-xl bg-gray-50 text-gray-400 hover:bg-[#D10000] hover:text-white transition-all shadow-sm">
                                    <i className="bi bi-reply-fill text-xl"></i>
                                </button>
                                <button className="w-10 h-10 rounded-xl bg-red-50 text-[#D10000] hover:bg-[#D10000] hover:text-white transition-all shadow-sm">
                                    <i className="bi bi-trash3-fill text-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                ))}
            </div>

            <Pagination totalItems={currentReviews.length} />
        </AdminLayout>
    );
}
