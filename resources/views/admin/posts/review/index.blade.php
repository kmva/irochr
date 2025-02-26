@extends('admin.layouts.layout')

@section('content')

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Менеджер отзывов</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Список всех отзывов</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('video.create') }}" class="btn btn-primary mb-3"> Добавить отзыв</a>

                    @if(count($posts))
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th style="width: 10px">#ID</th>
                                <th>Наименование</th>
                                <th>Категория</th>
                                <th>Дата создания</th>
                                <th>Кол-во <br> просмотров</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td> {{$post->id}}</td>
                                <td><a href="{{route('posts.edit', ['post' => $post->id])}}">{{title_trim($post->title)}}</a></td>
                                @if(is_object($post->category))
                                    <td>{{$post->category->title}}</td>
                                @else
                                    <td> без категорий</td>
                                @endif
                                <td>
                                    <?php
                                    $timestamp = strtotime($post->created_at);
                                    $new_date = date("d-m-Y | H:i", $timestamp);
                                    ?>

                                    {{$new_date}}
                                </td>
                                <td>
                                    {{$post->views}}
                                </td>
                                <td>
                                    <!-- передаем в маршрут параметр-->
                                    <a href="{{route('posts.edit', ['post' => $post->id])}}" class="btn btn-info btn-sm float-left mr-1">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('posts.destroy',['post' => $post->id])}}"  method="POST" class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтвердите удаление')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p>Новых отзывов нет</p>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{$posts->links()}}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

@endsection
