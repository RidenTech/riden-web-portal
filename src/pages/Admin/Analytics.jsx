import React, { useState, useMemo } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';
import {
    BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer,
    AreaChart, Area, LineChart, Line, PieChart, Pie, Cell
} from 'recharts';
import { format, startOfWeek, startOfMonth, startOfYear } from 'date-fns';

export default function Analytics() {
    const [activeTab, setActiveTab] = useState('driver');
    const [startDate, setStartDate] = useState(startOfWeek(new Date()));
    const [endDate, setEndDate] = useState(new Date());
    const [globalPeriod, setGlobalPeriod] = useState('This Week');

    const tabs = [
        { id: 'driver', label: 'Driver Analytics' },
        { id: 'passenger', label: 'Passengers Insights' },
        { id: 'ride', label: 'Ride Analytics' },
        { id: 'financial', label: 'Financial Metrics' },
    ];

    const handleGlobalPeriodChange = (e) => {
        const val = e.target.value;
        setGlobalPeriod(val);
        if (val === 'Today') {
            setStartDate(new Date());
            setEndDate(new Date());
        } else if (val === 'This Week') {
            setStartDate(startOfWeek(new Date()));
            setEndDate(new Date());
        } else if (val === 'This Month') {
            setStartDate(startOfMonth(new Date()));
            setEndDate(new Date());
        } else if (val === 'This Year') {
            setStartDate(startOfYear(new Date()));
            setEndDate(new Date());
        }
    };

    return (
        <AdminLayout title="Analytics">
            {/* Filters Row */}
            <div className="flex flex-wrap items-center gap-2 mb-4">
                <div className="relative group ">
                    <select
                        value={globalPeriod}
                        onChange={handleGlobalPeriodChange}
                        className="pl-5 pr-15 py-2 bg-white border-[1.5px] border-[#666]/20 rounded-full text-[14px] font-[600] text-[#111] appearance-none outline-none focus:border-[#D10000] cursor-pointer shadow-sm"
                    >
                        <option>Today</option>
                        <option>This Week</option>
                        <option>This Month</option>
                        <option>This Year</option>
                    </select>
                    <i className="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[#D10000] text-[12px] pointer-events-none"></i>
                </div>

                <div className="flex items-center gap-2 ml-2">
                    <div className="flex gap-2">
                        <div className="relative border  border-[#D10000] w-[200px] rounded-full">
                            <div className="absolute left-1 top-1/2 -translate-y-1/2 w-8 h-8 rounded-[30px] bg-[#D10000] flex items-center justify-center text-white z-10">
                                <i className="bi bi-calendar-check text-[14px]"></i>
                            </div>
                            <DatePicker
                                selected={startDate}
                                onChange={(date) => setStartDate(date)}
                                placeholderText="From"
                                maxDate={new Date()}
                                className="pl-11 pr-4 py-2 bg-white border-[1.5px] border-[#666]/30 rounded-full text-[14px] font-[600] w-44 outline-none focus:border-[#D10000] transition-all shadow-sm"
                            />
                        </div>
                        <div className="relative border  border-[#D10000] w-[200px] rounded-full">
                            <div className="absolute left-1 top-1/2 -translate-y-1/2 w-8 h-8 rounded-[30px]  bg-[#D10000] flex items-center justify-center text-white z-10">
                                <i className="bi bi-calendar-check text-[14px]"></i>
                            </div>
                            <DatePicker
                                selected={endDate}
                                onChange={(date) => setEndDate(date)}
                                placeholderText="To"
                                maxDate={new Date()}
                                className="pl-11 pr-4 py-2 bg-white  text-[14px] font-[600]  transition-all"
                            />
                        </div>
                    </div>
                </div>
            </div>

            {/* Top KPI Summary Bar */}
            <div className="bg-[#FF161F1A] rounded-[30px] p-8 mb-4 border border-[#FEE2E2] relative overflow-hidden">
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-0 items-center relative z-10">
                    {[
                        { label: 'Total Rides', value: '243', icon: 'bi-car-front-fill' },
                        { label: 'Total Drivers', value: '243', icon: 'bi-person-badge-fill' },
                        { label: 'Total Revenue', value: '$1023.00', icon: 'bi-graph-up-arrow' },
                        { label: 'Satisfaction Rate', value: '93%', icon: 'bi-star-fill' },
                    ].map((kpi, i) => (
                        <div key={i} className={`flex items-center gap-4 px-2 ${i < 3 ? 'border-r-2 border-[#D10000]' : ''}`}>
                            <div className="w-[64px] h-[64px] rounded-full bg-white shadow-[0_8px_30px_rgba(209,0,0,0.08)] flex items-center justify-center shrink-0">
                                <i className={`bi ${kpi.icon} text-[26px] text-[#D10000]`}></i>
                            </div>
                            <div>
                                <p className="text-[14px] font-[600] text-[#6B7280] mb-0.5">{kpi.label}</p>
                                <h3 className="text-[32px] font-[600] text-[#111] leading-none tracking-tight">{kpi.value}</h3>
                            </div>
                        </div>
                    ))}
                </div>
            </div>

            {/* Sub-Navigation */}
            <div className="bg-[#D10000] rounded-full p-1.5 flex mb-4 w-fit">
                {tabs.map((tab) => (
                    <button
                        key={tab.id}
                        onClick={() => setActiveTab(tab.id)}
                        className={`px-8 py-3 rounded-full text-[15px] font-[700] transition-all duration-300 ${activeTab === tab.id
                            ? 'bg-white text-[#D10000] shadow-md'
                            : 'text-white hover:bg-white/10'
                            }`}
                    >
                        {tab.label}
                    </button>
                ))}
            </div>

            {/* Tab Content */}
            <div className="animate-fade-in transition-all">
                {activeTab === 'driver' && <DriverAnalytics />}
                {activeTab === 'passenger' && <PassengerAnalytics />}
                {activeTab === 'ride' && <RideAnalytics />}
                {activeTab === 'financial' && <FinancialAnalytics />}
            </div>

            <style dangerouslySetInnerHTML={{
                __html: `
                @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
                .animate-fade-in { animation: fade-in 0.4s ease-out; }
                .react-datepicker-wrapper { display: block; }
                .react-datepicker__input-container input { width: 100%; border: none; background: transparent; }
                .react-datepicker-popper { z-index: 9999 !important; }
                .react-datepicker {
                    border: 1.5px solid #D10000 !important;
                    border-radius: 20px !important;
                    overflow: hidden;
                    font-family: inherit !important;
                    box-shadow: 0 10px 30px rgba(209,0,0,0.15) !important;
                }
                .react-datepicker__header {
                    background-color: #D10000 !important;
                    border-bottom: none !important;
                    padding-top: 15px !important;
                }
                .react-datepicker__current-month, .react-datepicker__day-name {
                    color: white !important;
                    font-weight: 700 !important;
                }
                .react-datepicker__day--selected, .react-datepicker__day--keyboard-selected {
                    background-color: #D10000 !important;
                    color: white !important;
                    border-radius: 8px !important;
                }
                .react-datepicker__day:hover {
                    background-color: #FFF1F1 !important;
                    border-radius: 8px !important;
                }
                .react-datepicker__navigation-icon::before {
                    border-color: white !important;
                }
            ` }} />
        </AdminLayout>
    );
}

