<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin Tức & Xu Hướng Du Lịch 2026 - HKT TRAVEL</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Plus Jakarta Sans',sans-serif;
            background:
                linear-gradient(to bottom, rgba(240,249,255,.95), rgba(224,242,254,.92)),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=1600&auto=format&fit=crop');
            background-size:cover;
            background-attachment:fixed;
        }
    </style>
</head>

<body class="text-slate-800 antialiased min-h-screen flex flex-col justify-between">

{{-- ================= TOP BAR ================= --}}
<div class="bg-gradient-to-r from-sky-200 via-cyan-100 to-blue-200 backdrop-blur-md text-sky-950 text-sm py-3 shadow-md border-b border-sky-300/60">

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
                <span class="text-sky-900 font-extrabold tracking-widest bg-white/80 px-2 py-0.5 rounded-md border border-sky-300">
                    19004518
                </span>
            </span>

        </div>

        {{-- Menu --}}
        <div class="flex items-center gap-4 font-semibold text-sky-900/90">

            <a href="{{ route('pages.tintuc') }}"
               class="bg-white/50 px-3 py-1 rounded-lg text-sky-700 shadow-sm">
                Tin tức
            </a>

            <span class="text-sky-400 text-[10px]">•</span>

            <a href="{{ route('pages.gioithieu') }}"
               class="hover:text-sky-700 hover:bg-white/40 px-3 py-1 rounded-lg transition-all">
                Giới thiệu
            </a>

            <span class="text-sky-400 text-[10px]">•</span>

            <a href="{{ route('pages.lienhe') }}"
               class="hover:text-sky-700 hover:bg-white/40 px-3 py-1 rounded-lg transition-all">
                Liên hệ
            </a>

        </div>

    </div>
</div>

{{-- ================= NAVBAR ================= --}}
<nav class="bg-gradient-to-r from-sky-500 via-cyan-500 to-blue-600 shadow-lg border-b border-cyan-300 sticky top-0 z-50 backdrop-blur-md">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-20 items-center">

            {{-- Logo --}}
            <div class="flex items-center bg-white/15 backdrop-blur-md px-5 py-2 rounded-2xl border border-white/20 shadow-md">

                <a href="/" class="text-2xl tracking-wider font-extrabold select-none flex items-center">

                    <span class="text-white uppercase font-black">
                        HKT
                    </span>

                    <span class="text-yellow-300 uppercase font-black border-b-4 border-yellow-300 pb-0.5 ml-1">
                        TRAVEL
                    </span>

                </a>

            </div>

            {{-- Button --}}
            <a href="/"
               class="bg-white text-sky-700 hover:bg-sky-50 text-sm font-black px-5 py-2.5 rounded-xl shadow-md transition-all transform hover:-translate-y-0.5 uppercase tracking-wider flex items-center gap-2">
                ⚡ Trang chủ
            </a>

        </div>

    </div>

</nav>

