<section id="footer" style="background-color: #272727;min-height: 200px;color: white;padding-top: 20px;padding-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <a href="/" style="padding-top: 10px;padding-bottom: 10px;display: block;font-size: 20px;letter-spacing: 3px;color: #555555;">
                    <img src="{{ asset('logo.png') }}" alt="" style="width: 100%;height: auto;">
                </a>
            </div>
            <div class="col-sm-3">
                <h2 class="title-footer"> Danh mục nổi bật</h2>
                <div>
                    <ul>
                        @foreach($categoryLevel1 as $cate)
                            <li><a href="/danh-muc/{{ $cate->cpo_slug }}/{{ $cate->id }}" style="color: white;">{{ $cate->cpo_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <h2 class="title-footer"> Lời cảm ơn</h2>
                <div>
                    <p> Cảm ơn sự đóng góp cũng như ủng hộ của toàn thể các bạn ! Chúng tôi sẽ cố gắng hoàn thiện và cải tiến website để
                        mang lại sự trải nghiệm tốt nhất cho các bạn! .
                    </p>
                </div>
            </div>

            <div class="col-sm-3">
                <h2 class="title-footer">Liên hệ với chúng tôi</h2>
                <span><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i> Hà Nội</span><br>
                <span style="display: inline-block;padding: 5px 0"><i class="	glyphicon glyphicon-phone-alt"></i> Phone: 0988506404</span><br>
                <span><i class="glyphicon glyphicon-envelope"></i> Email: <a href="mailto:hoangnamng404@gmail.com" style="color: #fb9f45">hoangnamng404@gmail.com</a></span>
            </div>
        </div>
    </div>
</section>