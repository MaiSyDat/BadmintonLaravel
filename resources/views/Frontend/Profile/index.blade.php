@extends('Frontend.Home.main')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="avatar d-flex flex-column align-items-center text-center p-3 py-5"><img
                        class="rounded-circle mt-5"src="{{ asset(Auth::user()->img) }}"><span
                        class="font-weight-bold">{{ Auth::user()->name }}</span><span
                        class="text-black-50">{{ Auth::user()->email }}</span><span>
                    </span></div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Cài đặt thông tin cá nhân</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label class="labels">Họ tên</label>
                            <input type="text" class="form-control" placeholder="Họ tên"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Giới tính</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->gender }}"
                                placeholder="Giới tính">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input type="text" class="form-control" placeholder="Email"
                                value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Số điện thoại</label>
                            <input type="text" class="form-control"
                                placeholder="Số điện thoại"value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Địa chỉ</label>
                            <input type="text" class="form-control"
                                placeholder="Địa chỉ"value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Ngày sinh</label>
                            <input type="date" class="form-control" placeholder="Ngày sinh"
                                value="{{ Auth::user()->birthday }}">
                        </div>
                    </div>
                    <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save
                            Profile</button></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience"><span>Edit
                            Experience</span><span class="border px-3 p-1 add-experience"><i
                                class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                    <div class="col-md-12"><label class="labels">Experience in Designing</label>
                        <input type="text" class="form-control" placeholder="experience" value="">
                    </div> <br>
                    <div class="col-md-12"><label class="labels">Additional Details</label>
                        <input type="text" class="form-control" placeholder="additional details" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
