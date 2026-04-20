import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';

export default function AdminDetail() {
    const modules = [
        'Dashboard', 'Reviews & Ratings', 'Passenger Management', 'Analytics/Stats',
        'Promo Code Management', 'Advertising Management'
    ];

    return (
        <AdminLayout title="Admin Profile">
            <div className="max-w-4xl mx-auto">
                <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] p-10 relative overflow-hidden">
                    {/* Abstract design element */}
                    <div className="absolute top-0 right-0 w-64 h-64 bg-[#D10000]/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>

                    <div className="flex items-center gap-5 mt-2 mb-10">
                        <Link to="/admin-roles" className="w-10 h-10 rounded-full border border-gray-100 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors bg-white shadow-sm">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div className="flex items-center gap-4">
                            <div className="w-16 h-16 rounded-2xl bg-[#D10000]/10 flex items-center justify-center text-[#D10000] text-2xl">
                                <i className="bi bi-person-badge-fill"></i>
                            </div>
                            <h2 className="text-2xl font-black text-gray-900 tracking-tighter uppercase italic">Esther Howard</h2>
                        </div>
                    </div>

                    <div className="text-[12px] font-black italic text-[#D10000] uppercase tracking-widest mb-6 px-1">Personal Details</div>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                        {[
                            { label: 'Email', value: 'Jeromebell445@gmail.com', icon: 'bi bi-envelope' },
                            { label: 'Phone Number', value: '+1 234 567 789', icon: 'bi bi-telephone' },
                        ].map((info, i) => (
                            <div key={i} className="flex items-center gap-4 p-5 bg-[#F9FAFB] rounded-[20px] border border-[#F3F4F6] hover:border-[#D10000]/20 transition-all group">
                                <div className="w-11 h-11 rounded-xl bg-white flex items-center justify-center text-[#111] group-hover:text-[#D10000] transition-colors border border-gray-100">
                                    <i className={info.icon}></i>
                                </div>
                                <div>
                                    <div className="text-gray-400 text-[10px] uppercase font-black tracking-widest leading-none mb-1.5">{info.label}</div>
                                    <div className="text-[15px] font-black text-gray-900 tracking-tight">{info.value}</div>
                                </div>
                            </div>
                        ))}
                    </div>

                    <div className="text-[12px] font-black italic text-[#D10000] uppercase tracking-widest mb-8 px-1">Access Modules</div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-5 mb-12">
                        {modules.map((m, i) => (
                            <div key={i} className="flex items-center gap-3 p-4 bg-white border border-[#E5E7EB] rounded-[18px] hover:shadow-md hover:border-[#D10000]/30 transition-all cursor-default group">
                                <div className="w-7 h-7 bg-[#10B981] text-white rounded-lg flex items-center justify-center text-xs shadow-sm shadow-[#10B981]/20">
                                    <i className="bi bi-check-lg"></i>
                                </div>
                                <span className="text-[13px] font-black text-gray-800 uppercase tracking-tighter group-hover:text-[#111]">{m}</span>
                            </div>
                        ))}
                    </div>

                    <div className="text-[12px] font-black italic text-[#D10000] uppercase tracking-widest mb-8 px-1">Security / Authentication</div>
                    <div className="p-8 bg-gray-50 rounded-[25px] border border-gray-100 flex items-center justify-between group">
                        <div className="flex items-center gap-5">
                            <div className="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-[#111] group-hover:text-[#D10000] transition-colors shadow-sm border border-gray-100">
                                <i className="bi bi-lock-fill text-xl"></i>
                            </div>
                            <div>
                                <div className="text-gray-400 text-[10px] uppercase font-black tracking-widest leading-none mb-1.5">Password Status</div>
                                <div className="flex items-center gap-3">
                                    <span className="text-base font-black text-gray-900 tracking-widest">••••••••839</span>
                                    <button className="text-gray-400 hover:text-gray-900"><i className="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <button className="px-6 py-2.5 bg-white border border-gray-200 text-gray-900 rounded-xl text-[11px] font-black uppercase tracking-wider hover:bg-[#D10000] hover:text-white hover:border-[#D10000] transition-all shadow-sm italic">
                            Update Password
                        </button>
                    </div>

                    <div className="flex justify-end gap-3 mt-12 pt-8 border-t border-gray-50">
                        <button className="px-12 py-3.5 bg-[#D10000] text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-black transition-all shadow-lg shadow-red-100 italic">
                            Invite
                        </button>
                        <Link to="/admin-roles">
                            <button className="px-12 py-3.5 bg-white border border-gray-200 text-gray-700 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-gray-50 transition-all italic">
                                Cancel
                            </button>
                        </Link>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
