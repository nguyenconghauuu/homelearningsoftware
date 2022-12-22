<?php
    $configJs =
        [
            [
                'link' => 'admin/js/jquery.min.js',
                'sort' => 1
            ],
            [
                'link' => 'admin/js/bootstrap.min.js',
                'sort' => 2
            ],
        ];
?>
@foreach($configJs as $item)
    <script src="{{ asset($item['link']) }}"></script>
@endforeach

<script src="{{ asset('js/all.js') }}"></script>
<script type="text/javascript">
    $(function() {
//        $('.flash-message').slideUp().hide(8000);
    })
</script>



