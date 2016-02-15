{Assets::group('head')}
{Assets::css()}

{Assets::js()}

<!-- Базовый скрипт  -->
<script src="{$base_UI}js/{Request::current()->uri()}.js"></script>

</body>
</html>