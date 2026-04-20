import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link } from 'react-router-dom';
import { Badge, Button } from '@/components/UI';

export default function BookingDetail() {
    const booking = {
        id: '#34567',
        driver: 'Alex Johnson',
        passenger: 'John Doe',
        fare: '$45.00',
        status: 'Completed',
        date: 'Mar 15, 2024 09:30 PM',
        pickup: '123 West Street, New York, NY',
        dropoff: '456 East Avenue, Brooklyn, NY',
        duration: '25 mins',
        distance: '8.2 miles',
        payment_method: 'Visa (**** 1234)',
        vehicle: 'Suzuki Alto (BKG-220)'
    };

    return (
        <AdminLayout title="Booking Details">
            <div className="max-w-4xl mx-auto">
                <div className="flex items-center justify-between mb-8">
                    <div className="flex items-center gap-4">
                        <Link to="/bookings" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors bg-white">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <h2 className="text-2xl font-black text-gray-900 tracking-tight uppercase italic">Booking {booking.id}</h2>
                    </div>
                    <Badge variant="active">{booking.status}</Badge>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div className="bg-white p-6 rounded-[25px] border border-[#E5E7EB] shadow-sm">
                        <label className="block text-[10px] uppercase tracking-[0.2em] font-black text-gray-400 mb-2">Total Fare</label>
                        <div className="text-3xl font-black text-[#D10000] italic tracking-tighter">{booking.fare}</div>
                    </div>
                    <div className="bg-white p-6 rounded-[25px] border border-[#E5E7EB] shadow-sm">
                        <label className="block text-[10px] uppercase tracking-[0.2em] font-black text-gray-400 mb-2">Distance</label>
                        <div className="text-3xl font-black text-gray-900 italic tracking-tighter">{booking.distance}</div>
                    </div>
                    <div className="bg-white p-6 rounded-[25px] border border-[#E5E7EB] shadow-sm">
                        <label className="block text-[10px] uppercase tracking-[0.2em] font-black text-gray-400 mb-2">Duration</label>
                        <div className="text-3xl font-black text-gray-900 italic tracking-tighter">{booking.duration}</div>
                    </div>
                </div>

                <div className="bg-white rounded-[30px] shadow-sm border border-[#E5E7EB] overflow-hidden mb-8">
                    <div className="bg-[#D10000] px-8 py-4 flex items-center gap-3">
                        <i className="bi bi-geo-alt-fill text-white"></i>
                        <h5 className="text-white font-black text-sm uppercase tracking-widest italic">Trip Information</h5>
                    </div>
                    <div className="p-10 space-y-10">
                        <div className="relative">
                            <div className="absolute left-[7px] top-6 bottom-6 w-[2px] bg-dashed border-l-2 border-dashed border-gray-200"></div>
                            <div className="space-y-12">
                                <div className="flex gap-6 relative">
                                    <div className="w-4 h-4 rounded-full bg-[#10B981] ring-4 ring-green-100 z-10 mt-1"></div>
                                    <div>
                                        <label className="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-1">Pickup Location</label>
                                        <p className="text-base font-bold text-gray-900">{booking.pickup}</p>
                                    </div>
                                </div>
                                <div className="flex gap-6 relative">
                                    <div className="w-4 h-4 rounded-full bg-[#D10000] ring-4 ring-red-100 z-10 mt-1"></div>
                                    <div>
                                        <label className="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-1">Dropoff Location</label>
                                        <p className="text-base font-bold text-gray-900">{booking.dropoff}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="grid grid-cols-2 md:grid-cols-4 gap-8 pt-10 border-t border-gray-50">
                            <div>
                                <label className="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-1.5">Driver</label>
                                <p className="text-[14px] font-black text-[#111] uppercase italic">{booking.driver}</p>
                            </div>
                            <div>
                                <label className="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-1.5">Passenger</label>
                                <p className="text-[14px] font-black text-[#111] uppercase italic">{booking.passenger}</p>
                            </div>
                            <div>
                                <label className="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-1.5">Vehicle</label>
                                <p className="text-[14px] font-black text-[#111] uppercase italic">{booking.vehicle}</p>
                            </div>
                            <div>
                                <label className="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-1.5">Payment</label>
                                <p className="text-[14px] font-black text-[#111] uppercase italic">{booking.payment_method}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="flex justify-end gap-3">
                    <Button variant="outline" className="px-10 py-3.5 italic font-black uppercase tracking-widest">Download Receipt</Button>
                    <Button className="px-10 py-3.5 italic font-black uppercase tracking-widest">Support Request</Button>
                </div>
            </div>
        </AdminLayout>
    );
}
