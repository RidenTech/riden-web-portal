import React from 'react';
import DatePicker from 'react-datepicker';
import 'react-datepicker/dist/react-datepicker.css';

export const Table = ({ headers, children, headerBg = 'bg-[#FFEEEE]' }) => (
    <div className="overflow-x-auto rounded-[30px] border border-[#E5E7EB] shadow-riden">
        <table className="w-full text-left border-collapse">
            <thead>
                <tr className={`${headerBg}`}>
                    {headers.map((header, i) => (
                        <th key={i} className={`py-[22px] px-[30px] text-sm font-[800] text-[#222] capitalize`}>
                            {header}
                        </th>
                    ))}
                </tr>
            </thead>
            <tbody className="divide-y divide-[#F3F4F6]">
                {children}
            </tbody>
        </table>
    </div>
);

export const Badge = ({ children, variant = 'info' }) => {
    const variants = {
        online: 'bg-[#D1F8D3] text-[#065F46]',
        offline: 'bg-[#FFE4E6] text-[#9F1239]',
        blocked: 'bg-[#FEE2E2] text-[#991B1B]',
        suspended: 'bg-[#FEF3C7] text-[#92400E]',
        success: 'bg-[#D1F8D3] text-[#065F46]',
        danger: 'bg-[#FFE4E6] text-[#9F1239]',
        warning: 'bg-[#FFFBEB] text-[#92400E]',
        info: 'bg-[#EFF6FF] text-[#1E40AF]',
    };
    return (
        <span className={`px-[20px] py-[6px] rounded-[30px] text-[12px] font-[800] inline-flex items-center justify-center ${variants[variant] || variants.info}`}>
            {children}
        </span>
    );
};

export const Button = ({ children, variant = 'primary', className = '', ...props }) => {
    const variants = {
        primary: 'bg-[#D10000] text-white hover:bg-[#A30000] shadow-[0_4px_12px_rgba(209,0,0,0.1)]',
        secondary: 'bg-[#4B49AC] text-white hover:bg-[#3f3e91]',
        outline: 'border-2 border-[#D10000] bg-white text-[#111] hover:bg-[#F9FAFB]',
        dark: 'border-2 border-[#111] bg-white text-[#111] hover:bg-[#111] hover:text-white',
        pill: 'bg-[#D10000] text-white hover:bg-[#A30000] rounded-full px-8 py-3 shadow-lg',
    };
    return (
        <button
            className={`px-[24px] py-[10px] rounded-[12px] font-[800] text-[13px] transition-all duration-300 flex items-center justify-center gap-[10px] uppercase  tracking-wider ${variants[variant] || variants.primary} ${className}`}
            {...props}
        >
            {children}
        </button>
    );
};

export const Label = ({ children, className = '' }) => (
    <label className={`block text-[13px] font-[800] text-[#111] mb-[10px] uppercase tracking-[0.5px] ${className}`}>
        {children}
    </label>
);

export const InputWrapper = ({ icon, children, className = '', style = {} }) => (
    <div
        className={`relative flex items-center bg-[#fdfdfd] border-[1.5px] border-[#E5E7EB] rounded-[14px] px-[18px] py-[14px] focus-within:border-[#D10000] focus-within:ring-[5px] focus-within:ring-[#e13437]/10 transition-all duration-200 ${className}`}
        style={style}
    >
        {icon && <i className={`${icon} text-[#999] mr-[15px] text-[18px]`}></i>}
        {children}
    </div>
);

export const Input = ({ className = '', ...props }) => (
    <input
        className={`bg-transparent border-none outline-none text-[14px] font-[600] w-full text-[#111] placeholder-[#999] p-0 ${className}`}
        {...props}
    />
);

export const Select = ({ children, className = '', ...props }) => (
    <select
        className={`bg-transparent border-none outline-none text-[14px] font-[600] w-full text-[#111] appearance-none p-0 cursor-pointer ${className}`}
        {...props}
    >
        {children}
    </select >
);

export const PageContainer = ({ children, className = '' }) => (
    <div className={`max-w-[1600px] mx-auto ${className}`}>
        {children}
    </div>
);

