@extends('admin.admin_layout')
@section('title', 'Quản lý Bình luận')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Danh sách Bình luận</h2>
</div>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Bài viết</th>
            <th>Người đăng</th>
            <th>Nội dung</th>
            <th>Ngày</th>
            <th class="text-center">Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td style="max-width: 260px;">
                    @if(!empty($row->tieuDe))
                        [Tin] {{ \Illuminate\Support\Str::limit($row->tieuDe, 60) }}
                    @elseif(!empty($row->tenDT))
                        [Sản phẩm] {{ \Illuminate\Support\Str::limit($row->tenDT, 60) }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $row->name }}</td>
                <td style="max-width: 420px;">{{ \Illuminate\Support\Str::limit($row->noiDung, 120) }}</td>
                <td>{{ $row->ngayDang }}</td>
                <td class="text-center">{{ (int)$row->active === 1 ? 'Hiện' : 'Ẩn' }}</td>
                <td>
                    @if((int)$row->active === 1)
                        <a href="/admin/binhluan/active/{{ $row->id }}/0" class="btn btn-sm btn-outline-secondary">Ẩn</a>
                    @else
                        <a href="/admin/binhluan/active/{{ $row->id }}/1" class="btn btn-sm btn-outline-primary">Duyệt</a>
                    @endif
                    <a href="/admin/binhluan/delete/{{ $row->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i class="bi bi-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-4">
    {{ $data->links() }}
</div>
@endsection
