@extends('layouts.main_layout')

@section('title','Главная')

@section('content')
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.7);
        }
        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: transparent;
            margin: 15% auto;
            padding: 20px;
            width: max-content;
        }

        .close {
            color: white;
            font-size: 38px;
            font-weight: bold;
            position: absolute;
            top:-10%;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <section class="slider_section">
        <div class="slider_section__items">
            <div class="slider_section__item slider_section__item--active">
                <img class="slider_section__image" src="assets/front/img/main-bg7.jpg">
                <a href="{{route('modern_school')}}"><h1 class="slider_section__heading">РЕАЛИЗАЦИЯ ФП «СОВРЕМЕННАЯ ШКОЛА» НАЦИОНАЛЬНОГО ПРОЕКТА «ОБРАЗОВАНИЕ» В ЧЕЧЕНСКОЙ РЕСПУБЛИКЕ</h1></a>
            </div>
{{--            <div class="slider_section__item">--}}
{{--                <img class="slider_section__image" src="assets/front/img/main-bg.png">--}}
{{--                <a href="#"><h1 class="slider_section__heading">Всероссийское совещание руководителей системы ДПО</h1></a>--}}
{{--            </div>--}}
{{--            <div class="slider_section__item">--}}
{{--                <img class="slider_section__image" src="assets/front/img/main-bg.png">--}}
{{--                <a href="#"><h1 class="slider_section__heading">Всероссийское совещание руководителей системы ДПО</h1></a>--}}
{{--            </div>--}}
        </div>
        <div class="slider_section__controllers">
            <button type="button" class="slider_section__controller slider_section__controller--left"><i class="fas fa-arrow-left"></i></button>
            <button type="button" class="slider_section__controller slider_section__controller--right"><i class="fas fa-arrow-right"></i></button>
        </div>
    </section>
    <div class="container">
        <div class="row row--ne">
            <div class="news">
                <h3 class="bigger">Главная новость</h3>
                @if(count($mainArticle))
                @foreach($mainArticle as $article)
                    <div class="news__block">
                        <img src="{{$article->getImage()}}" alt="" class="news__image">
                        <div class="news__info">
                            <h3 class="news__heading"><a href="{{route('article',['slug' => $article->slug])}}">{{$article->title}}</a></h3>
                            <p class="news__text">{!! $article->description !!}</p>
                            <a href="{{route('article',['slug' => $article->slug])}}" class="news__details">подробнее</a>
                            <p class="news__date">{{$article->getPostDate()}}</p>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
            <div class="actual_video">
                <h3 class="bigger">Актуальное видео</h3>
                @foreach($mainMovie as $movie)
                <div class="actual_video__block">
                    {!! $movie->content !!}
                    <h3 class="actual_video__heading">
                        <a class="">
                            {{$movie->title}}
                        </a>
                    </h3>
                    <a href="{{route('video_content.index')}}" class="actual_video__all">Все видео</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

        <section class="cards_section">
            @if(count($posts))
            <h2><button class="csh">Новости</button> | <button class="csh csh--disable">Анонсы</button></h2>
            <div class="cards" data-name="news">

                @foreach($posts as $post)
                <div class="card">
                    <div class="card__image_block">
                        <img src="{{$post->getImage()}}" alt="" class="card__image">
                    </div>
                    <div class="card__info">
                        <h3 class="card__heading"><a href="{{route('article',['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                        <p class="card__date">{{$post->getPostDate()}}</p>
                        <a href="{{route('article',['slug' => $post->slug])}}" class="card__details">Читать</a>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
            <div class="cards cards--disable" data-name="announcements">
            @if(count($announces))
                @foreach($announces as $announce)
                    <div class="card">
                        <div class="card__image_block">
                            <img src="{{$announce->getImage()}}" alt="" class="card__image">
                        </div>
                        <div class="card__info">
                            <h3 class="card__heading"><a href="{{route('article',['slug' => $announce->slug])}}">{{$announce->title}}</a></h3>
                            <p class="card__date">{{$announce->getPostDate()}}</p>
                            <a href="{{route('article',['slug' => $announce->slug])}}" class="card__details">Читать</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('category', ['slug' => $post->category->slug])}}" class="to_all_link">Все новости</a>
            <a href="{{ route('announce_list')}}" class="to_all_link to_all_link--disable">Все анонсы</a>
            @endif
        </section>
    <div class="container documents_section">
        <h2>Нормативные документы</h2>
        <div class="row documents">

            @foreach($documents as $doc)
                <a href="{{$doc->content}}" class="document" target="_blank">
                    <i class="far fa-file-alt"></i>
                    <p class="document_title">{{$doc->title}} </p>
                </a>
            @endforeach

        </div>
        <a href="{{route('institute.document')}}" class="to_all_link">Все документы</a>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <div id="container-video" style="text-align: center">
            </div>
        </div>
    </div>
{{--    <div class="container--colored">--}}
{{--        <div class="container videos_section">--}}
{{--            <h2>Видео</h2>--}}
{{--            <div class="row videos">--}}
{{--                @if(isset($videoList))--}}
{{--                    @foreach($videoList->items as $key=> $item)--}}
{{--                        <div class="video hide-m">--}}
{{--                              <img src="{{$item->snippet->thumbnails->high->url}}" class="myBtn"  data-id="{{$item->id->videoId}}" alt="">--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <a href="{{route('video_content.index')}}" class="to_all_link">Все видео</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="container--colored">
        <div class="container videos_section">
            <h2>Видео</h2>
            <div class="row videos">
                <div class="video"><iframe width="100%" height="280" src="https://www.youtube.com/embed/nWzFFkncrsE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="video"><iframe width="100%" height="280" src="https://www.youtube.com/embed/cW9TA5pbROw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="video"><iframe width="100%" height="280" src="https://www.youtube.com/embed/IcFQDMS5rPQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="video hide-m"><iframe width="100%" height="280" src="https://www.youtube.com/embed/JBfDrUBHEoU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="video hide-m"><iframe width="100%" height="280" src="https://www.youtube.com/embed/o7xyGYgpfjY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <div class="video hide-m"><iframe width="100%" height="280" src="https://www.youtube.com/embed/tYOl4NP5K_E" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
            </div>
            {{--            <div class="row videos">--}}
            {{--                <div class="video"><img src="img/main-bg.png" alt=""></div>--}}
            {{--                <div class="video"><img src="img/mqdefault.jpeg" alt=""></div>--}}
            {{--                <div class="video"><img src="img/mqdefault.jpeg" alt=""></div>--}}
            {{--                <div class="video hide-m"><img src="img/mqdefault.jpeg" alt=""></div>--}}
            {{--                <div class="video hide-m"><img src="img/mqdefault.jpeg" alt=""></div>--}}
            {{--                <div class="video hide-m"><img src="img/mqdefault.jpeg" alt=""></div>--}}
            {{--            </div>--}}
            <a href="{{route('video_content.index')}}" class="to_all_link">Все видео</a>
        </div>
    </div>
    <div class="container resources_section">
        <h2>Информационные ресурсы института</h2>
        <div class="row resources">
            <a href="http://tallam.ru/" class="resource" target="_blank">
                <img src="{{asset('assets/front/img/resources/tallam.jpg')}}" alt="Tallam">
                <p>Информационно-аналитическая платформа Tallam</p>
            </a>
            <a href="http://e-learning.ipkrochr.ru/" class="resource" target="_blank">
                <img src="{{asset('assets/front/img/resources/moodle.jpg')}}" alt="Moodle ИРО ЧР">
                <p>Учебный центр ГБУ ДПО ИРО ЧР</p>
            </a>
            <a href="http://poll.ipkrochr.ru/" class="resource" target="_blank">
                <img src="{{asset('assets/front/img/resources/online.jpg')}}" alt="Онлайн заявки на КПК">
                <p>Онлайн заявки на КПК</p>
            </a>
            <a href="https://statipkro.ru/" class="resource" target="_blank">
                <img src="{{asset('assets/front/img/resources/stat1.jpg')}}"  alt="Statipkro">
                <p>Портал изучения образовательных потребностей педагогического сообщества ЧР</p>
            </a>
        </div>
    </div>
    <div class="container testimonials_section">
        <h2>Отзывы</h2>
        <div class="testimonials_controllers">
            <div class="testimonials_controller testimonials_controller--left"><i class="fas fa-arrow-left"></i></div>
            <div class="testimonials_controller testimonials_controller--right"><i class="fas fa-arrow-right"></i></div>
        </div>
        <div class="testimonials_wrapper">
            <div class="testimonials">
                @foreach($reviews as $rev)
                <div class="testimonial">
                    <p class="testimonial__name">{{$rev->title}}</p>
                    <p class="testimonial__text">{!! $rev->content !!}</p>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="container links_section">
        <h2>Полезные ссылки</h2>
        <div class="links_section__wrapper">
            <button type="button" class="links_section__controller links_section__controller--left"><i class="fas fa-arrow-left"></i></button>
            <button type="button" class="links_section__controller links_section__controller--right"><i class="fas fa-arrow-right"></i></button>
            <div class="links_wrapper">
                <div class="links">
                    <a href="https://govzalla.ru/index.php/component/content/article/9-uncategorised/916-metodicheskie-materialy-dlya-zamestitelej-direktorov-ou-i-rabotnikov-mms.html" class="links__link">
                        <img src="assets/front/img/links/mmc2.jpg">
                    </a>
                    <a href="https://resh.edu.ru/" class="links__link">
                        <img src="assets/front/img/links/resh.png">
                    </a>
                    <a href="https://govzalla.ru/index.php/component/content/article/9-uncategorised/906-metodicheskie-rekomendatsii-na-2015-2016-uchebnyj-god.html" class="links__link">
                        <img src="assets/front/img/links/МР2020_21.jpg">
                    </a>
                    <a href="https://vks.edu.ru/" class="links__link">
                        <img src="assets/front/img/links/soch.png">
                    </a>
                    <a href="http://www.examen.biz/" class="links__link">
                        <img src="assets/front/img/links/ekz.jpg">
                    </a>
                    <a href="https://rosuchebnik.ru/" class="links__link">
                        <img src="assets/front/img/links/rosuch.jpg">
                    </a>
                    <a href="https://www.mos.ru/city/projects/mesh/" class="links__link">
                        <img src="assets/front/img/links/mesh.jpg">
                    </a>
                    <a href="https://www.rustest.ru/" class="links__link">
                        <img src="assets/front/img/links/fct.jpg">
                    </a>
                    <a href="https://www.yaklass.ru/" class="links__link">
                        <img src="assets/front/img/links/yaclass.jpg">
                    </a>
                    <a href="https://helpinver.com/" class="links__link">
                        <img src="assets/front/img/links/helpinver.jpg">
                    </a>
                    <a href="https://prosv.ru/" class="links__link">
                        <img src="assets/front/img/links/prosv.jpg">
                    </a>
                    <a href="https://fioco.ru/" class="links__link">
                        <img src="assets/front/img/links/fioko.jpg">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container partners_section">
        <h2>Партнёры</h2>
        <div class="row partners">
            <a href="http://obrnadzor.gov.ru/" class="partner"><img src="assets/front/img/partners/rosobr.png" alt=""></a>
            <a href="https://minobrnauki.gov.ru/" class="partner"><img src="assets/front/img/partners/minobr.png" alt=""></a>
            <a href="https://fipi.ru/" class="partner"><img src="assets/front/img/partners/fipi.png" alt=""></a>
            <a href="https://edu.gov.ru/" class="partner"><img src="assets/front/img/partners/minpros.png" alt=""></a>
            <a href="https://mon95.ru/" class="partner"><img src="assets/front/img/partners/minobrchr.jpg" alt=""></a>
        </div>
    </div>
    <button class="scroll_to_top_button--hidden"><i class="fas fa-chevron-up"></i></button>

    <script>
        $(document).ready(function() {
            let modal = document.getElementById("myModal");
            let content = $('#container-video')

            $('.myBtn').click((event)=>{
                let link = event.target.getAttribute("data-id")
                content = $('#container-video')
                content.append('<iframe id="ytplayer" type="text/html" width="720" height="405" src="https://www.youtube.com/embed/'+link+'?autoplay=1'+'" frameborder="0" allowfullscreen>')
                modal.style.display = "inline-block";
            })

            $('#close').click(()=>{
                modal.style.display = "none";
                content.empty()
            })

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                    content.empty()
                }
            }
        });

    </script>
@endsection