export const SearchBar = ({ placeholder = 'Search...', className = '', ...props }) => (
    <div className={`relative flex items-center group ${className}`}>
        <div className="absolute left-1.5 w-10 h-10 bg-white shadow-[0_2px_10px_rgba(0,0,0,0.06)] rounded-full flex items-center justify-center z-10 transition-transform group-focus-within:scale-[0.98]">
            <i className="bi bi-search text-[#D10000] text-[18px]"></i>
        </div>
        <input
            type="text"
            placeholder={placeholder}
            className="w-full pl-14 pr-4 py-[14px] bg-[#EEEEEE] border-none rounded-full text-[14px] font-[600] text-[#111] placeholder-[#999] focus:outline-none focus:ring-2 focus:ring-[#D10000]/10 transition-all duration-200"
            {...props}
        />
    </div>
);

export const MiniChart = ({ variant = 'green', data = [30, 50, 40, 75, 100, 60, 25] }) => {
    const colors = {
        green: 'bg-[#10B981]',
        yellow: 'bg-[#FBBF24]',
    };
    return (
        <div className="flex items-end gap-2 h-[80px]">
            {data.map((h, i) => (
                <div
                    key={i}
                    className={`w-[14px] rounded-full ${colors[variant] || colors.green}`}
                    style={{ height: `${h}%` }}
                ></div>
            ))}
        </div>
    );
};

export const Tabs = ({ options, activeTab, onTabChange, className = '' }) => (
    <div className={`flex justify-between items-center  mb-4 ${className}`}>
        {options.map((opt) => (
            <button
                key={opt.id}
                onClick={() => onTabChange(opt.id)
                }
                className={`px-10 w-full  py-4 text-lg font-[700] transition-all duration-300  ${activeTab === opt.id
                    ? 'bg-[#D10000] text-white rounded-full'
                    : 'border-b-2 border-[#ECF0F1] text-[#111] hover:text-[#D10000]'
                    }`}
            >
                {opt.label || opt.id}
                {opt.count !== undefined && (
                    <span className="text-sm ">
                        ({opt.count})
                    </span>
                )}
            </button>
        ))}
    </div>
);

export const PillTabs = ({ options, activeTab, onTabChange, className = '' }) => (
    <div className={`bg-[#D10000] rounded-full p-1.5 flex w-fit ${className}`}>
        {options.map((tab) => (
            <button
                key={tab.id}
                onClick={() => onTabChange(tab.id)}
                className={`px-8 py-3 rounded-full text-[15px] font-[700] transition-all duration-300 ${activeTab === tab.id
                    ? 'bg-white text-[#D10000] shadow-md'
                    : 'text-white hover:bg-white/10'
                    }`}
            >
                {tab.label}
            </button>
        ))}
    </div>
);

export const PeriodFilter = ({ value, onChange, className = '' }) => (
    <div className={`relative group ${className}`}>
        <select
            value={value}
            onChange={onChange}
            className="pl-5 pr-15 py-2.5 bg-white border-[1.5px] border-[#666]/20 rounded-full text-[14px] font-[600] text-[#111] appearance-none outline-none focus:border-[#D10000] cursor-pointer shadow-sm"
        >
            <option>Today</option>
            <option>This Week</option>
            <option>This Month</option>
            <option>This Year</option>
        </select>
        <i className="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-[#D10000] text-[12px] pointer-events-none"></i>
    </div>
);

