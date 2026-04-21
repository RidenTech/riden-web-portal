import React from 'react';

export default function Header({ title, isCollapsed }) {
    return (
        <div className={`fixed top-0 ${isCollapsed ? 'left-[60px]' : 'left-[260px]'} right-0 h-[72px] bg-white border-bottom border-[#f1f1f1] z-[1040] shadow-sm  transition-all duration-300`}>
            <div className="absolute top-[-10px] left-0 w-full h-full bg-[#D10000] clip-path-header pointer-events-none"></div>
            <div className="h-full flex items-center justify-between px-8 relative">
                <div className="flex items-center gap-3">
                    <div className="text-[28px] font-[600] text-[#111] leading-none">
                        {title || 'Dashboard'}
                    </div>
                </div>

                <div className="flex items-center gap-3">
                    <button type="button" className="w-[44px] h-[44px] rounded-full flex items-center justify-center text-[#D10000] text-lg hover:bg-black/5 transition-colors" aria-label="Notifications">
                        <i className="bi bi-bell"></i>
                    </button>

                    <img src="https://i.pravatar.cc/80?img=5" className="w-[36px] h-[36px] rounded-full object-cover border-2 border-white shadow-sm " alt="Avatar" />
                </div>
            </div>
        </div>
    );
}
