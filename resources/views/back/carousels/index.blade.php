@extends('back.layouts.app')

@section('admin-content')
    @include('back.carousels.partials.carousel_title')
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-plus"></span>
                        <a href="{{ route('backend::admin.carousels.create') }}">新增幻灯片</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12">
            @if (count($carousels) > 0)
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-id">ID</th>
                        <th class="table-title">显示顺序</th>
                        <th class="table-title">幻灯片图片</th>
                        <th class="table-title">幻灯片外链</th>
                        <th class="table-date am-hide-sm-only">添加日期</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($carousels as $carousel)
                        <tr>
                            <td>{{ $carousel->id }}</td>
                            <td>{{ $carousel->order }}</td>
                            <td><img src="{{ $carousel->image_full_path }}" width="75" height="50" alt=""></td>
                            <td>{{ $carousel->url }}</td>
                            <td>{{ $carousel->created_at }}</td>
                            <td>
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                            <a href="{{ route('backend::admin.carousels.edit', ['id' => $carousel->id]) }}">
                                                <span class="am-icon-pencil-square-o"></span>
                                                编辑幻灯片
                                            </a>
                                        </button>
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                                data-am-modal="{target: '#carousel-alert-{{ $carousel->id }}'}">
                                            <span class="am-icon-trash-o"></span>删除
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <div class="am-modal am-modal-alert" tabindex="-1" id="carousel-alert-{{ $carousel->id }}">
                                <div class="am-modal-dialog">
                                    <div class="am-modal-hd">Startups Campfire</div>
                                    <div class="am-modal-bd">
                                        亲，确认删除幻灯片吗？
                                    </div>
                                    <div class="am-modal-footer">
                                        <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                        <form action="{{ route('backend::admin.carousels.destroy', ['id' => $carousel->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" id="delete-post-{{ $carousel->id }}">
                                                确定
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="am-cf">
                    共{{ $carousels_count }}条记录
                    @include('back.partials.admin_paginator', ['paginator' => $carousels]);
                </div>
            @endif
        </div>
    </div>
@endsection

