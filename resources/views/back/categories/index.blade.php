@extends('back.layouts.app')

@section('admin-content')
    <div class="am-cf am-padding">
        @include('back.categories.partials.category_title')
    </div>
    <div class="am-g">
        <div class="am-u-sm-12 am-u-md-6">
            <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                    <button type="button" class="am-btn am-btn-default">
                        <span class="am-icon-plus"></span>
                        <a href="{{ route('backend::admin.categories.create') }}">新增分类</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="am-u-sm-12">
            @if (count($categories) > 0)
            <table class="am-table am-table-striped am-table-hover table-main">
                <thead>
                <tr>
                    <th class="table-id">ID</th>
                    <th class="table-title">分类标题</th>
                    <th class="table-title">分类层级</th>
                    <th class="table-title">上级分类</th>
                    <th class="table-date am-hide-sm-only">修改日期</th>
                    <th class="table-set">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->content }}</td>
                        <td>{{ $category->cat_depth }}</td>
                        <td>{{ $category->parent['content'] ? $category->parent['content'] : '无' }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{ route('backend::admin.categories.edit', ['id' => $category->id]) }}">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-secondary">
                                        <span class="am-icon-pencil-square-o"></span>
                                        编辑
                                    </button>
                                    </a>
                                    <a href="javascript:;">
                                    <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"
                                            data-am-modal="{target: '#cat-alert-{{ $category->id }}'}">
                                        <span class="am-icon-trash-o"></span>删除
                                    </button>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <div class="am-modal am-modal-alert" tabindex="-1" id="cat-alert-{{ $category->id }}">
                            <div class="am-modal-dialog">
                                <div class="am-modal-hd">Startups Campfire</div>
                                <div class="am-modal-bd">
                                    亲，确认删除分类{{ $category->content }}吗？
                                </div>
                                <div class="am-modal-footer">
                                    <span class="am-modal-btn" data-am-modal-cancel>取消</span>
                                    <form action="{{ route('backend::admin.categories.destroy', ['id' => $category->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-post-{{ $category->id }}">
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
            @endif
            <hr>
            <div class="am-cf">
                共{{ $categories_count }}条记录
                @include('back.partials.admin_paginator', ['paginator' => $categories]);
            </div>
        </div>
    </div>
@endsection

