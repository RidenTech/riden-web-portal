import React, { useState } from 'react';
import AdminLayout from '@/layouts/AdminLayout';
import { Link, useNavigate } from 'react-router-dom';
import { Label, InputWrapper, Input, Select, Button, useToast } from '@/components/UI';

export default function BookingCreate() {
    const { showToast } = useToast();
    const navigate = useNavigate();
    const [bookingInfo, setBookingInfo] = useState({
        driver: '',
        passenger: '',
        vehNo: '',
        pickup: '',
        dropoff: '',
        fare: '',
        distance: '',
        duration: '',
        status: 'online'
    });
    const [errors, setErrors] = useState({});

    const validate = () => {
        const newErrors = {};
        if (!bookingInfo.driver) newErrors.driver = 'Driver name is required';
        if (!bookingInfo.passenger) newErrors.passenger = 'Passenger name is required';
        if (!bookingInfo.vehNo) newErrors.vehNo = 'Vehicle number is required';
        if (!bookingInfo.pickup) newErrors.pickup = 'Pickup location is required';
        if (!bookingInfo.dropoff) newErrors.dropoff = 'Dropoff location is required';
        if (!bookingInfo.fare) newErrors.fare = 'Fare is required';
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const handleSubmit = () => {
        if (validate()) {
            showToast(`Manual booking for ${bookingInfo.passenger} has been created`, "success");
            navigate('/bookings');
        }
    };

    return (
        <AdminLayout title="Booking Management">
            <div className="mx-auto mb-4">
                <div className="bg-white p-10 rounded-[20px] shadow-sm border border-[#E5E7EB]">
                    {/* Header Title */}
                    <div className="mb-4 flex items-center gap-2 pb-6">
                        <Link to="/bookings" className="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
                            <i className="bi bi-chevron-left text-sm"></i>
                        </Link>
                        <div>
                            <h1 className="text-2xl font-bold text-gray-900 leading-tight">Add New Booking</h1>
                            <p className="text-sm text-gray-500 font-medium">Fill in the details to create a manual booking</p>
                        </div>
                    </div>

                    <div className="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
                        {/* User Details */}
                        <div className="space-y-6">
                            <div className="flex items-center gap-2 mb-2">
                                <div className="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center">
                                    <i className="bi bi-person-circle text-[#D10000] text-lg"></i>
                                </div>
                                <h2 className="text-lg font-black text-gray-900">User Details</h2>
                            </div>

                            <div className="space-y-4">
                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Select Passenger</Label>
                                    <InputWrapper className={`bg-white ${errors.passenger ? 'border-red-500' : ''}`}>
                                        <Select
                                            value={bookingInfo.passenger}
                                            onChange={(e) => setBookingInfo({ ...bookingInfo, passenger: e.target.value })}
                                            className="text-gray-500 font-medium"
                                        >
                                            <option value="" disabled>Choose a passenger...</option>
                                            <option value="John Doe">John Doe</option>
                                            <option value="Jane Smith">Jane Smith</option>
                                        </Select>
                                        <i className="bi bi-chevron-down text-gray-400"></i>
                                    </InputWrapper>
                                    {errors.passenger && <span className="text-xs text-red-500 mt-1 block">{errors.passenger}</span>}
                                </div>

                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Select Driver</Label>
                                    <InputWrapper className={`bg-white ${errors.driver ? 'border-red-500' : ''}`}>
                                        <Select
                                            value={bookingInfo.driver}
                                            onChange={(e) => setBookingInfo({ ...bookingInfo, driver: e.target.value })}
                                            className="text-gray-500 font-medium"
                                        >
                                            <option value="" disabled>Choose a driver...</option>
                                            <option value="Sergio Morsis">Sergio Morsis</option>
                                            <option value="Ralph Edwards">Ralph Edwards</option>
                                        </Select>
                                        <i className="bi bi-chevron-down text-gray-400"></i>
                                    </InputWrapper>
                                    {errors.driver && <span className="text-xs text-red-500 mt-1 block">{errors.driver}</span>}
                                </div>
                            </div>
                        </div>

                        {/* Trip Details */}
                        <div className="space-y-6">
                            <div className="flex items-center gap-2 mb-2">
                                <div className="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center">
                                    <i className="bi bi-geo-alt text-[#D10000] text-lg"></i>
                                </div>
                                <h2 className="text-lg font-black text-gray-900">Trip Details</h2>
                            </div>

                            <div className="space-y-4">
                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Pickup Location</Label>
                                    <InputWrapper className={`bg-white ${errors.pickup ? 'border-red-500' : ''}`}>
                                        <Input
                                            placeholder="Enter pickup address"
                                            value={bookingInfo.pickup}
                                            onChange={(e) => setBookingInfo({ ...bookingInfo, pickup: e.target.value })}
                                            className="font-medium"
                                        />
                                    </InputWrapper>
                                    {errors.pickup && <span className="text-xs text-red-500 mt-1 block">{errors.pickup}</span>}
                                </div>

                                <div>
                                    <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Dropoff Location</Label>
                                    <InputWrapper className={`bg-white ${errors.dropoff ? 'border-red-500' : ''}`}>
                                        <Input
                                            placeholder="Enter dropoff address"
                                            value={bookingInfo.dropoff}
                                            onChange={(e) => setBookingInfo({ ...bookingInfo, dropoff: e.target.value })}
                                            className="font-medium"
                                        />
                                    </InputWrapper>
                                    {errors.dropoff && <span className="text-xs text-red-500 mt-1 block">{errors.dropoff}</span>}
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Payment & Stats */}
                    <div className="space-y-6">
                        <div className="flex items-center gap-2 mb-2">
                            <div className="w-8 h-8 rounded-full bg-red-50 flex items-center justify-center">
                                <i className="bi bi-currency-dollar text-[#D10000] text-lg"></i>
                            </div>
                            <h2 className="text-lg font-black text-gray-900">Payment & Stats</h2>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Estimated Fare ($)</Label>
                                <InputWrapper className={`bg-white ${errors.fare ? 'border-red-500' : ''}`}>
                                    <Input
                                        type="number"
                                        placeholder="0.00"
                                        value={bookingInfo.fare}
                                        onChange={(e) => setBookingInfo({ ...bookingInfo, fare: e.target.value })}
                                        className="font-medium"
                                    />
                                </InputWrapper>
                                {errors.fare && <span className="text-xs text-red-500 mt-1 block">{errors.fare}</span>}
                            </div>

                            <div>
                                <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Distance (km)</Label>
                                <InputWrapper className="bg-white">
                                    <Input
                                        placeholder="e.g. 5.2 km"
                                        value={bookingInfo.distance}
                                        onChange={(e) => setBookingInfo({ ...bookingInfo, distance: e.target.value })}
                                        className="font-medium"
                                    />
                                </InputWrapper>
                            </div>

                            <div>
                                <Label className="text-[14px] font-[700] text-[#4B5563] mb-2 normal-case tracking-normal">Duration (min)</Label>
                                <InputWrapper className="bg-white">
                                    <Input
                                        placeholder="e.g. 15 min"
                                        value={bookingInfo.duration}
                                        onChange={(e) => setBookingInfo({ ...bookingInfo, duration: e.target.value })}
                                        className="font-medium"
                                    />
                                </InputWrapper>
                            </div>
                        </div>
                    </div>

                    <div className="mt-4 flex justify-end pt-4">
                        <button
                            onClick={handleSubmit}
                            className="bg-[#D10000] hover:bg-[#b00000] text-white text-sm font-semibold px-12 py-3 rounded-xl transition-all shadow-[0_4px_14px_0_rgba(209,0,0,0.39)] flex items-center gap-2"
                        >
                            Create Booking
                        </button>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}