export const DateRangePicker = ({ startDate, endDate, onStartDateChange, onEndDateChange, className = '' }) => (
    <div className={`flex items-center gap-2 ${className}`}>
        <div className="flex gap-2">
            <div className="relative border border-[#D10000] w-[180px] rounded-full">
                <div className="absolute left-1 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-[#D10000] flex items-center justify-center text-white z-10">
                    <i className="bi bi-calendar-check text-[14px]"></i>
                </div>
                <DatePicker
                    selected={startDate}
                    onChange={onStartDateChange}
                    placeholderText="From"
                    maxDate={new Date()}
                    className="pl-11 pr-4 py-2.5 bg-white text-[14px] font-[600] w-full outline-none transition-all rounded-full"
                />
            </div>
            <div className="relative border border-[#D10000] w-[180px] rounded-full">
                <div className="absolute left-1 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-[#D10000] flex items-center justify-center text-white z-10">
                    <i className="bi bi-calendar-check text-[14px]"></i>
                </div>
                <DatePicker
                    selected={endDate}
                    onChange={onEndDateChange}
                    placeholderText="To"
                    maxDate={new Date()}
                    className="pl-11 pr-4 py-2.5 bg-white text-[14px] font-[600] w-full outline-none transition-all rounded-full"
                />
            </div>
        </div>
    </div>
);

export const DatePickerStyles = () => (
    <style dangerouslySetInnerHTML={{
        __html: `
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
);

export const Pagination = ({ totalItems, itemsPerPage = 10, currentPage = 1, onPageChange }) => {
    if (!totalItems || totalItems <= itemsPerPage) return null;

    return (
        <div className="flex justify-end items-center gap-2 mt-6 list-none">
            <button className="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-[#f1f1f1] text-[#111] text-lg hover:bg-[#D10000] hover:text-white transition-all">
                <i className="bi bi-chevron-left"></i>
            </button>
            <button className="w-[34px] h-[34px] flex items-center justify-center rounded-full border border-riden-red text-riden-red font-[800] text-[13px] bg-white ring-2 ring-riden-red/20">
                1
            </button>
            <button className="w-[34px] h-[34px] flex items-center justify-center rounded-full border border-gray-100 text-[#374151] font-[600] text-[13px] hover:bg-[#D10000] hover:text-white transition-all">
                2
            </button>
            <button className="w-[34px] h-[34px] flex items-center justify-center rounded-full bg-[#D10000] text-white text-lg shadow-lg shadow-red-100 ring-2 ring-riden-red/20">
                <i className="bi bi-chevron-right"></i>
            </button>
        </div>
    );
};

export const DeleteModal = ({ isOpen, onClose, onConfirm, title = "Are you sure?", itemName = "" }) => {
    if (!isOpen) return null;
    return (
        <div className="fixed inset-0 z-[2000] flex items-center justify-center p-4">
            <div className="absolute inset-0 bg-black/40 backdrop-blur-sm animate-fade-in" onClick={onClose}></div>
            <div className="bg-white rounded-[30px] p-8 w-full max-w-md relative z-10 shadow-2xl animate-scale-up text-center border border-gray-100">
                <div className="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-red-100">
                    <i className="bi bi-trash3-fill text-[#D10000] text-[32px]"></i>
                </div>
                <h3 className="text-[22px] font-[800] text-[#111] mb-2 tracking-tight">{title}</h3>
                <p className="text-[14px] font-[600] text-[#6B7280] mb-8 leading-relaxed">
                    Once you delete <span className="text-[#111] font-[800]">{itemName || "this item"}</span>, it cannot be undone. Are you certain?
                </p>
                <div className="flex flex-col gap-3">
                    <button
                        onClick={onConfirm}
                        className="w-full py-4 bg-[#D10000] text-white rounded-full font-[800] text-[15px] uppercase tracking-wider hover:bg-[#A30000] transition-all shadow-lg shadow-red-100"
                    >
                        Yes, Delete it
                    </button>
                    <button
                        onClick={onClose}
                        className="w-full py-4 bg-white text-[#4B5563] border-none rounded-full font-[800] text-[15px] uppercase tracking-wider hover:bg-gray-50 transition-all font-black"
                    >
                        No, Keep it
                    </button>
                </div>
            </div>
            <style dangerouslySetInnerHTML={{
                __html: `
                @keyframes fade-in { from { opacity: 0; } to { opacity: 1; } }
                @keyframes scale-up { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
                .animate-fade-in { animation: fade-in 0.3s ease-out; }
                .animate-scale-up { animation: scale-up 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); }
            ` }} />
        </div>
    );
};
