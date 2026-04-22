import React from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link, useLocation } from 'react-router-dom';
import { Badge } from '@/components/UI';

// Fake data keyed by status type for demonstration
const fakeBookings = {
    online: {
        id: '#98738',
        date: 'Sunday March 23, 2023',
        status: 'ongoing',
        statusLabel: 'Ongoing',
        title: 'Ongoing Ride',
        driver: { name: 'Sergio Morsis', rides: 43, reviews: 31, avatar: '11' },
        vehicle: { name: 'Black Suzuki Alto', vehNo: 'xyz 3457', image: null },
        pickup: { label: 'Office', address: '2972 Westheimer Rd. Santa Ana, Illinois 85486' },
        dropoff: { label: 'Coffee shop', address: '1901 Thornridge Cir. Shiloh, Hawaii 81063' },
        distance: '0.2 km',
        time: '15 min',
        fare: '$25.00',
        passenger: { name: 'Guy Hawkins', rides: 43, reviews: 31, avatar: '12' },
        payment: { brand: 'visa', last4: '234' },
    },
    success: {
        id: '#34526',
        date: 'Sunday March 23, 2023',
        status: 'success',
        statusLabel: 'Completed',
        title: 'Completed Ride',
        driver: { name: 'Sergio Morsis', rides: 43, reviews: 21, avatar: '11' },
        vehicle: { name: 'Black Suzuki Alto', vehNo: 'ABC 1234', image: null },
        pickup: { label: 'Office', address: '2972 Westheimer Rd. Santa Ana, Illinois 85486' },
        dropoff: { label: 'Coffee shop', address: '1901 Thornridge Cir. Shiloh, Hawaii 81063' },
        distance: '0.2 km',
        time: '2 min',
        fare: '$25.00',
        passenger: { name: 'Guy Hawkins', rides: 43, reviews: 31, avatar: '12' },
        payment: { brand: 'visa', last4: '234' },
        rating: 4,
        reviewText: 'Lorem ipsum is simply dummy text of the printing and typesetting industry.',
        tip: 'The Passenger "Guy Hawkins" gives $10 as a tip to the driver "Sergio Morsis"',
    },
    danger: {
        id: '#34526',
        date: 'Sunday March 23, 2023',
        status: 'danger',
        statusLabel: 'Cancelled',
        title: 'Cancelled Ride',
        driver: { name: 'Sergio Morsis', rides: 43, reviews: 31, avatar: '11' },
        vehicle: { name: 'Black Suzuki Alto', vehNo: 'LMN 5678', image: null },
        pickup: { label: 'Office', address: '2972 Westheimer Rd. Santa Ana, Illinois 85486' },
        dropoff: { label: 'Coffee shop', address: '1901 Thornridge Cir. Shiloh, Hawaii 81063' },
        distance: '0.2 km',
        time: '2 min',
        fare: '$25.00',
        passenger: { name: 'Guy Hawkins', rides: 43, reviews: 31, avatar: '12' },
        payment: { brand: 'visa', last4: '234' },
        cancellationReason: 'Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.',
    },
};

