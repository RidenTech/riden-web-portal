import React, { useState, useEffect } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { MiniChart } from '@/components/UI';
import { getDashboardStats, getDashboardAnalytics } from '../../api/dashboard';

export default function Dashboard() {
    const [stats, setStats] = useState(null);
    const [analytics, setAnalytics] = useState(null);
    const [loading, setLoading] = useState(true);

    const loadData = async () => {
        try {
            const statsRes = await getDashboardStats();
            const analyticsRes = await getDashboardAnalytics();

            setStats(statsRes);
            setAnalytics(analyticsRes);
        } catch (error) {
            console.log("Error loading dashboard data", error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        loadData();
    }, []);

    // Get chart data from analytics
    const getActiveDriversChartData = () => {
        if (analytics?.data?.passenger_growth) {
            return analytics.data.passenger_growth.slice(-7).map(item => item.total);
        }
        return [30, 50, 40, 75, 100, 60, 25]; // fallback data
    };

    const getOngoingRidesChartData = () => {
        if (analytics?.data?.booking_trends) {
            return analytics.data.booking_trends.slice(-7).map(item => item.total);
        }
        return [30, 50, 100, 75, 60, 45, 20]; // fallback data
    };

    if (loading) {
        return (
            <AdminLayout title="Dashboard">
                <div className="flex justify-center items-center h-96">
                    <div className="text-center">
                        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-[#D10000] mx-auto"></div>
                        <p className="mt-4 text-gray-600">Loading dashboard...</p>
                    </div>
                </div>
            </AdminLayout>
        );
    }

    return (
        <AdminLayout title="Dashboard">
            {/* Top KPI Cards Row */}
            <div className="flex flex-wrap lg:flex-nowrap gap-4 mb-4">
                {/* Active Drivers - Now using real data */}
                <div className="bg-white border-[1.5px] border-[#D10000] rounded-[30px] px-8 py-8 flex-1 min-w-[320px] flex justify-between items-center shadow-sm">
                    <div>
                        <h4 className="text-[18px] font-[500] text-[#111] mb-2">Active Drivers</h4>
                        <p className="text-[44px] font-[700] text-[#111] leading-none">
                            {stats?.data?.total_drivers || 0}
                        </p>
                    </div>
                    <MiniChart variant="green" data={getActiveDriversChartData()} />
                </div>

                {/* Ongoing Rides - Now using real data */}
                <div className="bg-white border-[1.5px] border-[#D10000] rounded-[30px] px-8 py-8 flex-1 min-w-[320px] flex justify-between items-center shadow-sm">
                    <div>
                        <h4 className="text-[18px] font-[500] text-[#111] mb-2">Ongoing Rides</h4>
                        <p className="text-[44px] font-[700] text-[#111] leading-none">
                            {stats?.data?.ongoing_bookings || 0}
                        </p>
                    </div>
                    <MiniChart variant="yellow" data={getOngoingRidesChartData()} />
                </div>
            </div>

            {/* Map Section */}
            <div className="bg-white rounded-[30px] overflow-hidden relative h-[650px] border border-[#E5E7EB]">
                <iframe
                    className="w-full h-full border-none contrast-[1.05]"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1469550.0538914043!2d-80.443189!3d43.834789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cd44b1c1d1a8d05%3A0xe10ad5de81c4e7ab!2sToronto%2C%20ON%2C%20Canada!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
                    allowFullScreen=""
                    loading="lazy"
                    title="Live Map"
                ></iframe>

                {/* Ongoing Ride Card Overlay - Some data updated from backend */}
                <div className="absolute top-[10%] right-[12%] bg-white rounded-[40px] p-6 w-[380px] shadow-[0_15px_50px_rgba(0,0,0,0.1)] z-10">
                    <h4 className="text-[17px] font-[800] text-[#D10000] mb-6">Ongoing Ride</h4>

                    {/* Driver Profile */}
                    <div className="flex items-center justify-between mb-4">
                        <div className="flex items-center gap-4">
                            <img src="https://i.pravatar.cc/150?img=11" alt="Driver" className="w-[54px] h-[54px] rounded-[14px] object-cover" />
                            <div>
                                <h5 className="text-[15px] font-[800] text-[#111]">Sergio Morsis</h5>
                                <p className="text-[11px] text-[#6B7280] font-[500]">
                                    {stats?.data?.completed_bookings || 0} Rides
                                </p>
                            </div>
                        </div>
                        <button className="w-[48px] h-[48px] rounded-full border border-[#E5E7EB] flex items-center justify-center text-[#D10000] hover:bg-[#D10000] hover:text-white transition-all shadow-sm">
                            <i className="bi bi-telephone-fill text-[16px]"></i>
                        </button>
                    </div>

                    {/* Locations Timeline */}
                    <div className="relative pl-6 mb-4">
                        {/* Custom Dashed Line */}
                        <div className="absolute left-[3px] top-[14px] bottom-[14px] w-[2px] border-l-2 border-dashed border-[#CBD5E1]"></div>

                        <div className="relative mb-4">
                            <div className="absolute -left-[27px] top-[6px] w-[11px] h-[11px] bg-black rounded-full"></div>
                            <h6 className="text-[15px] font-[800] text-[#111]">Office</h6>
                            <p className="text-[12px] text-[#6B7280]">2972 Westheimer Rd. Santa Ana, Illinois 85486</p>
                        </div>
                        <div className="relative">
                            <div className="absolute -left-[30px] top-[5px] text-[#D10000]">
                                <i className="bi bi-geo-alt-fill text-[16px]"></i>
                            </div>
                            <h6 className="text-[15px] font-[800] text-[#111]">Coffee shop</h6>
                            <p className="text-[12px] text-[#6B7280]">1901 Thornridge Cir. Shiloh, Hawaii 81063</p>
                        </div>
                    </div>

                    {/* Trip Metrics Row */}
                    <div className="flex justify-between border-t border-[#F1F5F9] pt-8 mb-4">
                        <div className="text-center">
                            <p className="text-[10px] font-[800] text-[#94A3B8] uppercase tracking-wider mb-2">Distance</p>
                            <p className="text-[13px] font-[800] text-[#111]">0.2 km</p>
                        </div>
                        <div className="text-center">
                            <p className="text-[10px] font-[800] text-[#94A3B8] uppercase tracking-wider mb-2">Time</p>
                            <p className="text-[13px] font-[800] text-[#111]">2 min</p>
                        </div>
                        <div className="text-center">
                            <p className="text-[10px] font-[800] text-[#94A3B8] uppercase tracking-wider mb-2">Fare</p>
                            <p className="text-[13px] font-[800] text-[#111]">
                                ${stats?.data?.revenue > 0 ? (stats.data.revenue / (stats.data.completed_bookings || 1)).toFixed(2) : '25.00'}
                            </p>
                        </div>
                    </div>

                    {/* Vehicle Footer */}
                    <div className="flex items-center gap-4 border-t border-[#F1F5F9] pt-4">
                        <div className="w-[60px] h-[40px] rounded-[10px] overflow-hidden bg-gray-50 flex items-center justify-center">
                            <img src="/assets/images/vehicle-alto.png" alt="Car" className="w-full h-full object-cover" />
                        </div>
                        <div className="flex items-center gap-2">
                            <div className="w-2 h-2 bg-black rounded-full"></div>
                            <span className="text-[13px] font-[800] text-[#111]">Black Suzuki Alto, (BKG-220)</span>
                        </div>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}