function ModuleHeader({ title, period, onPeriodChange }) {
    return (
        <div className="flex justify-between items-center mb-6">
            <h4 className="text-[18px] font-[600] text-[#111]">{title}</h4>
            <div className="relative">
                <select
                    value={period}
                    onChange={onPeriodChange}
                    className="border-[1.5px] border-[#666]/20 rounded-full px-5 py-2 text-[12px] font-[600] text-[#111] outline-none bg-white appearance-none pr-10 hover:border-[#D10000] cursor-pointer"
                >
                    <option>Today</option>
                    <option>This Week</option>
                    <option>This Month</option>
                    <option>This Year</option>
                </select>
                <i className="bi bi-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-[#D10000] text-[10px] pointer-events-none"></i>
            </div>
        </div>
    );
}

const generateDataForPeriod = (period, dataKey) => {
    if (period === 'Today') {
        return Array.from({ length: 12 }, (_, i) => ({
            name: `${i * 2}:00`,
            [dataKey]: Math.floor(Math.random() * 20) + 5
        }));
    } else if (period === 'This Month') {
        return ['Week 1', 'Week 2', 'Week 3', 'Week 4'].map(w => ({
            name: w,
            [dataKey]: Math.floor(Math.random() * 100) + 50
        }));
    } else if (period === 'This Year') {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'].map(m => ({
            name: m,
            [dataKey]: Math.floor(Math.random() * 500) + 200
        }));
    } else {
        // Week
        return ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'].map(d => ({
            name: d,
            [dataKey]: Math.floor(Math.random() * 50) + 10
        }));
    }
};