export default function BookingDetail() {
    const location = useLocation();
    const bookingStatus = location.state?.bookingStatus || 'online';
    const booking = fakeBookings[bookingStatus] || fakeBookings.online;

    const isOngoing = booking.status === 'ongoing';
    const isCompleted = booking.status === 'success';
    const isCancelled = booking.status === 'danger';

    const statusVariant = isOngoing ? 'online' : isCompleted ? 'success' : 'danger';

    return (
        <AdminLayout title="Booking Management">
            {/* Back + Header */}
            <div className="flex flex-col gap-3 mb-6">
                <div className="flex justify-between items-center gap-3">

                    <div className="flex items-center gap-3">
                        <Link to="/bookings" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors bg-white">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <h2 className="text-xl font-black text-gray-900">Booking Detail</h2>
                    </div>

                    <Badge variant={statusVariant}>{booking.statusLabel}</Badge>
                </div>
                <div className="flex items-center justify-between">
                    <span className="bg-white border border-gray-200 rounded-xl px-4 py-2 text-sm font-black text-gray-900 shadow-sm">
                        Booking ID {booking.id}
                    </span>
                    <span className="text-sm font-bold text-gray-500">{booking.date}</span>

                </div>


            </div>

            {/* Main 2-col layout */}
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {/* LEFT — Map */}
                <div className="flex flex-col gap-4">
                    {/* Map iframe */}
                    <div className="relative rounded-[22px] overflow-hidden h-[420px] border border-gray-100 shadow-sm">
                        <iframe
                            className="w-full h-full border-none contrast-[1.05]"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1469550.0538914043!2d-80.443189!3d43.834789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cd44b1c1d1a8d05%3A0xe10ad5de81c4e7ab!2sToronto%2C%20ON%2C%20Canada!5e0!3m2!1sen!2sus!4v1700000000000!5m2!1sen!2sus"
                            allowFullScreen=""
                            loading="lazy"
                            title="Ride Map"
                        ></iframe>
                    </div>

                    {/* Ratings & Reviews — only for completed */}
                    {isCompleted && (
                        <>
                            <div className="bg-white rounded-[20px] border border-gray-100 shadow-sm overflow-hidden">
                                <div className="bg-[#D10000] px-5 py-3 flex items-center gap-2">
                                    <i className="bi bi-star-fill text-white text-sm"></i>
                                    <h5 className="text-white font-bold text-sm">Ratings & Reviews</h5>
                                </div>
                                <div className="p-5">
                                    <div className="flex items-center gap-2 mb-3">
                                        <div className="flex gap-0.5 text-[#FBBF24]">
                                            {[1, 2, 3, 4, 5].map(s => (
                                                <i key={s} className={`bi bi-star${s <= booking.rating ? '-fill' : ''} text-sm`}></i>
                                            ))}
                                        </div>
                                        <span className="text-xs font-bold text-gray-500">({booking.rating}.0)</span>
                                    </div>
                                    <p className="text-sm text-gray-600 font-medium leading-relaxed">{booking.reviewText}</p>
                                </div>
                            </div>

                            <div className="bg-white rounded-[20px] border border-gray-100 shadow-sm overflow-hidden">
                                <div className="bg-[#D10000] px-5 py-3 flex items-center gap-2">
                                    <i className="bi bi-cash-coin text-white text-sm"></i>
                                    <h5 className="text-white font-bold text-sm">Tip</h5>
                                </div>
                                <div className="p-5">
                                    <p className="text-sm text-gray-600 font-medium leading-relaxed">{booking.tip}</p>
                                </div>
                            </div>
                        </>
                    )}

                    {/* Cancellation Reason — only for cancelled */}
                    {isCancelled && (
                        <div className="bg-white rounded-[20px] border border-gray-100 shadow-sm overflow-hidden">
                            <div className="bg-[#D10000] px-5 py-3 flex items-center gap-2">
                                <i className="bi bi-x-circle-fill text-white text-sm"></i>
                                <h5 className="text-white font-bold text-sm">Cancellation Reason</h5>
                            </div>
                            <div className="p-5">
                                <p className="text-sm text-gray-600 font-medium leading-relaxed">{booking.cancellationReason}</p>
                            </div>
                        </div>
                    )}
                </div>

                {/* RIGHT — Ride Details */}
                <div className="flex flex-col gap-4">


                    <div className="bg-white rounded-[22px] border border-gray-100 shadow-sm overflow-hidden">
                        <div className="px-6 pt-5 pb-2">
                            <h3 className="text-lg font-black text-gray-900 mb-4">{booking.title}</h3>

                            {/* Driver Section */}
                            <div className="mb-3">
                                <div className="bg-[#D10000] rounded-xl px-4 py-2 mb-3">
                                    <span className="text-white font-bold text-xs uppercase tracking-wider">Driver</span>
                                </div>
                                <div className="flex items-center justify-between px-1">
                                    <div className="flex items-center gap-3">
                                        <img src={`https://i.pravatar.cc/100?img=${booking.driver.avatar}`} className="w-12 h-12 rounded-[14px] object-cover" alt="Driver" />
                                        <div>
                                            <p className="text-sm font-black text-gray-900">{booking.driver.name}</p>
                                            <p className="text-xs text-gray-400 font-medium">{booking.driver.rides} Rides ({booking.driver.reviews} reviews)</p>
                                        </div>
                                    </div>
                                    <div className="flex items-center gap-2">
                                        <button className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-[#D10000] hover:bg-red-50 transition-colors">
                                            <i className="bi bi-telephone-fill text-sm"></i>
                                        </button>
                                        {isOngoing && (
                                            <button className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-[#D10000] hover:bg-red-50 transition-colors">
                                                <i className="bi bi-chat-fill text-sm"></i>
                                            </button>
                                        )}
                                    </div>
                                </div>

                                {/* Vehicle */}
                                <div className="flex items-center gap-3 mt-3 px-1 py-3 border-t border-gray-50 text-[14px]">
                                    <div className="w-14 h-10 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center shrink-0">
                                        <i className="bi bi-car-front-fill text-lg text-gray-400"></i>
                                    </div>
                                    <div className="flex flex-col">
                                        <div className="flex items-center gap-2">
                                            <div className="w-2 h-2 bg-black rounded-full shrink-0"></div>
                                            <span className="font-bold text-gray-900">{booking.vehicle.name}</span>
                                        </div>
                                        <div className="flex items-center gap-2 mt-0.5">
                                            <span className="text-xs text-gray-400 font-bold uppercase tracking-wider">Veh No:</span>
                                            <span className="text-xs font-black text-[#D10000] bg-red-50 px-2 py-0.5 rounded-lg border border-red-100">{booking.vehicle.vehNo}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Booking Details */}
                            <div className="mb-3">
                                <div className="bg-[#D10000] rounded-xl px-4 py-2 mb-3">
                                    <span className="text-white font-bold text-xs uppercase tracking-wider">Booking Details</span>
                                </div>
                                <div className="relative pl-6 mb-3">
                                    <div className="absolute left-[3px] top-[14px] bottom-[14px] border-l-2 border-dashed border-gray-200"></div>
                                    <div className="relative mb-4">
                                        <div className="absolute -left-[27px] top-[5px] w-[10px] h-[10px] bg-black rounded-full"></div>
                                        <p className="text-sm font-black text-gray-900">{booking.pickup.label}</p>
                                        <p className="text-xs text-gray-400 font-medium">{booking.pickup.address}</p>
                                    </div>
                                    <div className="relative">
                                        <div className="absolute -left-[30px] top-[3px] text-[#D10000]">
                                            <i className="bi bi-geo-alt-fill text-base"></i>
                                        </div>
                                        <p className="text-sm font-black text-gray-900">{booking.dropoff.label}</p>
                                        <p className="text-xs text-gray-400 font-medium">{booking.dropoff.address}</p>
                                    </div>
                                </div>

                                {/* Metrics */}
                                <div className="flex justify-around border-t border-gray-50 pt-4 pb-2">
                                    <div className="text-center">
                                        <p className="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">EST Distance</p>
                                        <p className="text-sm font-black text-gray-900">{booking.distance}</p>
                                    </div>
                                    <div className="w-px bg-gray-100"></div>
                                    <div className="text-center">
                                        <p className="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">EST Time</p>
                                        <p className="text-sm font-black text-gray-900">{booking.time}</p>
                                    </div>
                                    <div className="w-px bg-gray-100"></div>
                                    <div className="text-center">
                                        <p className="text-[10px] font-black text-gray-400 uppercase tracking-wider mb-1">EST Fare</p>
                                        <p className="text-sm font-black text-[#D10000]">{booking.fare}</p>
                                    </div>
                                </div>
                            </div>

                            {/* Passenger Section */}
                            <div className="mb-4">
                                <div className="bg-[#D10000] rounded-xl px-4 py-2 mb-3">
                                    <span className="text-white font-bold text-xs uppercase tracking-wider">Passenger</span>
                                </div>
                                <div className="flex items-center gap-3 px-1">
                                    <img src={`https://i.pravatar.cc/100?img=${booking.passenger.avatar}`} className="w-12 h-12 rounded-[14px] object-cover" alt="Passenger" />
                                    <div>
                                        <p className="text-sm font-black text-gray-900">{booking.passenger.name}</p>
                                        <p className="text-xs text-gray-400 font-medium">{booking.passenger.rides} Rides ({booking.passenger.reviews} reviews)</p>
                                    </div>
                                </div>
                            </div>

                            {/* Payment Method */}
                            <div className="flex items-center justify-between px-1 py-4 border-t border-gray-50">
                                <span className="text-sm font-bold text-gray-500">Payment Method</span>
                                <div className="flex items-center gap-2">
                                    <div className="w-9 h-5 bg-blue-700 rounded text-white flex items-center justify-center text-[8px] font-bold italic tracking-wider">VISA</div>
                                    <span className="text-sm font-bold text-gray-900">••••••••{booking.payment.last4}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
