<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu - HKT TRAVEL</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Plus Jakarta Sans',sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-100 text-slate-800 antialiased min-h-screen flex flex-col justify-between">

{{-- ================= TOP BAR XANH BIỂN ================= --}}
<div class="bg-[#bae6fd] text-sky-950 text-sm py-3 shadow-sm border-b border-sky-300/60">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between items-center gap-2">

        {{-- Hotline --}}
        <div class="flex items-center gap-2 font-bold tracking-wide">

            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 fill="currentColor"
                 class="w-4 h-4 text-sky-700 animate-pulse">

                <path fill-rule="evenodd"
                      d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                      clip-rule="evenodd"/>
            </svg>

            <span>
                Hotline:
                <span class="text-sky-900 font-extrabold tracking-widest bg-white/70 px-2 py-0.5 rounded-md border border-sky-300">
                    19004518
                </span>
            </span>

        </div>

        {{-- MENU --}}
        <div class="flex items-center gap-4 font-semibold text-sky-900/90">

            <a href="{{ route('pages.tintuc') }}"
               class="hover:text-sky-600 hover:bg-white/40 px-2 py-1 rounded-md transition-all duration-200">
                Tin tức
            </a>

            <span class="text-sky-400 text-[10px]">•</span>

            <a href="{{ route('pages.gioithieu') }}"
               class="text-sky-700 bg-white/50 px-2 py-1 rounded-md">
                Giới thiệu
            </a>

            <span class="text-sky-400 text-[10px]">•</span>

            <a href="{{ route('pages.lienhe') }}"
               class="hover:text-sky-600 hover:bg-white/40 px-2 py-1 rounded-md transition-all duration-200">
                Liên hệ
            </a>

        </div>

    </div>

</div>


{{-- ================= NAVBAR BIỂN ĐỒNG BỘ ================= --}}
<nav class="bg-gradient-to-r from-cyan-400 via-sky-400 to-blue-500 shadow-lg border-b border-cyan-300 sticky top-0 z-50 py-1">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-20 items-center">

            {{-- LOGO --}}
            <div class="flex items-center bg-white/20 backdrop-blur-md px-4 py-2 rounded-2xl border border-white/20 shadow-md">

                <a href="/" class="text-2xl tracking-wider font-extrabold select-none flex items-center">

                    <span class="text-white uppercase font-black drop-shadow">
                        HKT
                    </span>

                    <span class="text-yellow-200 uppercase font-black border-b-4 border-yellow-200 pb-0.5 ml-1 drop-shadow">
                        TRAVEL
                    </span>

                </a>

            </div>

            {{-- BUTTON HOME --}}
            <a href="/"
               class="bg-white text-sky-700 hover:bg-sky-50 text-sm font-black px-5 py-2.5 rounded-xl shadow-md transition-all duration-300 hover:-translate-y-1 uppercase tracking-wider flex items-center gap-2">

                ⚡ Trang chủ

            </a>

        </div>

    </div>

</nav>

