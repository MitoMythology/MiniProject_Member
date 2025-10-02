<x-app-layout>
    <x-slot name="header">
        จัดการสมาชิก (Staff)
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tab Navigation -->
        <div class="mb-4">
            <div class="border-b border-stone-300">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="showTab('pending')" id="tab-pending" 
                        class="tab-button border-b-2 border-amber-600 py-4 px-1 text-sm font-medium text-amber-600">
                        รออนุมัติ
                        @if($pendingMembers->total() > 0)
                            <span class="ml-2 px-2 py-1 text-xs bg-red-500 text-white rounded-full">{{ $pendingMembers->total() }}</span>
                        @endif
                    </button>
                    <button onclick="showTab('all')" id="tab-all" 
                        class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-stone-500 hover:text-stone-700 hover:border-stone-300">
                        สมาชิกทั้งหมด
                    </button>
                </nav>
            </div>
        </div>

        <!-- Pending Members Tab -->
        <div id="content-pending" class="tab-content">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-stone-700 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">สมาชิกรออนุมัติ</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-stone-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">ชื่อ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">อีเมล</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">วันที่สมัคร</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-stone-500 uppercase">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-stone-200">
                            @forelse($pendingMembers as $member)
                                <tr class="hover:bg-stone-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-stone-900">{{ $member->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-stone-600">{{ $member->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                        {{ $member->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <form action="{{ route('staff.members.approve', $member) }}" method="POST" onsubmit="return confirm('อนุมัติสมาชิกนี้?');">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    อนุมัติ
                                                </button>
                                            </form>
                                            <form action="{{ route('staff.members.reject', $member) }}" method="POST" onsubmit="return confirm('ปฏิเสธสมาชิกนี้?');">
                                                @csrf
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    ปฏิเสธ
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-stone-500">
                                        ไม่มีสมาชิกรออนุมัติ
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-stone-50 px-6 py-4">
                    {{ $pendingMembers->links() }}
                </div>
            </div>
        </div>

        <!-- All Members Tab -->
        <div id="content-all" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-stone-700 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">สมาชิกทั้งหมด</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-stone-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">ชื่อ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">อีเมล</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">สถานะ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">วันที่สร้าง</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-stone-500 uppercase">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-stone-200">
                            @forelse($allMembers as $member)
                                <tr class="hover:bg-stone-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-stone-900">{{ $member->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-stone-600">{{ $member->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($member->status === 'approved') bg-green-100 text-green-800
                                            @elseif($member->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $member->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                        {{ $member->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('staff.members.edit', $member) }}" class="text-amber-600 hover:text-amber-900 transition">
                                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-stone-500">
                                        ไม่มีข้อมูลสมาชิก
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-stone-50 px-6 py-4">
                    {{ $allMembers->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(el => {
                el.classList.remove('border-amber-600', 'text-amber-600');
                el.classList.add('border-transparent', 'text-stone-500');
            });

            document.getElementById('content-' + tab).classList.remove('hidden');
            const button = document.getElementById('tab-' + tab);
            button.classList.remove('border-transparent', 'text-stone-500');
            button.classList.add('border-amber-600', 'text-amber-600');
        }
    </script>
</x-app-layout>