<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            จัดการทรัพย์สิน
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); margin-top: 2px;">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="row justify-content-end">
                    <div class="col-12">
                        <div class="row align-items-end">
                            <div class="col-12">
                                <a href="{{ url('/asset/insert') }}" class="btn btn-primary btn-lg float-right" style="height: 50px;">
                                    <i class="fas fa-plus mt-1"></i>  เพิ่มทรัพย์สิน
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- <style>
                    /* สร้างพื้นหลังสีขาวคลุม DataTable, ช่องค้นหา และส่วนที่มี paginate */
                    .dataTables_wrapper {
                        background-color: #fff;
                        padding: 20px; /* ปรับระยะห่างตามความต้องการ */
                        border-radius: 8px; /* ปรับเป็นขอบโค้ง */
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
                        margin-top: 2px; /* ปรับระยะห่างด้านบน */
                    }

                    /* ปรับสไตล์ของช่องค้นหา */
                    .dataTables_filter input {
                        border: 1px solid #ccc; /* เส้นขอบ */
                        border-radius: 8px; /* ขอบโค้ง */
                        padding: 8px; /* ขนาดของช่อง */
                    } -->
                </style>
                <div class="row">
                    <table id="myTable" class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr class="text-center">
                                <th scope="col">ลำดับ</th>
                                <th scope="col">รหัสทรัพย์สิน</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">ประเภท</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col">แก้ไข</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assets as $row)
                            <tr class="text-center" data-toggle="modal" data-target="#popup{{$row->id}}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$row->asset_code}}</td>
                                <td>{{$row->asset_name}}</td>
                                <td>{{$row->asset_type}}</td>
                                <td>{{$row->asset_status}}</td>
                               
                                    <td>
                                        <a href="{{url('/asset/edit/'.$row->id)}}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{url('/asset/delete/'.$row->id)}}" class="btn btn-danger"
                                             onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่ ?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                            </tr>
                            <!-- Popup -->
                            <div class="modal fade" id="popup{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="popupTitle{{$row->id}}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="popupTitle{{$row->id}}">รายละเอียดทรัพย์สิน</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <div class="modal-body">
                                            <div> <!-- Add your asset details here -->
                                                <!-- Asset Image -->
                                                <div class="row mb-4 justify-content-center">
                                                    <img src="{{asset($row->asset_image)}}" alt="" style="max-width: 200px; max-height: 200px;">
                                                </div>
                                                <div>
                                                    <div class="row mb-4 justify-content-center" >
                                                    <!-- Asset Code and Name -->
                                                    <div class="row mb-4 ml-4">
                                                        <div class="col-md-6">
                                                            รหัสทรัพย์สิน: {{$row->asset_code}}
                                                        </div>
                                                        <div class="col-md-6">
                                                            ชื่อ: {{$row->asset_name}}
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Asset Type and Price -->
                                                    <div class="row mb-4 ml-4">
                                                        <div class="col-md-6">
                                                            ประเภท: {{$row->asset_type}}
                                                        </div>
                                                        <div class="col-md-6">
                                                            ราคา: {{$row->asset_price}}฿
                                                        </div>
                                                    </div>

                                                    <!-- Other Asset Details -->
                                                    <div class="row mb-4 ml-4">
                                                        <div class="col-md-6">
                                                            วิธีการได้รับ: {{$row->asset_recieve}}
                                                        </div>
                                                        <div class="col-md-6">
                                                            ผู้บริจาค: {{$row->asset_giver}}
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4 ml-4">
                                                        <div class="col-md-6 ">
                                                            วันที่ได้รับ: {{ date('d/m/Y', strtotime($row->recieve_date)) }}
                                                        </div>
                                                        <div class="col-md-6">
                                                        @if ($row->cancel_date)
                                                            วันที่ยกเลิกใช้: {{ date('d/m/Y', strtotime($row->cancel_date)) }}
                                                        @else
                                                            วันที่ยกเลิกใช้: -
                                                        @endif
                                                        </div>
                                                    </div>

                                                    <div class="row mb-4 ml-4">
                                                        <div class="col-md-6">
                                                            สถานะ: {{$row->asset_status}}
                                                        </div>
                                                        <div class="col-md-6">
                                                            ผู้ถือครอง:
                                                        </div>
                                                    </div>
                                                    </div> 

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Popup -->
                            @endforeach
                        </tbody>
                    </table>
                    <script>
                        document.querySelectorAll('tr[data-target^="#popup"]').forEach(row => {
                            row.addEventListener('click', () => {
                                const targetId = row.getAttribute('data-target');
                                const popup = document.querySelector(targetId);
                                const modal = new bootstrap.Modal(popup);
                                modal.show();
                            });
                        });
                    </script>
                    <script>
                        new DataTable('#myTable');
                    </script>
    
                    <script>
                        document.querySelectorAll('tr[data-target^="#popup"]').forEach(row => {
                            row.addEventListener('click', () => {
                                const targetId = row.getAttribute('data-target');
                                const popup = document.querySelector(targetId);
                                const modal = new bootstrap.Modal(popup);
                                modal.show();
                            });
                        });
                    </script>
                    <script>
                        document.querySelectorAll('.modal .close').forEach(closeButton => {
                            closeButton.addEventListener('click', () => {
                                const modal = closeButton.closest('.modal');
                                const modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();
                            });
                        });
                    </script>
                    <script>
                        document.querySelectorAll('.btn-warning').forEach(button => {
                            button.addEventListener('click', (event) => {
                                event.preventDefault(); // ยกเลิกการทำงานของลิงก์
                                window.location.href = event.target.href; // ลิงก์ไปยังหน้าแก้ไข
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>