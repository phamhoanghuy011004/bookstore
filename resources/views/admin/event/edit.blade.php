@extends('admin.main')

@section('content')
    <form action="{{ route('event.update', $event->id) }}" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="name">Tên Sự Kiện</label>
                <input type="text" name="name" value="{{ $event->name }}" class="form-control" placeholder="Nhập tên sự kiện" required>
            </div>

            <div class="form-group">
                <label>Địa Điểm</label>
                <input type="text" name="location" value="{{ $event->location }}" class="form-control" placeholder="Nhập địa điểm sự kiện" required>
            </div>

            <div class="form-group">
                <label>Mô Tả</label>
                <textarea name="description" class="form-control" required>{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Thời Gian Bắt Đầu</label>
                <input type="datetime-local" name="start_time" value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Thời Gian Kết Thúc</label>
                <input type="datetime-local" name="end_time" value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Ảnh</label>
                <input type="hidden" name="image" value="{{ $event->image }}" class="form-control"/>
                <button class="btn btn-primary mt-2" type="button" id="upload_widget">Upload ảnh</button>
            </div>

            <div class="form-group">
                <label>Trạng Thái</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="status" {{ $event->status == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Kích Hoạt</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="status" {{ $event->status == 0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">Không Kích Hoạt</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Sự Kiện</button>
        </div>
        @csrf
        @method('PUT') <!-- Để chỉ định rằng đây là một yêu cầu PUT -->
    </form>

    <script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>
    <script type="text/javascript">
        var myWidget = cloudinary.createUploadWidget({
                cloudName: 'dficfkyug',
                uploadPreset: 'hellopreset'}, function (error, result) {
                if (!error && result && result.event === "success") {
                    document.forms[0]['image'].value = result.info.secure_url; // Chỉnh sửa để truy cập vào form đầu tiên
                }
            }
        )

        document.getElementById("upload_widget").addEventListener("click", function(){
            myWidget.open();
        }, false);
    </script>
@endsection

@section('footer')
@endsection