{{-- ================= MAIN ================= --}}
<main class="max-w-5xl mx-auto px-4 py-12 flex-grow w-full space-y-12">

    {{-- HEADER --}}
    <div class="text-center space-y-3">

        <span class="inline-block bg-cyan-100 text-cyan-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">
            Đồ án cuối kỳ
        </span>

        <h1 class="text-3xl md:text-5xl font-black text-sky-950 uppercase tracking-tight">
            Hệ Thống Du Lịch Thông Minh HKT TRAVEL
        </h1>

        <p class="text-lg text-orange-500 font-extrabold italic tracking-wide">
            “Explore the World”
        </p>

        <div class="w-28 h-1.5 bg-gradient-to-r from-cyan-500 via-sky-500 to-blue-600 mx-auto rounded-full mt-2"></div>

    </div>

    {{-- ABOUT --}}
    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-8 md:p-10 shadow-xl border border-sky-100 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

        <div class="space-y-4">

            <h2 class="text-xl font-extrabold text-sky-900 border-l-4 border-cyan-500 pl-3">
                Về HKT TRAVEL
            </h2>

            <p class="text-slate-600 leading-relaxed text-sm text-justify">
                HKT TRAVEL là một nền tảng du lịch trực tuyến được xây dựng với mong muốn mang đến cho người dùng những trải nghiệm đặt tour du lịch hiện đại, tiện lợi và nhanh chóng trong thời đại công nghệ số. Dự án được phát triển như một mô hình hệ thống quản lý và kinh doanh dịch vụ du lịch trực tuyến, nơi khách hàng có thể dễ dàng tìm kiếm, tham khảo và đặt các tour du lịch nổi bật trên khắp Việt Nam chỉ với vài thao tác đơn giản.
            </p>

            <p class="text-slate-600 leading-relaxed text-sm text-justify">
                Với giao diện thân thiện, hiện đại cùng nhiều tính năng tiện ích, HKT TRAVEL hướng đến việc trở thành một hệ thống hỗ trợ du lịch thông minh, đáp ứng nhu cầu khám phá ngày càng cao của giới trẻ hiện nay.
            </p>

        </div>

        {{-- RIGHT BOX --}}
        <div class="bg-gradient-to-br from-cyan-500 via-sky-500 to-blue-600 text-white p-8 rounded-2xl space-y-4 shadow-xl relative overflow-hidden">

            <div class="absolute -right-6 -bottom-6 text-8xl opacity-10">
                🌊
            </div>

            <div class="text-xs font-bold text-cyan-100 uppercase tracking-widest">
                Nền tảng cốt lõi
            </div>

            <div class="text-lg font-bold">
                Tối ưu trải nghiệm đặt dịch vụ trên mọi thiết bị
            </div>

            <p class="text-cyan-50 text-xs leading-relaxed">
                Người dùng có thể dễ dàng trải nghiệm website trên máy tính, máy tính bảng hoặc điện thoại di động mà vẫn đảm bảo sự thuận tiện và mượt mà trong quá trình sử dụng. Hệ thống tích hợp lịch trình tour chi tiết, hình ảnh trực quan, thông tin khách sạn lưu trú và các chương trình ưu đãi hấp dẫn.
            </p>

            <div class="flex gap-3 text-xs font-bold text-cyan-100 pt-2">
                <span>💻 Desktop</span>
                <span>•</span>
                <span>📱 Mobile</span>
                <span>•</span>
                <span>📟 Tablet</span>
            </div>

        </div>

    </div>

    {{-- TEAM --}}
    <div class="bg-white/80 backdrop-blur-md rounded-3xl p-8 md:p-10 shadow-xl border border-sky-100 space-y-6">

        <div class="text-center md:text-left">

            <h2 class="text-xl font-extrabold text-sky-900 border-l-4 border-orange-500 pl-3">
                Đội Ngũ Phát Triển Dự Án
            </h2>

            <p class="text-slate-500 text-xs mt-1">
                Dự án được thực hiện trong khuôn khổ bài cuối kì môn Ứng dụng lập trình web du lịch - Đại học Phenikaa
            </p>

        </div>

        <p class="text-slate-600 text-sm leading-relaxed text-justify">
            HKT TRAVEL không chỉ đơn thuần là một website đặt tour mà còn là một sản phẩm thể hiện sự sáng tạo, tinh thần học hỏi và khả năng ứng dụng kiến thức công nghệ thông tin vào lĩnh vực du lịch của nhóm sinh viên trường <strong>Đại học Phenikaa</strong>.
        </p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4">

            {{-- MEMBER --}}
            <div class="bg-gradient-to-br from-white to-cyan-50 p-5 rounded-2xl border border-cyan-100 text-center space-y-2 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-lg mx-auto">
                    K
                </div>

                <div class="font-bold text-slate-800 text-sm">
                    Trần Văn Khánh
                </div>

                <div class="text-[10px] text-slate-400 uppercase font-bold">
                    Developer
                </div>

            </div>

            <div class="bg-gradient-to-br from-white to-cyan-50 p-5 rounded-2xl border border-cyan-100 text-center space-y-2 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center font-bold text-lg mx-auto">
                    T
                </div>

                <div class="font-bold text-slate-800 text-sm">
                    Nguyễn Chí Thái
                </div>

                <div class="text-[10px] text-slate-400 uppercase font-bold">
                    Developer
                </div>

            </div>

            <div class="bg-gradient-to-br from-white to-cyan-50 p-5 rounded-2xl border border-cyan-100 text-center space-y-2 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center font-bold text-lg mx-auto">
                    H
                </div>

                <div class="font-bold text-slate-800 text-sm">
                    Hoàng Hướng Hậu
                </div>

                <div class="text-[10px] text-slate-400 uppercase font-bold">
                    Developer
                </div>

            </div>

            <div class="bg-gradient-to-br from-white to-cyan-50 p-5 rounded-2xl border border-cyan-100 text-center space-y-2 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

                <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center font-bold text-lg mx-auto">
                    H
                </div>

                <div class="font-bold text-slate-800 text-sm">
                    Hoàng Mạnh Hưng
                </div>

                <div class="text-[10px] text-slate-400 uppercase font-bold">
                    Developer
                </div>

            </div>

        </div>

    </div>

    {{-- FEATURES --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-sky-100 space-y-3 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

            <div class="text-3xl">
                ⚙️
            </div>

            <h3 class="font-bold text-slate-800 text-base">
                Laravel & MySQL
            </h3>

            <p class="text-slate-500 text-xs leading-relaxed text-justify">
                Được phát triển bằng framework Laravel kết hợp với cơ sở dữ liệu MySQL nhằm đảm bảo khả năng xử lý dữ liệu nhanh chóng, bảo mật và ổn định.
            </p>

        </div>

        <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-sky-100 space-y-3 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

            <div class="text-3xl">
                🔐
            </div>

            <h3 class="font-bold text-slate-800 text-base">
                Phân Quyền Đa Dạng
            </h3>

            <p class="text-slate-500 text-xs leading-relaxed text-justify">
                Hệ thống cho phép người dùng đăng ký, đăng nhập, tìm kiếm tour, đặt tour trực tuyến và theo dõi lịch sử dịch vụ.
            </p>

        </div>

        <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-sky-100 space-y-3 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">

            <div class="text-3xl">
                🎒
            </div>

            <h3 class="font-bold text-slate-800 text-base">
                Đa Dạng Trải Nghiệm
            </h3>

            <p class="text-slate-500 text-xs leading-relaxed text-justify">
                Các dịch vụ trải dài từ nghỉ dưỡng, khám phá thiên nhiên đến trải nghiệm văn hóa địa phương phù hợp nhiều đối tượng.
            </p>

        </div>

    </div>

    {{-- FUTURE --}}
    <div class="bg-gradient-to-r from-cyan-100 via-sky-100 to-blue-100 rounded-3xl p-8 md:p-10 border border-cyan-200 space-y-4 text-center max-w-3xl mx-auto shadow-lg">

        <div class="text-2xl">
            🚀 Định Hướng Phát Triển Tương Lai
        </div>

        <p class="text-slate-600 text-sm leading-relaxed text-justify md:text-center">
            Trong tương lai, nhóm mong muốn tiếp tục phát triển HKT TRAVEL với nhiều tính năng nâng cao hơn như tích hợp thanh toán trực tuyến, chatbot hỗ trợ khách hàng, hệ thống đánh giá tour bằng AI và bản đồ du lịch thông minh.
        </p>

    </div>

</main>

{{-- FOOTER --}}
<footer class="bg-gradient-to-r from-sky-950 via-cyan-950 to-blue-950 text-sky-100 py-6 text-center text-xs border-t border-cyan-900 shadow-inner">

    © 2026 HKT TRAVEL - ĐỒ ÁN TỐT NGHIỆP LẬP TRÌNH WEB PHENIKAA UNIVERSITY.

</footer>

</body>
</html>