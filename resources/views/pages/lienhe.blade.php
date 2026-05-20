<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ - HKT TRAVEL</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Plus Jakarta Sans',sans-serif;
            background:
                linear-gradient(to bottom, rgba(239,248,255,.95), rgba(255,255,255,.97)),
                url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>

<body class="text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    {{-- ================= TOP BAR ================= --}}
    <div class="bg-[#dff6ff] text-sky-950 text-sm py-3 shadow-sm border-b border-sky-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">

            <div class="flex items-center gap-2 font-bold tracking-wide">
                🌊 Hotline:
                <span class="bg-sky-100 text-sky-800 px-2 py-0.5 rounded-lg border border-sky-200 font-extrabold tracking-widest">
                    1900 6868
                </span>
            </div>

            <div class="flex items-center gap-4 font-semibold text-sky-900/90">
                <a href="{{ route('pages.tintuc') }}" class="hover:text-sky-600 transition">
                    Tin tức
                </a>

                <span class="text-sky-300">•</span>

                <a href="{{ route('pages.gioithieu') }}" class="hover:text-sky-600 transition">
                    Giới thiệu
                </a>

                <span class="text-sky-300">•</span>

                <a href="{{ route('pages.lienhe') }}" class="text-sky-600">
                    Liên hệ
                </a>
            </div>
        </div>
    </div>

    {{-- ================= NAVBAR ================= --}}
    <nav class="bg-gradient-to-r from-cyan-100 via-sky-100 to-blue-100 shadow-md border-b border-sky-200 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between items-center h-20">

                <a href="/"
                   class="flex items-center bg-white/60 backdrop-blur-md px-5 py-2 rounded-2xl border border-white/60 shadow-sm">

                    <span class="text-2xl font-black tracking-wider text-sky-700 uppercase">
                        HKT
                    </span>

                    <span class="text-2xl font-black tracking-wider text-cyan-500 uppercase border-b-4 border-cyan-400 pb-0.5 ml-1">
                        TRAVEL
                    </span>
                </a>

                <a href="/"
                   class="text-sm font-bold text-sky-700 hover:text-cyan-500 transition flex items-center gap-1">
                    🏝️ Quay lại trang chủ
                </a>

            </div>
        </div>
    </nav>

    {{-- ================= MAIN ================= --}}
    <main class="max-w-7xl mx-auto px-4 py-12 flex-grow w-full space-y-10">

        {{-- TITLE --}}
        <div class="text-center space-y-3">
            <span class="inline-block bg-sky-100 text-sky-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-sky-200">
                Kết nối với chúng tôi
            </span>

            <h1 class="text-3xl md:text-5xl font-black text-slate-900 uppercase tracking-tight">
                📞 THÔNG TIN LIÊN HỆ HKT TRAVEL
            </h1>

            <p class="text-sm text-slate-600 italic max-w-2xl mx-auto">
                “Hành trình của khách hàng chính là động lực phát triển của HKT TRAVEL.”
            </p>

            <div class="w-24 h-1.5 bg-gradient-to-r from-cyan-400 via-sky-500 to-blue-600 mx-auto rounded-full"></div>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- TRỤ SỞ --}}
                <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                    <h2 class="text-lg font-black text-slate-900 mb-4">
                        🏢 Trụ sở chính
                    </h2>

                    <div class="space-y-2 text-sm text-slate-700">
                        <p class="font-bold text-sky-700">HKT TRAVEL Company</p>
                        <p>Tầng 5, Tòa nhà Phenikaa Tower, Nguyễn Trác, Hà Đông, Hà Nội</p>

                        <div class="pt-2">
                            <span class="font-bold">🌐 Website:</span>
                            <span class="text-blue-600">www.hkttravel.vn</span>
                        </div>
                    </div>
                </div>

                {{-- HOTLINE + EMAIL --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                        <h2 class="text-lg font-black text-slate-900 mb-4">
                            ☎️ Hotline hỗ trợ khách hàng
                        </h2>

                        <div class="space-y-2 text-sm text-slate-700">
                            <p>Hotline 24/7:
                                <span class="font-bold text-cyan-600">1900 6868</span>
                            </p>

                            <p>Tư vấn tour:
                                <span class="font-semibold">0988 123 456</span>
                            </p>

                            <p>Hỗ trợ đặt vé & thanh toán:
                                <span class="font-semibold">0977 888 999</span>
                            </p>
                        </div>
                    </div>

                    <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                        <h2 class="text-lg font-black text-slate-900 mb-4">
                            📧 Email liên hệ
                        </h2>

                        <div class="space-y-2 text-sm text-slate-700">
                            <p>Chăm sóc khách hàng:
                                <span class="text-blue-600 font-semibold">
                                    support@hkttravel.vn
                                </span>
                            </p>

                            <p>Hợp tác doanh nghiệp:
                                <span class="text-blue-600 font-semibold">
                                    partner@hkttravel.vn
                                </span>
                            </p>

                            <p>Tuyển dụng:
                                <span class="text-blue-600 font-semibold">
                                    hr@hkttravel.vn
                                </span>
                            </p>
                        </div>
                    </div>

                </div>

                {{-- THỜI GIAN --}}
                <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                    <h2 class="text-lg font-black text-slate-900 mb-4">
                        🕒 Thời gian làm việc
                    </h2>

                    <div class="space-y-2 text-sm text-slate-700">
                        <p>Thứ 2 – Thứ 6:
                            <span class="font-semibold">08:00 – 21:00</span>
                        </p>

                        <p>Thứ 7 – Chủ nhật:
                            <span class="font-semibold">08:00 – 22:00</span>
                        </p>

                        <p class="text-emerald-600 font-bold">
                            🟢 Hỗ trợ online: 24/7
                        </p>
                    </div>
                </div>

                {{-- CHI NHÁNH --}}
                <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                    <h2 class="text-lg font-black text-slate-900 mb-5">
                        🌍 Hệ thống chi nhánh
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div class="bg-sky-50 p-4 rounded-2xl border border-sky-100">
                            <div class="font-bold text-slate-800">📍 Hà Nội</div>
                            <p class="text-xs text-slate-500 mt-1">
                                Số 12 Trần Duy Hưng, Cầu Giấy, Hà Nội
                            </p>
                        </div>

                        <div class="bg-cyan-50 p-4 rounded-2xl border border-cyan-100">
                            <div class="font-bold text-slate-800">📍 TP. Hồ Chí Minh</div>
                            <p class="text-xs text-slate-500 mt-1">
                                145 Nguyễn Huệ, Quận 1, TP.HCM
                            </p>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100">
                            <div class="font-bold text-slate-800">📍 Đà Nẵng</div>
                            <p class="text-xs text-slate-500 mt-1">
                                22 Võ Nguyên Giáp, Sơn Trà, Đà Nẵng
                            </p>
                        </div>

                    </div>
                </div>

                {{-- DỊCH VỤ + THANH TOÁN --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="bg-gradient-to-br from-sky-700 to-cyan-700 text-white p-6 rounded-3xl shadow-xl">
                        <h2 class="font-black text-lg mb-4">
                            🚀 Dịch vụ hỗ trợ
                        </h2>

                        <ul class="space-y-2 text-sm text-sky-100 list-disc pl-5">
                            <li>Đặt tour du lịch trong nước & quốc tế</li>
                            <li>Đặt phòng khách sạn/resort</li>
                            <li>Thuê xe du lịch</li>
                            <li>Vé máy bay giá ưu đãi</li>
                            <li>Tour doanh nghiệp & team building</li>
                            <li>Hỗ trợ visa du lịch</li>
                        </ul>
                    </div>

                    <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                        <h2 class="font-black text-lg mb-4 text-slate-900">
                            💳 Hỗ trợ thanh toán
                        </h2>

                        <ul class="space-y-2 text-sm text-slate-700">
                            <li>✔️ Chuyển khoản ngân hàng</li>
                            <li>✔️ Ví điện tử Momo, ZaloPay</li>
                            <li>✔️ Thẻ Visa/MasterCard</li>
                            <li>✔️ Thanh toán trực tiếp tại văn phòng</li>
                        </ul>
                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-6">

                {{-- SOCIAL --}}
                <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                    <h2 class="font-black text-lg text-slate-900 mb-4">
                        📱 Kết nối mạng xã hội
                    </h2>

                    <div class="space-y-3 text-sm">

                        <div class="bg-sky-50 p-3 rounded-xl border border-sky-100">
                            Facebook: <span class="font-bold text-blue-600">HKT Travel Official</span>
                        </div>

                        <div class="bg-pink-50 p-3 rounded-xl border border-pink-100">
                            TikTok: <span class="font-bold text-pink-600">@hkttravel</span>
                        </div>

                        <div class="bg-purple-50 p-3 rounded-xl border border-purple-100">
                            Instagram: <span class="font-bold text-purple-600">@hkttravel.vn</span>
                        </div>

                        <div class="bg-red-50 p-3 rounded-xl border border-red-100">
                            YouTube: <span class="font-bold text-red-600">HKT Travel Channel</span>
                        </div>

                    </div>
                </div>

                {{-- PHƯƠNG CHÂM --}}
                <div class="bg-gradient-to-br from-cyan-600 to-blue-700 text-white p-6 rounded-3xl shadow-xl">
                    <h2 class="font-black text-lg mb-4">
                        💬 Phương châm hoạt động
                    </h2>

                    <p class="text-sm leading-relaxed text-blue-100 italic">
                        “Hành trình của khách hàng chính là động lực phát triển của HKT TRAVEL. Chúng tôi cam kết mang đến những trải nghiệm du lịch an toàn, chất lượng và đáng nhớ nhất cho mọi khách hàng.”
                    </p>
                </div>

                {{-- THÔNG TIN ĐỒ ÁN --}}
                <div class="bg-white/75 backdrop-blur-md p-6 rounded-3xl border border-white shadow-xl">
                    <h2 class="font-black text-lg text-slate-900 mb-4">
                        👨‍💻 Thông tin dự án học tập
                    </h2>

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Website HKT TRAVEL là sản phẩm bài tập lớn cuối kì môn Ứng dụng lập trình web du lịch của sinh viên ngành Du lịch – Trường Đại học Phenikaa.
                    </p>

                    <div class="mt-4 space-y-2 text-sm text-slate-700">
                        <div class="font-bold text-sky-700">Thành viên thực hiện:</div>

                        <ul class="space-y-1 list-disc pl-5">
                            <li>Trần Văn Khánh</li>
                            <li>Nguyễn Chí Thái</li>
                            <li>Hoàng Hướng Hậu</li>
                            <li>Hoàng Mạnh Hưng</li>
                        </ul>

                        <div class="pt-3">
                            <div class="font-bold text-sky-700">Giảng viên hướng dẫn:</div>

                            <p class="mt-1 text-sm">
                                Bộ môn Ứng dụng công nghệ trong du lịch – Đại học Phenikaa
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-r from-sky-950 via-cyan-950 to-blue-950 text-sky-200 py-6 text-center text-xs border-t border-sky-900">
        © 2026 HKT TRAVEL - SEA THEME VERSION 🌊
    </footer>

</body>
</html>