{{-- ================= CONTENT ================= --}}
<main class="max-w-6xl mx-auto px-4 py-12 flex-grow w-full space-y-10">

    {{-- Heading --}}
    <div class="text-center space-y-3">

        <span class="inline-block bg-white/70 backdrop-blur-md text-sky-700 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest shadow-sm border border-sky-200">
            Bản tin lữ hành 2026
        </span>

        <h1 class="text-3xl md:text-5xl font-black text-slate-900 uppercase tracking-tight">
            Tin Tức & Xu Hướng Du Lịch
        </h1>

        <p class="text-sky-700 font-semibold italic">
            Khám phá những chuyển động mới nhất của ngành du lịch hiện đại
        </p>

        <div class="w-28 h-1.5 bg-gradient-to-r from-sky-500 to-cyan-400 mx-auto rounded-full mt-2"></div>

    </div>

    {{-- Hero --}}
    <div class="bg-gradient-to-br from-sky-700 via-cyan-700 to-blue-800 rounded-[32px] p-8 md:p-10 text-white shadow-2xl grid grid-cols-1 md:grid-cols-3 gap-8 items-center relative overflow-hidden border border-white/10">

        <div class="absolute -right-10 -bottom-10 text-9xl opacity-10 select-none">
            🌊
        </div>

        <div class="md:col-span-2 space-y-4">

            <span class="inline-block bg-yellow-300 text-slate-900 text-[10px] font-extrabold px-3 py-1 rounded-md uppercase tracking-wider">
                Tin nổi bật châu Á
            </span>

            <h2 class="text-xl md:text-3xl font-black leading-tight">
                Sa Pa trở thành điểm đến được du khách quốc tế yêu thích nhất châu Á năm 2026
            </h2>

            <p class="text-sky-100 text-sm leading-relaxed text-justify">
                Theo công bố mới nhất từ Agoda, Sa Pa của Việt Nam đã xuất sắc dẫn đầu danh sách nhờ khí hậu mát mẻ, cảnh quan núi rừng hùng vĩ và bản sắc văn hóa dân tộc độc đáo. Đây được xem là bước tiến lớn của du lịch Việt Nam trong thời kỳ chuyển đổi số và phát triển du lịch xanh bền vững.
            </p>

            <div class="flex items-center gap-2 text-xs text-sky-200 font-semibold pt-2">
                <span>📰 Nguồn: TTXVN & VTV</span>
                <span>•</span>
                <span>Năm 2026</span>
            </div>

        </div>

        {{-- Right card --}}
        <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10 space-y-3 text-center">

            <div class="text-5xl">
                📈
            </div>

            <div class="text-xl font-extrabold text-yellow-300">
                Tăng Trưởng Kỷ Lục
            </div>

            <p class="text-xs text-sky-100 leading-relaxed">
                Việt Nam tiếp tục là điểm đến hấp dẫn nhất Đông Nam Á nhờ cảnh quan đa dạng và hệ thống dịch vụ trực tuyến thông minh.
            </p>

        </div>

    </div>

    {{-- NEWS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Card --}}
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-sky-100 flex gap-5 hover:shadow-2xl hover:-translate-y-1 transition duration-300">

            <div class="w-16 h-16 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center text-3xl shrink-0">
                🤖
            </div>

            <div class="space-y-2">

                <span class="inline-block bg-sky-100 text-sky-700 text-[9px] font-extrabold px-2 py-0.5 rounded uppercase tracking-wide">
                    Công nghệ du lịch
                </span>

                <h3 class="font-bold text-slate-800 text-base leading-snug hover:text-sky-600 cursor-pointer transition">
                    VITM 2026 thúc đẩy mạnh mẽ xu hướng chuyển đổi số ngành du lịch
                </h3>

                <p class="text-slate-500 text-xs leading-relaxed text-justify">
                    Các doanh nghiệp lữ hành đang đẩy mạnh ứng dụng AI, bản đồ du lịch thông minh, hệ thống đặt tour online và thanh toán không tiền mặt nhằm nâng cao trải nghiệm khách hàng.
                </p>

                <p class="text-[10px] text-slate-400 font-semibold pt-1">
                    📍 baochinhphu.vn
                </p>

            </div>

        </div>

        {{-- Card --}}
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-emerald-100 flex gap-5 hover:shadow-2xl hover:-translate-y-1 transition duration-300">

            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-3xl shrink-0">
                ✈️
            </div>

            <div class="space-y-2">

                <span class="inline-block bg-emerald-100 text-emerald-700 text-[9px] font-extrabold px-2 py-0.5 rounded uppercase tracking-wide">
                    Du lịch quốc tế
                </span>

                <h3 class="font-bold text-slate-800 text-base leading-snug hover:text-sky-600 cursor-pointer transition">
                    Hàn Quốc và Nhật Bản tiếp tục nới lỏng visa cho du khách Việt
                </h3>

                <p class="text-slate-500 text-xs leading-relaxed text-justify">
                    Chính sách mới giúp nhu cầu du lịch nước ngoài tăng trưởng mạnh, đặc biệt ở phân khúc giới trẻ và du lịch trải nghiệm cá nhân hóa.
                </p>

                <p class="text-[10px] text-slate-400 font-semibold pt-1">
                    📍 Tổng hợp diễn đàn
                </p>

            </div>

        </div>

        {{-- Card --}}
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-orange-100 flex gap-5 hover:shadow-2xl hover:-translate-y-1 transition duration-300">

            <div class="w-16 h-16 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center text-3xl shrink-0">
                ⚠️
            </div>

            <div class="space-y-2">

                <span class="inline-block bg-orange-100 text-orange-700 text-[9px] font-extrabold px-2 py-0.5 rounded uppercase tracking-wide">
                    Góc nhìn chuyên gia
                </span>

                <h3 class="font-bold text-slate-800 text-base leading-snug hover:text-sky-600 cursor-pointer transition">
                    Du lịch Việt Nam cần nâng cấp mạnh về hạ tầng và chất lượng dịch vụ
                </h3>

                <p class="text-slate-500 text-xs leading-relaxed text-justify">
                    Chuyên gia cho rằng ngành du lịch cần cải thiện tính liên kết điểm đến, nâng cấp giao thông và đào tạo nhân lực chuyên nghiệp để cạnh tranh khu vực.
                </p>

                <p class="text-[10px] text-slate-400 font-semibold pt-1">
                    📍 Phân tích thị trường
                </p>

            </div>

        </div>

        {{-- Card --}}
        <div class="bg-white/80 backdrop-blur-md p-6 rounded-3xl shadow-lg border border-purple-100 flex gap-5 hover:shadow-2xl hover:-translate-y-1 transition duration-300">

            <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center text-3xl shrink-0">
                🔮
            </div>

            <div class="space-y-2">

                <span class="inline-block bg-purple-100 text-purple-700 text-[9px] font-extrabold px-2 py-0.5 rounded uppercase tracking-wide">
                    Dự báo xu hướng
                </span>

                <h3 class="font-bold text-slate-800 text-base leading-snug hover:text-sky-600 cursor-pointer transition">
                    Du lịch xanh và cá nhân hóa tiếp tục bùng nổ năm 2026
                </h3>

                <p class="text-slate-500 text-xs leading-relaxed text-justify">
                    Nghỉ dưỡng cao cấp, du lịch sinh thái và trải nghiệm văn hóa địa phương đang trở thành xu hướng được giới trẻ đặc biệt yêu thích.
                </p>

                <p class="text-[10px] text-slate-400 font-semibold pt-1">
                    📍 VTV Digital
                </p>

            </div>

        </div>

    </div>

</main>

{{-- ================= FOOTER ================= --}}
<footer class="bg-gradient-to-r from-sky-950 via-cyan-950 to-blue-950 text-sky-200 py-6 text-center text-xs border-t border-white/10 mt-10">

    © 2026 HKT TRAVEL — SEA THEME EDITION • PHENIKAA UNIVERSITY

</footer>

</body>
</html>