const generateDualDataForPeriod = (period, key1, key2) => {
    const base = generateDataForPeriod(period, key1);
    return base.map(item => ({
        ...item,
        [key2]: Math.floor(Math.random() * (item[key1] * 0.8)) + 10
    }));
};

function DriverAnalytics() {
    const [period, setPeriod] = useState('This Week');
    const data = useMemo(() => generateDataForPeriod(period, 'hours'), [period]);
    const pieData = [{ name: 'Ratings', value: 75, color: '#EC4899' }, { name: 'Complaints', value: 25, color: '#3B82F6' }];

    return (
        <div className="space-y-5">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="bg-white border-[1.5px] border-[#D10000] rounded-[30px] px-8 py-6 flex justify-between items-center shadow-sm relative overflow-hidden group">
                    <div>
                        <h4 className="text-[18px] font-[600] text-[#111] mb-4">Active Drivers</h4>
                        <p className="text-[44px] font-[600] text-[#111] leading-none">210</p>
                    </div>
                    <img src="/assets/images/activedriver.png" className="w-[160px] h-auto object-contain" alt="Active Drivers" />
                </div>
                <div className="bg-white border-[1.5px] border-[#D10000] rounded-[30px] px-8 py-6 flex justify-between items-center shadow-sm relative overflow-hidden group">
                    <div>
                        <h4 className="text-[18px] font-[600] text-[#111] mb-4">Offline Drivers</h4>
                        <p className="text-[44px] font-[600] text-[#111] leading-none">33</p>
                    </div>
                    <img src="/assets/images/offlinedriver.png" className="w-[160px] h-auto object-contain" alt="Offline Drivers" />
                </div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-5 gap-4">
                <div className="lg:col-span-3 bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm">
                    <ModuleHeader title="Avg. Driver Hours" period={period} onPeriodChange={(e) => setPeriod(e.target.value)} />
                    <div className="h-[300px] w-full mt-2">
                        <ResponsiveContainer width="100%" height="100%">
                            <BarChart data={data} margin={{ top: 0, right: 0, left: -20, bottom: 0 }}>
                                <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#E5E7EB" />
                                <XAxis dataKey="name" axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <YAxis axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <Tooltip cursor={{ fill: 'rgba(59, 130, 246, 0.05)' }} contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 4px 20px rgba(0,0,0,0.1)' }} />
                                <Bar dataKey="hours" fill="#3B82F6" radius={[8, 8, 0, 0]} barSize={period === 'Today' ? 20 : 40} />
                            </BarChart>
                        </ResponsiveContainer>
                    </div>
                </div>

                <div className="lg:col-span-2 bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm relative flex flex-col">
                    <h4 className="text-[18px] font-[600] text-[#111] mb-6">Ratings & Complaints</h4>
                    <div className="flex-1 flex flex-col justify-between">
                        <div className="space-y-4">
                            <div className="flex items-center gap-4">
                                <div className="w-8 h-2.5 bg-[#3B82F6] rounded-full"></div>
                                <span className="text-[13px] font-[600] text-[#6B7280]">Complaints <span className="text-[#D10000]">25</span></span>
                            </div>
                            <div className="flex items-center gap-4">
                                <div className="w-8 h-2.5 bg-[#EC4899] rounded-full"></div>
                                <span className="text-[13px] font-[600] text-[#6B7280]">Ratings <span className="text-[#10B981]">75%</span> (45)</span>
                            </div>
                        </div>
                        <div className="h-[200px] w-full self-center">
                            <ResponsiveContainer width="100%" height="100%">
                                <PieChart>
                                    <Pie data={pieData} innerRadius={60} outerRadius={85} paddingAngle={5} dataKey="value" stroke="none">
                                        {pieData.map((entry, index) => <Cell key={index} fill={entry.color} />)}
                                    </Pie>
                                    <Tooltip contentStyle={{ borderRadius: '10px', border: 'none' }} />
                                </PieChart>
                            </ResponsiveContainer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

function PassengerAnalytics() {
    const [period, setPeriod] = useState('This Week');
    const data = useMemo(() => generateDualDataForPeriod(period, 'oneTime', 'repeat'), [period]);

    return (
        <div className="space-y-5">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="bg-white border-[1.5px] border-[#D10000] rounded-[30px] px-8 py-6 flex justify-between items-center shadow-sm relative overflow-hidden group">
                    <div>
                        <h4 className="text-[18px] font-[600] text-[#111] mb-8">Total Passengers</h4>
                        <p className="text-[44px] font-[600] text-[#111] leading-none">1024</p>
                    </div>
                    <img src="/assets/images/totalpassenger.png" className="w-[160px] h-auto object-contain" alt="Total Passengers" />
                </div>
                <div className="bg-white border-[1.5px] border-[#D10000] rounded-[30px] px-8 py-6 flex justify-between items-center shadow-sm relative overflow-hidden group">
                    <div>
                        <h4 className="text-[18px] font-[600] text-[#111] mb-8">Active Passengers</h4>
                        <p className="text-[44px] font-[600] text-[#111] leading-none">848</p>
                    </div>
                    <img src="/assets/images/activepassenger.png" className="w-[160px] h-auto object-contain" alt="Active Passengers" />
                </div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-5 gap-4">
                <div className="lg:col-span-3 bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm">
                    <ModuleHeader title="Repeat Ride Ratio" period={period} onPeriodChange={(e) => setPeriod(e.target.value)} />
                    <div className="h-[300px] w-full">
                        <ResponsiveContainer width="100%" height="100%">
                            <AreaChart data={data} margin={{ top: 10, right: 10, left: -20, bottom: 0 }}>
                                <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#E5E7EB" />
                                <XAxis dataKey="name" axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <YAxis axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <Tooltip contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 4px 20px rgba(0,0,0,0.1)' }} />
                                <Area type="monotone" dataKey="oneTime" stroke="#3B82F6" strokeWidth={4} fillOpacity={0.1} fill="#3B82F6" />
                                <Area type="monotone" dataKey="repeat" stroke="#10B981" strokeWidth={4} fillOpacity={0.1} fill="#10B981" />
                            </AreaChart>
                        </ResponsiveContainer>
                    </div>
                </div>

                <div className="lg:col-span-2 bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm relative flex flex-col">
                    <h4 className="text-[18px] font-[600] text-[#111] mb-6">Ratings & Complaints</h4>
                    <div className="flex-1 flex flex-col justify-between">
                        <div className="space-y-4">
                            <div className="flex items-center gap-4">
                                <div className="w-8 h-2.5 bg-[#3B82F6] rounded-full"></div>
                                <span className="text-[13px] font-[600] text-[#6B7280]">Complaints <span className="text-[#D10000]">25%</span></span>
                            </div>
                            <div className="flex items-center gap-4">
                                <div className="w-8 h-2.5 bg-[#EC4899] rounded-full"></div>
                                <span className="text-[13px] font-[600] text-[#6B7280]">Ratings <span className="text-[#10B981]">75%</span></span>
                            </div>
                        </div>
                        <div className="h-[200px] w-full self-center">
                            <ResponsiveContainer width="100%" height="100%">
                                <PieChart>
                                    <Pie data={[{ v: 75, c: '#EC4899' }, { v: 25, c: '#3B82F6' }]} innerRadius={55} outerRadius={80} dataKey="v" stroke="none">
                                        {[{ c: '#EC4899' }, { c: '#3B82F6' }].map((e, i) => <Cell key={i} fill={e.c} />)}
                                    </Pie>
                                    <Tooltip />
                                </PieChart>
                            </ResponsiveContainer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

function RideAnalytics() {
    const [period, setPeriod] = useState('This Week');
    const data = useMemo(() => generateDataForPeriod(period, 'volume'), [period]);

    return (
        <div className="space-y-5">
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                {[
                    { label: 'Ongoing Rides', value: '35', icon: 'bi-cursor-fill' }, { label: 'Completed Rides', value: '1023', icon: 'bi-check-circle-fill' }, { label: 'Cancelled Rides', value: '27', icon: 'bi-x-circle-fill' },
                ].map((stat, i) => (
                    <div key={i} className="bg-white border-[1.5px] border-[#D10000] rounded-[30px] p-8 flex justify-between items-center relative overflow-hidden group hover:bg-[#FFF8F8] transition-all">
                        <div>
                            <p className="text-[17px] font-[600] text-[#111] mb-2">{stat.label}</p>
                            <h3 className="text-[44px] font-[600] text-[#111] leading-none">{stat.value}</h3>
                        </div>
                        <div className="w-16 h-16 rounded-full bg-[#fdfdfd] border-[1.5px] border-[#E5E7EB] flex items-center justify-center text-[#D10000]">
                            <i className={`bi ${stat.icon} text-[32px]`}></i>
                        </div>
                    </div>
                ))}
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-5 gap-4">
                <div className="lg:col-span-3 bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm">
                    <ModuleHeader title="Ride Volume Over Time" period={period} onPeriodChange={(e) => setPeriod(e.target.value)} />
                    <div className="h-[320px] w-full">
                        <ResponsiveContainer width="100%" height="100%">
                            <AreaChart data={data} margin={{ top: 10, right: 10, left: -20, bottom: 0 }}>
                                <defs><linearGradient id="colorVolumeR" x1="0" y1="0" x2="0" y2="1"><stop offset="5%" stopColor="#D10000" stopOpacity={0.15} /><stop offset="95%" stopColor="#D10000" stopOpacity={0} /></linearGradient></defs>
                                <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#E5E7EB" />
                                <XAxis dataKey="name" axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <YAxis axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <Tooltip contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 4px 20px rgba(0,0,0,0.1)' }} />
                                <Area type="monotone" dataKey="volume" stroke="#D10000" strokeWidth={4} fillOpacity={1} fill="url(#colorVolumeR)" />
                            </AreaChart>
                        </ResponsiveContainer>
                    </div>
                </div>

                <div className="lg:col-span-2 space-y-3">
                    <div className="bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm">
                        <h4 className="text-[18px] font-[600] text-[#111] mb-6">Peak Ride Times</h4>
                        <div className="space-y-4">
                            {[{ label: '8-9 AM (Mon-Fri)', icon: 'bi-clock-fill' }, { label: '5-7 PM (All Days)', icon: 'bi-clock-fill' }, { label: '9-10 PM (Weekends)', icon: 'bi-clock-fill' }].map((item, i) => (
                                <div key={i} className="flex items-center gap-4">
                                    <div className="w-10 h-10 rounded-full bg-[#FFF1F1] flex items-center justify-center text-[#D10000]"><i className={`bi ${item.icon} text-[18px]`}></i></div>
                                    <span className="text-[15px] font-[700] text-[#111]">{item.label}</span>
                                </div>))}
                        </div>
                    </div>
                    <div className="bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm">
                        <h4 className="text-[18px] font-[600] text-[#111] mb-6">Ride Cancellation Rates</h4>
                        <div className="space-y-5">
                            <div><div className="flex justify-between mb-2"><span className="text-[12px] font-[600] text-[#6B7280] uppercase">By Passengers</span><span className="text-[12px] font-[600] text-[#111]">75%</span></div><div className="w-full h-2.5 bg-[#F3F4F6] rounded-full overflow-hidden"><div className="h-full bg-blue-600 rounded-full" style={{ width: '75%' }}></div></div></div>
                            <div><div className="flex justify-between mb-2"><span className="text-[12px] font-[600] text-[#6B7280] uppercase">By Drivers</span><span className="text-[12px] font-[600] text-[#111]">25%</span></div><div className="w-full h-2.5 bg-[#F3F4F6] rounded-full overflow-hidden"><div className="h-full bg-[#D10000] rounded-full" style={{ width: '25%' }}></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

function FinancialAnalytics() {
    const [period, setPeriod] = useState('This Week');
    const data = useMemo(() => generateDataForPeriod(period, 'amount'), [period]);
    const pieData = [{ name: 'Card', value: 65, color: '#D10000' }, { name: 'Wallet', value: 20, color: '#F87171' }, { name: 'Apple Pay', value: 10, color: '#94A3B8' }, { name: 'Others', value: 5, color: '#E5E7EB' }];

    return (
        <div className="space-y-5">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div className="bg-white border-[1.5px] border-[#666]/10 rounded-[30px] px-8 py-8 flex justify-between items-start shadow-sm relative overflow-hidden group">
                    <div className="relative z-10"><div className="flex items-center gap-2 mb-6"><div className="w-8 h-8 rounded-full border-2 border-[#D10000] flex items-center justify-center text-[#D10000]"><i className="bi bi-arrow-counterclockwise font-bold"></i></div><h4 className="text-[18px] font-[600] text-[#111]">Refunds/Chargebacks</h4></div><div className="space-y-1 pl-2"><h5 className="text-[17px] font-[700] text-[#D10000]">32 Rides Refunded</h5><p className="text-[14px] font-[600] text-[#6B7280]">2.3% of Total Rides</p></div></div>
                    <img src="/assets/images/refunds.png" className="w-[180px] self-center h-auto object-contain relative z-10" alt="Refunds" />
                </div>
                <div className="bg-white border-[1.5px] border-[#666]/10 rounded-[30px] px-8 py-8 flex justify-between items-start shadow-sm relative overflow-hidden group">
                    <div className="flex-1 relative z-10"><div className="flex items-center gap-2 mb-6"><div className="w-8 h-8 rounded-full border-2 border-[#D10000] flex items-center justify-center text-[#D10000]"><i className="bi bi-percent"></i></div><h4 className="text-[18px] font-[600] text-[#111]">Commission</h4></div><div className="space-y-3"><div className="flex justify-between items-center"><span className="text-[14px] font-[700] text-[#6B7280] uppercase">Revenue</span><span className="text-[14px] font-[600] text-[#111]">$1,200,000</span></div><div className="flex justify-between items-center"><span className="text-[14px] font-[700] text-[#6B7280] uppercase">Drivers</span><span className="text-[14px] font-[600] text-[#111]">$870,000</span></div><div className="flex justify-between items-center"><span className="text-[14px] font-[700] text-[#6B7280] uppercase">Commission</span><span className="text-[14px] font-[600] text-[#10B981]">$330,000 (27.5%)</span></div></div></div>
                    <img src="/assets/images/commission.png" className="w-[150px] self-center h-auto object-contain relative z-10" alt="Commission" />
                </div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-5 gap-4">
                <div className="lg:col-span-3 bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm">
                    <ModuleHeader title="Commission Trend" period={period} onPeriodChange={(e) => setPeriod(e.target.value)} />
                    <div className="h-[300px] w-full mt-2">
                        <ResponsiveContainer width="100%" height="100%">
                            <LineChart data={data} margin={{ top: 10, right: 10, left: -10, bottom: 0 }}>
                                <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#E5E7EB" />
                                <XAxis dataKey="name" axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <YAxis axisLine={false} tickLine={false} tick={{ fontSize: 11, fill: '#94A3B8', fontWeight: 600 }} />
                                <Tooltip contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 4px 20px rgba(0,0,0,0.1)' }} />
                                <Line type="monotone" dataKey="amount" stroke="#D10000" strokeWidth={5} dot={{ r: 6, fill: '#D10000', strokeWidth: 2, stroke: '#fff' }} activeDot={{ r: 8 }} />
                            </LineChart>
                        </ResponsiveContainer>
                    </div>
                </div>

                <div className="lg:col-span-2 bg-white border-[1.5px] border-[#666]/10 rounded-[30px] p-6 shadow-sm flex flex-col">
                    <h4 className="text-[18px] font-[600] text-[#111] mb-6">Payment Method</h4>
                    <div className="flex-1 flex flex-col justify-between">
                        <div className="space-y-4">{pieData.map((item, idx) => (
                            <div key={idx} className="flex items-center gap-3"><div className="w-3 h-3 rounded-full" style={{ backgroundColor: item.color }}></div><span className="text-[13px] font-[600] text-[#6B7280]">{item.name} <span className="text-[#111]">{item.value}%</span></span></div>))}
                        </div>
                        <div className="h-[200px] w-full self-end mt-4">
                            <ResponsiveContainer width="100%" height="100%">
                                <PieChart><Pie data={pieData} innerRadius={55} outerRadius={80} paddingAngle={5} dataKey="value" stroke="none">{pieData.map((e, i) => <Cell key={i} fill={e.color} />)}</Pie><Tooltip contentStyle={{ borderRadius: '10px', border: 'none' }} /></PieChart>
                            </ResponsiveContainer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
