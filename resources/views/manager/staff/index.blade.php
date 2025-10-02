<x-app-layout>
    <x-slot name="header">
        จัดการ Staff (Manager)
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tab Navigation -->
        <div class="mb-4">
            <div class="border-b border-stone-300">
                <nav class="-mb-px flex space-x-8">
                    <button onclick="showTab('staff')" id="tab-staff" 
                        class="tab-button border-b-2 border-amber-600 py-4 px-1 text-sm font-medium text-amber-600">
                        Staff เท่านั้น
                    </button>
                    <button onclick="showTab('all')" id="tab-all" 
                        class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-stone-500 hover:text-stone-700 hover:border-stone-300">
                        ดูทั้งหมด
                    </button>
                </nav>
            </div>
        </div>

        <!-- Staff Only Tab -->
        <div id="content-staff" class="tab-content">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-stone-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white">รายการ Staff</h3>
                    <a href="{{ route('manager.staff.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-md transition duration-150 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        เพิ่ม Staff ใหม่
                    </a>
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
                            @forelse($staffs as $staff)
                                <tr class="hover:bg-stone-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-stone-900">{{ $staff->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-stone-600">{{ $staff->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($staff->status === 'approved') bg-green-100 text-green-800
                                            @elseif($staff->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $staff->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                        {{ $staff->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('manager.staff.edit', $staff) }}" class="text-amber-600 hover:text-amber-900 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('manager.staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบ Staff นี้?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-stone-500">
                                        ไม่มีข้อมูล Staff
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-stone-50 px-6 py-4">
                    {{ $staffs->links() }}
                </div>
            </div>
        </div>

        <!-- All Users Tab -->
        <div id="content-all" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-stone-700 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white">รายการผู้ใช้ทั้งหมด</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-stone-200">
                        <thead class="bg-stone-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">ชื่อ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">อีเมล</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">บทบาท</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">สถานะ</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-stone-500 uppercase">วันที่สร้าง</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-stone-200">
                            @forelse($allUsers as $user)
                                <tr class="hover:bg-stone-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-stone-900">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-stone-600">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($user->role === 'admin') bg-red-100 text-red-800
                                            @elseif($user->role === 'manager') bg-purple-100 text-purple-800
                                            @elseif($user->role === 'staff') bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if($user->status === 'approved') bg-green-100 text-green-800
                                            @elseif($user->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $user->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-stone-600">
                                        {{ $user->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-stone-500">
                                        ไม่มีข้อมูลผู้ใช้
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-stone-50 px-6 py-4">
                    {{ $allUsers->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-button').forEach(el => {
                el.classList.remove('border-amber-600', 'text-amber-600');
                el.classList.add('border-transparent', 'text-stone-500');
            });

            // Show selected tab
            document.getElementById('content-' + tab).classList.remove('hidden');
            const button = document.getElementById('tab-' + tab);
            button.classList.remove('border-transparent', 'text-stone-500');
            button.classList.add('border-amber-600', 'text-amber-600');
        }
    </script>
</x-app-layout>