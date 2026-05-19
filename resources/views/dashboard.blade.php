<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-blue-900 tracking-wide uppercase">
            {{ __('Lịch sử đặt Tour / Khách sạn của bạn') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-2xl p-6 border border-gray-100">
                
                <h3 class="text-xl font-extrabold mb-6 text-gray-800 border-b pb-3 flex items-center gap-2">
                    🗺️ Danh sách dịch vụ đã đặt
                </h3>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 text-center font-bold shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 text-center font-bold shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto rounded-xl border border-gray-200">
                    <table class="w-full text-left text-gray-600 border-collapse bg-white">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-bold text-center">Mã đơn</th>
                                <th class="px-6 py-4 font-bold">Tên dịch vụ</th>
                                <th class="px-6 py-4 font-bold text-center">Số lượng</th>
                                <th class="px-6 py-4 font-bold text-center">Ngày sử dụng</th>
                                <th class="px-6 py-4 font-bold">Tổng thanh toán</th>
                                <th class="px-6 py-4 font-bold text-center">Ghi chú</th>
                                <th class="px-6 py-4 font-bold text-center">Ngày mua đơn</th>
                                <th class="px-6 py-4 font-bold text-center">Trạng thái đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($orders as $order)
                                <tr class="bg-white hover:bg-blue-50/50 transition-colors duration-150">
                                    <td class="px-6 py-4 text-center font-bold text-gray-400">#{{ $order->id }}</td>
                                    
                                    <td class="px-6 py-4 font-bold text-gray-900 max-w-[250px]">
                                        {{ $order->service->title ?? 'Dịch vụ không tồn tại hoặc đã xóa' }}
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center font-bold text-gray-700">{{ $order->quantity }}</td>
                                    
                                    <td class="px-6 py-4 text-center font-semibold text-slate-600">
                                        {{ $order->booking_date ? \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') : '---' }}
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="font-black text-red-600 text-base">
                                            {{ number_format($order->total_price) }} đ
                                        </div>
                                        
                                        <div class="mt-2">
                                            @if(!$order->payment_proof)
                                                <button onclick="openPaymentModal('{{ $order->id }}')" class="inline-flex items-center gap-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-black text-[11px] font-bold px-2.5 py-1.5 rounded-lg shadow-sm transition transform active:scale-95 whitespace-nowrap cursor-pointer">
                                                    📲 Quét QR / Gửi Bill
                                                </button>

                                                <div id="payment-modal-{{ $order->id }}" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm p-4 text-center overflow-y-auto">
                                                    
                                                    <span class="inline-block h-screen align-middle" aria-hidden="true">&#8203;</span>
                                                    
                                                    <div class="inline-block w-full max-w-[320px] p-5 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl border border-gray-100">
                                                        
                                                        <h4 class="text-center text-xs font-black text-blue-700 uppercase tracking-wider mb-3 border-b pb-2">
                                                            Thanh toán đơn hàng #{{ $order->id }}
                                                        </h4>

                                                        @php
                                                            $BANK_ID = 'MB'; 
                                                            $ACCOUNT_NO = '1520327735200'; 
                                                            $ACCOUNT_NAME = 'TRAN VAN KHANH'; 
                                                            
                                                            $AMOUNT = $order->total_price;
                                                            $ORDER_INFO = 'HKT TRAVEL Thanh toan don hang ' . $order->id;
                                                        @endphp

                                                        <div class="bg-gray-50 p-2 rounded-xl border border-gray-100 mb-3 flex justify-center">
                                                            <img src="https://img.vietqr.io/image/{{ $BANK_ID }}-{{ $ACCOUNT_NO }}-compact.png?amount={{ $AMOUNT }}&addInfo={{ urlencode($ORDER_INFO) }}&accountName={{ urlencode($ACCOUNT_NAME) }}" 
                                                                 alt="VietQR" class="w-48 h-48 object-contain bg-white p-1 rounded-md shadow-inner">
                                                        </div>

                                                        <div class="text-[11px] text-gray-700 mb-3 space-y-0.5 bg-blue-50/60 p-2.5 rounded-xl border border-blue-100/30 font-medium">
                                                            <p>🏦 Ngân hàng: <strong class="text-gray-900">{{ $BANK_ID }}</strong></p>
                                                            <p>👤 Số TK: <strong class="text-gray-900">{{ $ACCOUNT_NO }}</strong></p>
                                                            <p>💰 Số tiền: <strong class="text-red-600 font-extrabold text-xs">{{ number_format($AMOUNT) }} đ</strong></p>
                                                        </div>

                                                        <form action="{{ route('orders.uploadProof', $order->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                                            @csrf
                                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider">
                                                                📸 Đính kèm ảnh hóa đơn:
                                                            </label>
                                                            <input type="file" name="payment_proof" accept="image/*" required 
                                                                   class="w-full text-[11px] text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[11px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-gray-200 rounded-lg p-1 bg-gray-50">
                                                            
                                                            <div class="flex gap-2 pt-1">
                                                                <button type="button" onclick="closePaymentModal('{{ $order->id }}')" class="w-1/2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold py-2 px-3 rounded-xl transition">
                                                                    Đóng
                                                                </button>
                                                                <button type="submit" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2 px-3 rounded-xl shadow-md transition">
                                                                    Gửi hóa đơn
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>

                                            @elseif($order->payment_proof)
                                                <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="inline-flex items-center gap-0.5 text-xs font-bold text-emerald-600 hover:text-emerald-700 underline mt-1">
                                                    👁️ Xem hóa đơn đã gửi
                                                </a>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-center text-xs italic text-gray-400 max-w-[150px] truncate" title="{{ $order->note }}">
                                        {{ $order->note ?? 'Không có' }}
                                    </td>

                                    <td class="px-6 py-4 text-center text-sm text-gray-500 font-medium">
                                        {{ $order->created_at->format('d/m/Y') }} <br>
                                        <span class="text-xs text-gray-400 font-normal">{{ $order->created_at->format('H:i') }}</span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if($order->status === 'pending')
                                            <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-1 rounded-full border border-yellow-200 whitespace-nowrap">
                                                ⏳ Chờ đối tác duyệt
                                            </span>
                                        @elseif($order->status === 'confirmed' || $order->status === 'accepted' || $order->status === 'approved')
                                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-bold px-2.5 py-1 rounded-full border border-blue-200 whitespace-nowrap">
                                                ✅ Đã xác nhận
                                            </span>
                                        @elseif($order->status === 'completed')
                                            <span class="inline-block bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full border border-green-200 whitespace-nowrap">
                                                🎉 Hoàn thành
                                            </span>
                                        @else
                                            <span class="inline-block bg-red-100 text-red-800 text-xs font-bold px-2.5 py-1 rounded-full border border-red-200 whitespace-nowrap">
                                                ❌ Đã bị hủy bỏ
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-gray-400 font-medium">
                                        Bạn chưa thực hiện đơn đặt lịch nào. Quay lại <a href="/" class="text-blue-500 hover:underline font-bold">Trang chủ</a> để khám phá ngay!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script>
        function openPaymentModal(orderId) {
            const modal = document.getElementById('payment-modal-' + orderId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('block'); 
            }
        }

        function closePaymentModal(orderId) {
            const modal = document.getElementById('payment-modal-' + orderId);
            if (modal) {
                modal.classList.remove('block');
                modal.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>